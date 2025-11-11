<?php
require '../../vendor/autoload.php';

use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable(dirname(__DIR__));
$dotenv->load();

header('Content-Type: text/plain; charset=utf-8');

echo "=== DIAGNÓSTICO OPENAI (sin cURL) ===\n\n";

// 1. Verificar API Key
$apiKey = $_ENV['OPENAI_API_KEY'] ?? null;

if (!$apiKey) {
    echo "❌ ERROR: No se encontró OPENAI_API_KEY en .env\n";
    exit;
}

echo "✅ API Key encontrada: " . substr($apiKey, 0, 10) . "..." . substr($apiKey, -5) . "\n\n";

// 2. Verificar extensiones PHP necesarias
echo "--- Extensiones PHP ---\n";
echo "cURL: " . (extension_loaded('curl') ? "✅ Habilitado" : "❌ DESHABILITADO") . "\n";
echo "JSON: " . (extension_loaded('json') ? "✅ Habilitado" : "❌ DESHABILITADO") . "\n";
echo "OpenSSL: " . (extension_loaded('openssl') ? "✅ Habilitado" : "❌ DESHABILITADO") . "\n\n";

if (!extension_loaded('curl')) {
    echo "⚠️ IMPORTANTE: cURL está deshabilitado\n";
    echo "Para habilitarlo:\n";
    echo "1. Abre php.ini (XAMPP: Config > PHP)\n";
    echo "2. Busca: ;extension=curl\n";
    echo "3. Quita el punto y coma: extension=curl\n";
    echo "4. Reinicia Apache\n\n";
}

// 3. Probar conexión con OpenAI usando el SDK
echo "--- Probando conexión con OpenAI ---\n";

try {
    $client = OpenAI::client($apiKey);
    
    echo "Intentando llamada simple...\n";
    
    $response = $client->chat()->create([
        'model' => 'gpt-4o-mini',
        'messages' => [
            ['role' => 'user', 'content' => 'Di: OK']
        ],
        'max_tokens' => 5
    ]);
    
    $respuesta = $response['choices'][0]['message']['content'] ?? 'Sin respuesta';
    
    echo "✅ ¡CONEXIÓN EXITOSA!\n";
    echo "Respuesta de OpenAI: " . $respuesta . "\n\n";
    
    echo "🎉 Tu API funciona correctamente\n";
    echo "El problema era temporal o ya se solucionó\n\n";
    
} catch (Exception $e) {
    $errorMsg = $e->getMessage();
    echo "❌ ERROR:\n";
    echo $errorMsg . "\n\n";
    
    // Análisis del error
    echo "--- ANÁLISIS DEL ERROR ---\n";
    
    if (stripos($errorMsg, 'insufficient_quota') !== false) {
        echo "🔴 PROBLEMA: SIN CRÉDITOS\n\n";
        echo "Tu cuenta no tiene balance disponible.\n\n";
        echo "SOLUCIÓN:\n";
        echo "1. Ve a: https://platform.openai.com/account/billing/overview\n";
        echo "2. Click en 'Add payment details' (si no lo hiciste)\n";
        echo "3. Click en 'Add to credit balance'\n";
        echo "4. Recarga mínimo $5 USD\n";
        echo "5. Espera 2-3 minutos para que se active\n\n";
    }
    elseif (stripos($errorMsg, 'rate_limit') !== false || stripos($errorMsg, '429') !== false) {
        echo "🟡 PROBLEMA: LÍMITE DE PETICIONES\n\n";
        echo "Has excedido el límite de peticiones por minuto.\n\n";
        echo "CAUSAS POSIBLES:\n";
        echo "1. Tier gratuito (3 RPM)\n";
        echo "2. Múltiples pruebas en poco tiempo\n";
        echo "3. Otros scripts usando la misma API Key\n\n";
        echo "SOLUCIÓN:\n";
        echo "1. ESPERA 60 SEGUNDOS y vuelve a probar\n";
        echo "2. Verifica tu tier en: https://platform.openai.com/account/limits\n";
        echo "3. Si estás en Tier 1 (gratuito), gasta $5+ para subir a Tier 2\n\n";
        echo "LÍMITES POR TIER:\n";
        echo "- Tier 1 (Free): 3 RPM, 200 RPD\n";
        echo "- Tier 2 ($5+): 500 RPM, 10K RPD\n";
        echo "- Tier 3 ($50+): 5K RPM, 100K RPD\n\n";
    }
    elseif (stripos($errorMsg, 'invalid_api_key') !== false || stripos($errorMsg, '401') !== false) {
        echo "🔴 PROBLEMA: API KEY INVÁLIDA\n\n";
        echo "La API Key no es válida o fue revocada.\n\n";
        echo "SOLUCIÓN:\n";
        echo "1. Ve a: https://platform.openai.com/api-keys\n";
        echo "2. Revoca la key actual\n";
        echo "3. Crea una nueva\n";
        echo "4. Actualiza tu archivo .env\n\n";
    }
    elseif (stripos($errorMsg, 'model_not_found') !== false) {
        echo "🔴 PROBLEMA: MODELO NO DISPONIBLE\n\n";
        echo "El modelo 'gpt-4o-mini' no está disponible para tu cuenta.\n\n";
        echo "SOLUCIÓN:\n";
        echo "Prueba con: gpt-3.5-turbo (más compatible)\n\n";
    }
    elseif (!extension_loaded('curl')) {
        echo "🔴 PROBLEMA: cURL DESHABILITADO\n\n";
        echo "El SDK de OpenAI requiere cURL para funcionar.\n";
        echo "Habilítalo siguiendo las instrucciones arriba.\n\n";
    }
    else {
        echo "⚠️ ERROR DESCONOCIDO\n\n";
        echo "Error completo:\n$errorMsg\n\n";
    }
}

// 4. Enlaces útiles
echo "--- ENLACES ÚTILES ---\n";
echo "Dashboard: https://platform.openai.com/usage\n";
echo "Límites: https://platform.openai.com/account/limits\n";
echo "Billing: https://platform.openai.com/account/billing/overview\n";
echo "API Keys: https://platform.openai.com/api-keys\n\n";

// 5. Test de escritura de logs
echo "--- Test de escritura de logs ---\n";
$logDir = dirname(__DIR__) . '/logs';
$logFile = $logDir . '/test.log';

if (!is_dir($logDir)) {
    if (@mkdir($logDir, 0755, true)) {
        echo "✅ Carpeta logs creada: $logDir\n";
    } else {
        echo "❌ No se pudo crear carpeta logs\n";
        echo "Ruta intentada: $logDir\n";
    }
} else {
    echo "✅ Carpeta logs existe: $logDir\n";
}

if (@file_put_contents($logFile, "Test: " . date('Y-m-d H:i:s') . PHP_EOL, FILE_APPEND)) {
    echo "✅ Escritura de logs funciona\n";
} else {
    echo "❌ No se puede escribir en logs (verifica permisos)\n";
}

echo "\n=== FIN DEL DIAGNÓSTICO ===\n";