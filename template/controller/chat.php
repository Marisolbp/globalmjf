<?php
header('Content-Type: application/json; charset=utf-8');

try {
    // Incluir el analizador
    require_once("khalibot_analizador.php");
    require_once("../config/conexion.php");

    $_chat = $_POST['chat'];
    
    // Verificar que lleguen los datos
    if (!isset($_chat) || empty(trim($_chat))) {
        echo json_encode(['response' => 'Por favor, escribe un mensaje.']);
        exit;
    }

    $chat = trim($_chat);

    // Procesar el mensaje con Khalibot
    $resultado = procesarChatKhalibot($chat);

    // Retornar respuesta
    echo json_encode($resultado);

} catch (Exception $e) {
    echo json_encode([
        'response' => 'Lo siento, hubo un error interno. Por favor, intenta de nuevo.',
        'error' => $e->getMessage()
    ]);
}
?>