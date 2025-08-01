<?php
date_default_timezone_set('America/Bogota');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exceptio;

class Proyecto extends Conectar{

    public function combo_pisos(){
        $conectar= parent::conexion();
        parent::set_names();
        $sql="SELECT
            npisos
            FROM 
            g_proyec_arqui
            WHERE estado = 'A'
            ORDER BY npisos";
        $sql=$conectar->prepare($sql);
        $sql->execute();
        return $resultado=$sql->fetchAll();
    }

    public function combo_dormitorios(){
        $conectar= parent::conexion();
        parent::set_names();
        $sql="SELECT
            ndormit
            FROM 
            g_proyec_arqui
            WHERE estado = 'A'
            AND ndormit != 0
            ORDER BY ndormit";
        $sql=$conectar->prepare($sql);
        $sql->execute();
        return $resultado=$sql->fetchAll();
    }

    public function listar_proyectos($params = []) {
        $conectar = parent::conexion();
        parent::set_names();

        $where = "WHERE p.estado = 'A'";

        // Debug: Ver qué parámetros están llegando
        error_log("Parámetros recibidos: " . print_r($params, true));

        // Filtro por tipo de propiedad
        if (isset($params['id_t_prop']) && $params['id_t_prop'] !== '' && $params['id_t_prop'] !== null) {
            $where .= " AND p.id_t_prop = " . intval($params['id_t_prop']);
            error_log("Aplicando filtro id_t_prop: " . $params['id_t_prop']);
        }

        // Filtro por área
        if (isset($params['area']) && $params['area'] !== '' && $params['area'] !== null) {
            $areaParts = explode("-", $params['area']);
            $min = isset($areaParts[0]) ? intval($areaParts[0]) : 0;
            $max = isset($areaParts[1]) && $areaParts[1] !== '' ? intval($areaParts[1]) : null;

            if ($max === null || $max === 0) {
                $where .= " AND p.area >= $min";
            } else {
                $where .= " AND p.area BETWEEN $min AND $max";
            }
            error_log("Aplicando filtro area: " . $params['area']);
        }

        // Filtro por pisos
        if (isset($params['npisos']) && $params['npisos'] !== '' && $params['npisos'] !== null) {
            $where .= " AND p.npisos = " . intval($params['npisos']);
            error_log("Aplicando filtro npisos: " . $params['npisos']);
        }

        // Filtro por dormitorios
        if (isset($params['ndormit']) && $params['ndormit'] !== '' && $params['ndormit'] !== null) {
            $where .= " AND p.ndormit = " . intval($params['ndormit']);
            error_log("Aplicando filtro ndormit: " . $params['ndormit']);
        }

        $sql = "SELECT 
                p.id,
                p.nombre,
                p.descrip,
                p.npisos,
                p.ndormit,
                p.nbanos,
                p.area,
                tp.nombre AS tipo_propiedad,
                    (SELECT ruta_imagen FROM g_proyec_arqui_foto 
                    WHERE id_proyec = p.id 
                    ORDER BY orden ASC LIMIT 1) AS ruta_imagen
                FROM g_proyec_arqui p
                INNER JOIN m_tipo_propiedad tp ON p.id_t_prop = tp.id
                $where
                ORDER BY p.id DESC";

        error_log("SQL generado: " . $sql);

        $stmt = $conectar->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        error_log("Resultados encontrados: " . count($result));
        
        return $result;
    }

    public function info_proyecto($id){
        $conectar= parent::conexion();
        parent::set_names();
        $sql="SELECT 
                p.id,
                p.nombre,
                p.descrip,
                p.npisos,
                p.ndormit,
                p.nbanos,
                p.area,
                p.aconstru,
                p.id_t_prop,
                tp.nombre AS tipo_propiedad
            FROM g_proyec_arqui p
            INNER JOIN m_tipo_propiedad tp ON p.id_t_prop = tp.id
            WHERE p.id = ?";
        $sql=$conectar->prepare($sql);
        $sql->bindValue(1,$id);
        $sql->execute();
        return $resultado=$sql->fetchAll();
    }

    public function fotos_x_proyecto($id_proyec) {
        $conectar = parent::conexion();
        parent::set_names();
        
        $sql = "SELECT 
                    g_proyec_arqui_foto.id,
                    g_proyec_arqui_foto.orden,
                    g_proyec_arqui_foto.ruta_imagen,
                    g_proyec_arqui.nombre proyecto_nombre,
                    m_tipo_propiedad.nombre tipo_propiedad
                FROM g_proyec_arqui_foto
                INNER JOIN g_proyec_arqui ON g_proyec_arqui.id = g_proyec_arqui_foto.id_proyec
                INNER JOIN m_tipo_propiedad ON m_tipo_propiedad.id = g_proyec_arqui.id_t_prop
                WHERE id_proyec = ?
                ORDER BY orden ASC";
        
        $stmt = $conectar->prepare($sql);
        $stmt->bindValue(1, $id_proyec);
        $stmt->execute();
        
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function proyecto_relazionado($id_proyec) {
        $conectar = parent::conexion();
        parent::set_names();

        // Obtener datos base del proyecto
        $proyect = "SELECT 
                        id_t_prop,
                        npisos,
                        ndormit,
                        nbanos
                    FROM g_proyec_arqui 
                    WHERE id=?";
        $proyect = $conectar->prepare($proyect);
        $proyect->bindValue(1, $id_proyec);
        $proyect->execute();
        $result = $proyect->fetch();

        $id_t_prop = $result["id_t_prop"];
        $npisos    = $result["npisos"];
        $ndormit   = $result["ndormit"];
        $nbanos    = $result["nbanos"];

        // Consulta con coincidencias opcionales
        $sql = "SELECT 
                    p.id,
                    p.nombre,
                    p.descrip,
                    p.npisos,
                    p.ndormit,
                    p.nbanos,
                    p.area,
                    tp.nombre AS tipo_propiedad,
                    (SELECT ruta_imagen FROM g_proyec_arqui_foto 
                    WHERE id_proyec = p.id 
                    ORDER BY orden ASC LIMIT 1) AS ruta_imagen
                FROM g_proyec_arqui p
                INNER JOIN m_tipo_propiedad tp ON p.id_t_prop = tp.id
                WHERE p.estado = 'A' 
                AND p.id_t_prop = ?
                AND p.id != ?
                AND (
                    (? = 0 OR p.npisos = ?) OR 
                    (? = 0 OR p.ndormit = ?) OR 
                    (? = 0 OR p.nbanos = ?) OR
                    1 = 1
                )
                ORDER BY RAND()
                LIMIT 9";

        $sql = $conectar->prepare($sql);
        $sql->bindValue(1, $id_t_prop);
        $sql->bindValue(2, $id_proyec);
        $sql->bindValue(3, $npisos);
        $sql->bindValue(4, $npisos);
        $sql->bindValue(5, $ndormit);
        $sql->bindValue(6, $ndormit);
        $sql->bindValue(7, $nbanos);
        $sql->bindValue(8, $nbanos);
        $sql->execute();

        return $sql->fetchAll(PDO::FETCH_ASSOC);
    }

    public function enviar_formulario($id_proyecto,$nombre,$telefono,$correo,$mensaje) {
        require '../../vendor/autoload.php';
        $conectar = parent::conexion();
        parent::set_names();

        // Obtener información de la solicitud
        $sql = "SELECT nombre
                FROM g_proyec_arqui
                WHERE id = ?";
        $stmt = $conectar->prepare($sql);
        $stmt->bindValue(1, $id_proyecto);
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
            $mail->Subject = 'Consulta de proyecto';
            $mail->isHTML(true);
    
            $mail->Body = '
            <h3>Se ha registrado una consulta sobre un proyecto</h3>
            <p><strong>Nombre de proyecto:</strong> ' . $data['nombre'] . '</p>
            <p><strong>Nombre:</strong> ' . $nombre . '</p>
            <p><strong>Teléfono:</strong> ' . $telefono . '</p>
            <p><strong>Email:</strong> ' . $correo . '</p>
            <p><strong>Consulta:</strong> ' . $mensaje . '</p>
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

