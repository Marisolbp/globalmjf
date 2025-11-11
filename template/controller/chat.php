<?php
header('Content-Type: application/json; charset=utf-8');

//if (session_status() === PHP_SESSION_NONE) {
//    session_start();
//}

require_once("khalibot_analizador.php");
require_once("../model/Chat.php");

try {
    $chat = $_POST['chat'] ?? 'Quiero comprar una propiedad';
    $chat = trim($chat);

    if ($chat === '') {
        echo json_encode(['response' => 'Por favor, escribe un mensaje.']);
        exit;
    }

    $chatModel = new Chat();

    // ----- Helpers -----
    function isBookingTrigger(string $text): bool {
        return preg_match('/\b(cita|agendar|reservar|visita)\b/i', $text) === 1;
    }

    // ----- Flujo de booking -----
    if (isset($_SESSION['booking']) && is_array($_SESSION['booking'])) {
        // ... tu código de booking existente ...
        $booking = &$_SESSION['booking'];
        $step = $booking['step'] ?? 1;
        $data = $booking['data'] ?? [];

        switch ($step) {
            case 1:
                $data['nombre'] = $chat;
                $booking['data'] = $data;
                $booking['step'] = 2;
                $reply = "Perfecto, {$data['nombre']}. ¿Cuál es tu apellido?";
                break;

            case 2:
                $data['apellido'] = $chat;
                $booking['data'] = $data;
                $booking['step'] = 3;
                $reply = "Gracias. ¿Qué tipo de documento usas? (DNI, CE, PASAPORTE)";
                break;

            case 3:
                $data['tip_doc'] = strtoupper(substr($chat, 0, 10));
                $booking['data'] = $data;
                $booking['step'] = 4;
                $reply = "Por favor, ingresa tu número de " . $data['tip_doc'] . ".";
                break;

            case 4:
                $data['dni'] = preg_replace('/\D/', '', $chat);
                $booking['data'] = $data;
                $booking['step'] = 5;
                $reply = "¿Cuál es tu correo electrónico?";
                break;

            case 5:
                $data['email'] = filter_var($chat, FILTER_SANITIZE_EMAIL);
                $booking['data'] = $data;
                $booking['step'] = 6;
                $reply = "¿Cuál es tu teléfono o celular?";
                break;

            case 6:
                $data['telefono'] = preg_replace('/\D/', '', $chat);
                $booking['data'] = $data;
                $booking['step'] = 7;
                $reply = "¿Buscas compra (venta) o alquiler?";
                break;

            case 7:
                $mod = strtolower($chat);
                $data['modalidad'] = (strpos($mod, 'alquil') !== false) ? 'A' : 'V';
                $booking['data'] = $data;
                $booking['step'] = 8;
                $reply = "¿Qué tipo de inmueble te interesa? (ej: departamento, casa, terreno).";
                break;

            case 8:
                $data['tipo_text'] = $chat;
                $booking['data'] = $data;
                $booking['step'] = 9;
                $reply = "¿En qué distrito o zona te interesa?";
                break;

            case 9:
                $data['zona'] = $chat;
                $booking['data'] = $data;
                $booking['step'] = 10;
                $reply = "Por último, agrega cualquier detalle adicional.";
                break;

            case 10:
                $data['detalle'] = $chat;
                $insertData = [
                    'nombre'    => $data['nombre'] ?? '',
                    'apellido'  => $data['apellido'] ?? '',
                    'tip_doc'   => $data['tip_doc'] ?? 'DNI',
                    'dni'       => $data['dni'] ?? '',
                    'email'     => $data['email'] ?? null,
                    'telefono'  => $data['telefono'] ?? null,
                    'modalidad' => $data['modalidad'] ?? 'V',
                    'id_t_prop' => 0,
                    'id_depart' => 0,
                    'id_provin' => 0,
                    'id_distri' => 0,
                    'detalle'   => ($data['tipo_text'] ?? '') . " | " . ($data['zona'] ?? '') . " | " . ($data['detalle'] ?? '')
                ];

                $id = $chatModel->registrarSolicitud($insertData);
                unset($_SESSION['booking']);
                $reply = "✅ Tu solicitud ha sido registrada con el número: $id.";
                break;

            default:
                unset($_SESSION['booking']);
                $reply = "Se reinició el proceso. Escribe 'quiero agendar cita' para empezar de nuevo.";
                break;
        }

        echo json_encode(['response' => $reply], JSON_UNESCAPED_UNICODE);
        exit;
    }

    // ----- Nuevo flujo -----
    if (isBookingTrigger($chat)) {
        $_SESSION['booking'] = ['step' => 1, 'data' => []];
        echo json_encode(['response' => "Perfecto, puedo ayudarte a agendar una cita. ¿Cuál es tu nombre?"], JSON_UNESCAPED_UNICODE);
        exit;
    }

    // ----- Si no es booking → OpenAI (con cache y rate limit) -----
    $result = procesarChatKhalibot($chat);
    echo json_encode(['response' => $result['respuesta'] ?? 'No entendí tu mensaje.'], JSON_UNESCAPED_UNICODE);
    exit;

} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['response' => "Error: " . $e->getMessage()], JSON_UNESCAPED_UNICODE);
}