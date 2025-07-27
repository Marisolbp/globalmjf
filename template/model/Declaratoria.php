<?php
date_default_timezone_set('America/Bogota');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exceptio;

class Declaratoria extends Conectar{
    public function mostrar_datos(){
        $conectar= parent::conexion();
        parent::set_names();
        $sql="SELECT 
            descrip_decla,
            descrip_indep
            FROM 
            m_independizacion";
        $sql=$conectar->prepare($sql);
        $sql->execute();
        return $resultado=$sql->fetchAll();
    }

    public function enviar_formulario($nombre,$correo,$asunto,$consulta) {
        require '../../vendor/autoload.php';
        $conectar = parent::conexion();
        parent::set_names();

        // Obtener el correo destino desde m_configuracion
        $sql2 = "SELECT correo FROM m_configuracion";
        $correo_destino = $conectar->query($sql2)->fetchColumn();

        // Preparar el correo
        $mail = new PHPMailer(true);
    
        try {
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'jflabiomorenoc@gmail.com';
            $mail->Password = 'djoa ehwz vwbe pvae';
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 587;
    
            $mail->setFrom('jflabiomorenoc@gmail.com', 'Alerta');
            $mail->addAddress($correo_destino, 'Administrador');
            $mail->Subject = 'Consulta de declaratoria';
            $mail->isHTML(true);
    
            $mail->Body = '
            <h3>Se ha registrado una consulta de declaratoria</h3>
            <p><strong>Nombre:</strong> ' . $nombre . '</p>
            <p><strong>Email:</strong> ' . $correo . '</p>
            <p><strong>Asunto:</strong> ' . $asunto . '</p>
            <p><strong>Consulta:</strong> ' . $consulta . '</p>
            ';

            $mail->send();

            $jsonData['success'] = 1;

            header('Content-type: application/json; charset=utf-8');
            echo json_encode($jsonData);

        } catch (Exception $e) {
            error_log("Error al enviar el correo: {$mail->ErrorInfo}");
        }
    }
}