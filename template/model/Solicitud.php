<?php

date_default_timezone_set('America/Bogota');
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exceptio;
class Solicitud extends Conectar{
    public function get_tip_prop(){
        $conectar= parent::conexion();
        parent::set_names();
        $sql="SELECT
            id, 
            nombre
            FROM 
            m_tipo_propiedad
            WHERE estado = 'A'";
        $sql=$conectar->prepare($sql);
        $sql->execute();
        return $resultado=$sql->fetchAll();
    }

    public function get_depart(){
        $conectar= parent::conexion();
        parent::set_names();
        $sql="SELECT 
        m_departamento.id,
        m_departamento.nombre
        FROM m_departamento";
        $sql=$conectar->prepare($sql);
        $sql->execute();
        return $resultado=$sql->fetchAll();
    }

    public function get_provin($id_depart){
        $conectar= parent::conexion();
        parent::set_names();
        $sql="SELECT 
        m_provincia.id,
        m_provincia.nombre
        FROM m_provincia
        WHERE id_depart = ?";
        $sql=$conectar->prepare($sql);
        $sql->bindValue(1, $id_depart);
        $sql->execute();
        return $resultado=$sql->fetchAll();
    }

    public function get_dist_prov($id_provin){
        $conectar= parent::conexion();
        parent::set_names();
        $sql="SELECT 
        m_distrito.id,
        m_distrito.id_depart,
        m_distrito.id_provin,
        m_distrito.nombre
        FROM m_distrito
        WHERE m_distrito.id_provin = ?";
        $sql=$conectar->prepare($sql);
        $sql->bindValue(1, $id_provin);
        $sql->execute();
        return $resultado=$sql->fetchAll();
    }

    public function registrar_solicitud($tip_doc,$dni,$nombre,$apellido,$email,$telefono,$modalidad,$id_t_prop,$id_depart,$id_provin,$id_distri,$detalle){
        $conectar= parent::conexion();
        parent::set_names();

        // Asegurar que la conexión use UTF-8
        $conectar->exec("SET NAMES utf8mb4 COLLATE utf8mb4_unicode_ci");
        
        $sql = "INSERT INTO g_solicitud(nombre,apellido,tip_doc,email,dni,telefono,modalidad,id_t_prop,id_depart,id_provin,id_distri,detalle,
        estado,fec_crea,usu_crea,fec_actu,usu_actu) 
        VALUES (?,?,?,?,?,?,?,?,?,?,?,?,'P',now(),'web',now(),'web')";
        $sql = $conectar->prepare($sql);
        $sql->bindValue(1, $nombre);
        $sql->bindValue(2, $apellido);
        $sql->bindValue(3, $tip_doc);
        $sql->bindValue(4, $email);
        $sql->bindValue(5, $dni);
        $sql->bindValue(6, $telefono);
        $sql->bindValue(7, $modalidad);
        $sql->bindValue(8, $id_t_prop);
        $sql->bindValue(9, $id_depart);
        $sql->bindValue(10, $id_provin);
        $sql->bindValue(11, $id_distri);
        $sql->bindValue(12, $detalle);

        if ($sql->execute()) {
            $id_solicitud = $conectar->lastInsertId();
            $this->enviarCorreoSolicitud($id_solicitud); // Llamar a la función
            $jsonData['success'] = 1;
        } else {
            $jsonData['success'] = 0;
        }

        header('Content-type: application/json; charset=utf-8');
        echo json_encode($jsonData);
    }

    public function enviarCorreoSolicitud($id_solicitud) {
        require '../../vendor/autoload.php';
        $conectar = parent::conexion();
        parent::set_names();

        // Obtener información de la solicitud
        $sql = "SELECT gs.nombre, gs.apellido, gs.email, gs.telefono, 
                CASE 
                    WHEN gs.modalidad = 'A' THEN 'Alquiler'
                    WHEN gs.modalidad = 'V' THEN 'Venta'
                END modalidad, tp.nombre AS tipo_prop 
                FROM g_solicitud gs
                INNER JOIN m_tipo_propiedad tp ON gs.id_t_prop = tp.id
                WHERE gs.id = ?";
        $stmt = $conectar->prepare($sql);
        $stmt->bindValue(1, $id_solicitud);
        $stmt->execute();
        $data = $stmt->fetch(PDO::FETCH_ASSOC);

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
            $mail->Subject = 'Registro de solicitud';
            $mail->isHTML(true);
    
            $mail->Body = '
            <h3>Se ha registrado una nueva solicitud</h3>
            <p><strong>Nombre:</strong> ' . $data['nombre'] . ' ' . $data['apellido'] . '</p>
            <p><strong>Email:</strong> ' . $data['email'] . '</p>
            <p><strong>Teléfono:</strong> ' . $data['telefono'] . '</p>
            <p><strong>Modalidad:</strong> ' . $data['modalidad'] . '</p>
            <p><strong>Tipo de Propiedad:</strong> ' . $data['tipo_prop'] . '</p>
            ';

            $mail->send();
        } catch (Exception $e) {
            error_log("Error al enviar el correo: {$mail->ErrorInfo}");
        }
    }
}