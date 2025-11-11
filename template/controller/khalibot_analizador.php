<?php
require '../../vendor/autoload.php';
require_once("../model/Chat.php");

use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable(dirname(__DIR__));
$dotenv->load();

/**
 * Verifica si se ha excedido el rate limit (máximo 3 peticiones por minuto por sesión)
 */
function checkRateLimit(): bool {
    if (!isset($_SESSION['khalibot_requests'])) {
        $_SESSION['khalibot_requests'] = [];
    }

    $now = time();
    $oneMinuteAgo = $now - 60;

    // Limpiar peticiones antiguas
    $_SESSION['khalibot_requests'] = array_filter(
        $_SESSION['khalibot_requests'],
        fn($timestamp) => $timestamp > $oneMinuteAgo
    );

    // Verificar límite (3 peticiones por minuto)
    if (count($_SESSION['khalibot_requests']) >= 3) {
        return false;
    }

    // Registrar nueva petición
    $_SESSION['khalibot_requests'][] = $now;
    return true;
}

/**
 * Busca respuestas en cache para consultas similares
 */
function buscarEnCache(string $userMessage): ?array {
    $cacheFile = dirname(__DIR__) . '/cache/khalibot_cache.json';
    
    if (!file_exists($cacheFile)) {
        return null;
    }

    $cache = json_decode(file_get_contents($cacheFile), true);
    if (!$cache) {
        return null;
    }

    $messageLower = strtolower(trim($userMessage));

    // Buscar coincidencia exacta o similar
    foreach ($cache as $item) {
        if (isset($item['query']) && isset($item['response'])) {
            $similarity = 0;
            similar_text(strtolower($item['query']), $messageLower, $similarity);
            
            // Si la similitud es mayor al 85%, usar cache
            if ($similarity > 85) {
                return $item['response'];
            }
        }
    }

    return null;
}

/**
 * Guarda respuesta en cache
 */
function guardarEnCache(string $userMessage, array $response): void {
    $cacheDir = dirname(__DIR__) . '/cache';
    $cacheFile = $cacheDir . '/khalibot_cache.json';
    
    // Crear directorio si no existe
    if (!is_dir($cacheDir)) {
        mkdir($cacheDir, 0755, true);
    }

    // Cargar cache existente
    $cache = [];
    if (file_exists($cacheFile)) {
        $cache = json_decode(file_get_contents($cacheFile), true) ?? [];
    }

    // Agregar nueva entrada (máximo 50 entradas)
    $cache[] = [
        'query' => $userMessage,
        'response' => $response,
        'timestamp' => time()
    ];

    // Mantener solo las últimas 50 entradas
    if (count($cache) > 50) {
        $cache = array_slice($cache, -50);
    }

    file_put_contents($cacheFile, json_encode($cache, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
}

/**
 * Respuestas predefinidas para consultas comunes (sin usar API)
 */
function respuestaPredefinida(string $userMessage): ?array {
    $messageLower = strtolower(trim($userMessage));

    // Saludos
    if (preg_match('/^(hola|buenas|buenos días|buenas tardes|buenas noches|saludos|hey)$/i', $messageLower)) {
        return [
            "intencion" => "saludo",
            "respuesta" => "¡Hola! 👋 Soy Khalibot, tu asistente inmobiliario de Global MJF. ¿En qué puedo ayudarte hoy? Puedo ayudarte a buscar propiedades en venta o alquiler, o agendar una cita."
        ];
    }

    // Despedidas
    if (preg_match('/^(adiós|adios|chau|hasta luego|nos vemos|bye)$/i', $messageLower)) {
        return [
            "intencion" => "despedida",
            "respuesta" => "¡Hasta pronto! Si necesitas algo más, aquí estaré para ayudarte. 😊"
        ];
    }

    // Agradecimientos
    if (preg_match('/^(gracias|muchas gracias|thanks|thx)$/i', $messageLower)) {
        return [
            "intencion" => "agradecimiento",
            "respuesta" => "¡De nada! Estoy aquí para ayudarte. ¿Hay algo más en lo que pueda asistirte?"
        ];
    }

    return null;
}

/**
 * Procesa un mensaje del usuario con OpenAI y devuelve un array estructurado
 * 
 * @param string $userMessage Mensaje del usuario
 * @param array|null $historial Historial de mensajes previos (opcional)
 * @return array Respuesta estructurada del bot
 */
function procesarChatKhalibot(string $userMessage, ?array $historial = null): array {
    
    // Validación básica
    $userMessage = trim($userMessage);
    if (empty($userMessage)) {
        return [
            "respuesta" => "Por favor, escribe un mensaje para poder ayudarte."
        ];
    }

    // 1. Verificar respuestas predefinidas (sin consumir API)
    $respuestaPre = respuestaPredefinida($userMessage);
    if ($respuestaPre) {
        return $respuestaPre;
    }

    // 2. Verificar cache
    $respuestaCache = buscarEnCache($userMessage);
    if ($respuestaCache) {
        logDebug("CACHE HIT: " . $userMessage);
        return $respuestaCache;
    }

    // 3. Verificar rate limit
    if (!checkRateLimit()) {
        return [
            "intencion" => "rate_limit",
            "respuesta" => "Por favor, espera un momento antes de enviar otro mensaje. Nuestro sistema necesita un breve descanso. ⏱️"
        ];
    }

    try {
        // Inicializar cliente
        $client = OpenAI::client($_ENV['OPENAI_API_KEY']);

        // Prompt del sistema optimizado
        $prompt = <<<PROMPT
Eres Khalibot, asistente inmobiliario de Global MJF. Responde en español de forma breve y clara.

Devuelve JSON válido:
{
  "intencion": "venta|alquiler|proyectos|cita|consulta_general|otro",
  "departamento": "nombre o null",
  "provincia": "nombre o null",
  "distrito": "nombre o null",
  "tipo_propiedad": "casa|departamento|oficina|terreno|local_comercial|null",
  "precio_min": numero o null,
  "precio_max": numero o null,
  "dormitorios": numero o null,
  "respuesta": "texto natural breve"
}

REGLAS:
- Nunca inventes propiedades
- Sé breve (máximo 2-3 oraciones)
- Si falta info, pregunta amablemente
- Para citas, indica que el usuario debe escribir "agendar cita"
PROMPT;

        // Construir mensajes (limitar historial a últimos 3 para ahorrar tokens)
        $messages = [["role" => "system", "content" => $prompt]];

        if ($historial && is_array($historial)) {
            $historialReciente = array_slice($historial, -3);
            $messages = array_merge($messages, $historialReciente);
        }

        $messages[] = ["role" => "user", "content" => $userMessage];

        // Llamada a OpenAI con configuración optimizada
        $response = $client->chat()->create([
            'model' => 'gpt-4o-mini',
            'messages' => $messages,
            'temperature' => 0.3,
            'max_tokens' => 250, // Reducido para ahorrar tokens
            'response_format' => ['type' => 'json_object']
        ]);

        $reply = $response['choices'][0]['message']['content'] ?? '';
        logDebug("API CALL: " . $userMessage . " -> " . substr($reply, 0, 100));

        $result = json_decode($reply, true);

        if (!$result || !isset($result['respuesta'])) {
            throw new Exception("JSON inválido de OpenAI");
        }

        $resultNormalizado = normalizarRespuesta($result);

        // Guardar en cache
        guardarEnCache($userMessage, $resultNormalizado);

        return $resultNormalizado;

    } catch (Exception $e) {
        echo $e->getMessage();
        $errorMsg = $e->getMessage();
        error_log("Error Khalibot: " . $errorMsg);

        // Detectar error de rate limit de OpenAI
        if (strpos($errorMsg, 'rate_limit') !== false || strpos($errorMsg, 'Rate limit') !== false) {
            return [
                "intencion" => "error_rate_limit",
                "respuesta" => "Estamos experimentando mucho tráfico en este momento. Por favor, intenta nuevamente en 1 minuto o contáctanos al (01) XXX-XXXX. 📞"
            ];
        }

        return [
            "intencion" => "error",
            "respuesta" => "Disculpa, estoy teniendo problemas técnicos. ¿Podrías intentar nuevamente?"
        ];
    }
}

/**
 * Normaliza y valida la respuesta de OpenAI
 */
function normalizarRespuesta(array $data): array {
    $estructura = [
        "intencion" => $data['intencion'] ?? 'otro',
        "departamento" => $data['departamento'] ?? null,
        "provincia" => $data['provincia'] ?? null,
        "distrito" => $data['distrito'] ?? null,
        "tipo_propiedad" => $data['tipo_propiedad'] ?? null,
        "precio_min" => isset($data['precio_min']) ? (float)$data['precio_min'] : null,
        "precio_max" => isset($data['precio_max']) ? (float)$data['precio_max'] : null,
        "dormitorios" => isset($data['dormitorios']) ? (int)$data['dormitorios'] : null,
        "respuesta" => $data['respuesta'] ?? 'Lo siento, no pude procesar tu solicitud.'
    ];

    return array_filter($estructura, function($value) {
        return $value !== null;
    }) + ['respuesta' => $estructura['respuesta']];
}

/**
 * Registra mensajes de debug en un archivo log
 */
function logDebug(string $message): void {
    $logDir = dirname(__DIR__) . '/logs';
    
    if (!is_dir($logDir)) {
        mkdir($logDir, 0755, true);
    }
    
    $logFile = $logDir . '/khalibot_' . date('Y-m-d') . '.log';
    $timestamp = date('Y-m-d H:i:s');
    $logMessage = "[{$timestamp}] {$message}" . PHP_EOL;
    
    file_put_contents($logFile, $logMessage, FILE_APPEND);
}