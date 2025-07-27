<?php
date_default_timezone_set('America/Bogota');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exceptio;

class Inmobiliaria extends Conectar{

    public function combo_distri(){
        $conectar= parent::conexion();
        parent::set_names();
        $sql="SELECT
            m_departamento.nombre depart,
            m_distrito.id,
            m_distrito.nombre distri
            FROM 
            g_propi_venta
            INNER JOIN m_departamento ON id_depart = m_departamento.id
            INNER JOIN m_distrito ON id_distri = m_distrito.id
            WHERE g_propi_venta.estado = 'A'";
        $sql=$conectar->prepare($sql);
        $sql->execute();
        return $resultado=$sql->fetchAll();
    }
    public function combo_pisos(){
        $conectar= parent::conexion();
        parent::set_names();
        $sql="SELECT
            npisos
            FROM 
            g_propi_venta
            WHERE estado = 'A'
            AND npisos != 0
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
            g_propi_venta
            WHERE estado = 'A'
            AND ndormit != 0
            ORDER BY ndormit";
        $sql=$conectar->prepare($sql);
        $sql->execute();
        return $resultado=$sql->fetchAll();
    }

    public function rango_precio(){
        $conectar= parent::conexion();
        parent::set_names();
        $sql="SELECT 
            FLOOR(MIN(precio) / 100) * 100 AS precio_min,
            CEIL(MAX(precio) / 100) * 100 AS precio_max
            FROM 
                g_propi_venta 
            WHERE 
                estado = 'A'";
        $sql=$conectar->prepare($sql);
        $sql->execute();
        return $resultado=$sql->fetchAll();
    }

    public function mostar_tipos(){
        $conectar = parent::conexion();
        parent::set_names();

        $sql = "SELECT 
                DISTINCT m_tipo_propiedad.id,
                m_tipo_propiedad.nombre 
                FROM g_propi_venta
                INNER JOIN m_tipo_propiedad ON m_tipo_propiedad.id = g_propi_venta.id_t_prop
                WHERE g_propi_venta.estado = 'A';";

        $stmt = $conectar->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function listar_inmobiliaria($params = []) {
        $conectar = parent::conexion();
        parent::set_names();

        $where = "WHERE p.estado = 'A'";

        if (isset($params['id_t_prop']) && $params['id_t_prop'] !== '') {
            $where .= " AND p.id_t_prop = " . intval($params['id_t_prop']);
        }

        $sql = "SELECT 
                    p.id,
                    p.nombre,
                    p.direccion,
                    p.id_depart,
                    dp.nombre depart,
                    p.id_distri,
                    dt.nombre distrito,
                    p.ndormit,
                    p.nbanos,
                    p.npisos,
                    p.atotal AS area,
                    p.precio,
                    p.estado_im,
                    p.moneda,
                    p.modalidad,
                    p.id_t_prop,
                    tp.nombre AS tipo_propiedad,
                    (SELECT ruta_imagen FROM g_propi_venta_foto 
                    WHERE id_propi = p.id 
                    ORDER BY orden ASC LIMIT 1) AS ruta_imagen
                FROM g_propi_venta p
                INNER JOIN m_tipo_propiedad tp ON p.id_t_prop = tp.id
                INNER JOIN m_distrito dt ON p.id_distri = dt.id
                INNER JOIN m_departamento dp ON p.id_depart = dp.id
                $where
                ORDER BY RAND()
                LIMIT 6";

        $stmt = $conectar->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $result;
    }
    
    public function mostrar_inmobiliaria($params = []) {
        $conectar = parent::conexion();
        parent::set_names();

        $where = "WHERE p.estado = 'A'";

        if (isset($params['id_t_prop']) && $params['id_t_prop'] !== '') {
            $where .= " AND p.id_t_prop = " . intval($params['id_t_prop']);
        }

        if (isset($params['modalidad']) && $params['modalidad'] !== '') {
            $where .= " AND p.modalidad = '" . $params['modalidad'] . "'";
        }

        if (isset($params['id_distri']) && $params['id_distri'] !== '') {
            $where .= " AND p.id_distri = " . intval($params['id_distri']);
        }

        if (isset($params['atotal']) && $params['atotal'] !== '') {
            $areaParts = explode("-", $params['atotal']);
            $min = isset($areaParts[0]) ? intval($areaParts[0]) : 0;
            $max = isset($areaParts[1]) && $areaParts[1] !== '' ? intval($areaParts[1]) : null;

            if ($max === null || $max === 0) {
                $where .= " AND p.atotal >= $min";
            } else {
                $where .= " AND p.atotal BETWEEN $min AND $max";
            }
        }

        if (isset($params['npisos']) && $params['npisos'] !== '') {
            $where .= " AND p.npisos = " . intval($params['npisos']);
        }

        if (isset($params['ndormit']) && $params['ndormit'] !== '') {
            $where .= " AND p.ndormit = " . intval($params['ndormit']);
        }

        if (isset($params['precio_min']) && isset($params['precio_max'])) {
            $precio_min = floatval($params['precio_min']);
            $precio_max = floatval($params['precio_max']);

            if ($precio_min > 0 || $precio_max < 999999999) {
                $where .= " AND p.precio BETWEEN $precio_min AND $precio_max";
            }
        }

        // 1️⃣ Primero obtenemos el total sin LIMIT
        $sql_count = "SELECT COUNT(*) as total FROM g_propi_venta p
            INNER JOIN m_tipo_propiedad tp ON p.id_t_prop = tp.id
            INNER JOIN m_distrito dt ON p.id_distri = dt.id
            INNER JOIN m_departamento dp ON p.id_depart = dp.id
            $where";
        
        $stmt_count = $conectar->prepare($sql_count);
        $stmt_count->execute();
        $total = $stmt_count->fetchColumn();

        $sql = "SELECT 
                    p.id,
                    p.nombre,
                    p.direccion,
                    p.id_depart,
                    dp.nombre depart,
                    p.id_distri,
                    dt.nombre distrito,
                    p.ndormit,
                    p.nbanos,
                    p.npisos,
                    p.atotal AS area,
                    p.precio,
                    p.estado_im,
                    p.moneda,
                    p.modalidad,
                    p.id_t_prop,
                    tp.nombre AS tipo_propiedad,
                    (SELECT ruta_imagen FROM g_propi_venta_foto 
                    WHERE id_propi = p.id 
                    ORDER BY orden ASC LIMIT 1) AS ruta_imagen
                FROM g_propi_venta p
                INNER JOIN m_tipo_propiedad tp ON p.id_t_prop = tp.id
                INNER JOIN m_distrito dt ON p.id_distri = dt.id
                INNER JOIN m_departamento dp ON p.id_depart = dp.id
                $where
                ORDER BY p.id DESC
                LIMIT :limit OFFSET :offset";

        $stmt = $conectar->prepare($sql);
        $limit = isset($params['limit']) ? intval($params['limit']) : 15;
        $offset = isset($params['offset']) ? intval($params['offset']) : 0;
        $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
        $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return [
            'total' => $total,
            'data' => $result
        ];
    }

    public function info_propiedad($id){
        $conectar= parent::conexion();
        parent::set_names();
        $sql="SELECT 
                p.id,
                p.codigo,
                p.nombre,
                p.descrip,
                p.direccion,
                p.id_distri,
                dt.nombre distrito,
                p.npisos,
                p.ndormit,
                p.nbanos,
                p.ncochera,
                p.ncocina,
                p.nlavand,
                p.ndeposito,
                p.antiguedad,
                p.mantenimiento,
                p.atotal AS area,
                p.aconstru,
                p.precio,
                CASE 
                    WHEN p.estado_im = 'B' THEN 'Bueno'
                    WHEN p.estado_im = 'R' THEN 'Regular'
                    WHEN p.estado_im = 'M' THEN 'Malo'
                END AS estado_im,
                p.moneda,
                p.modalidad,
                p.longitud,
                p.latitud,
                p.valmcua,
                p.ubicacion,
                p.id_t_prop,
                tp.nombre AS tipo_propiedad
            FROM g_propi_venta p
            INNER JOIN m_tipo_propiedad tp ON p.id_t_prop = tp.id
            INNER JOIN m_distrito dt ON p.id_distri = dt.id
            WHERE p.id = ?";
        $sql=$conectar->prepare($sql);
        $sql->bindValue(1,$id);
        $sql->execute();
        return $resultado=$sql->fetchAll();
    }

    public function fotos_x_inmobiliaria($id_inmobiliaria) {
        $conectar = parent::conexion();
        parent::set_names();
        
        $sql = "SELECT 
                    g_propi_venta_foto.id,
                    g_propi_venta_foto.orden,
                    g_propi_venta_foto.ruta_imagen,
                    g_propi_venta.nombre inmobiliaria_nombre,
                    m_tipo_propiedad.nombre tipo_propiedad
                FROM g_propi_venta_foto
                INNER JOIN g_propi_venta ON g_propi_venta.id = g_propi_venta_foto.id_propi
                INNER JOIN m_tipo_propiedad ON m_tipo_propiedad.id = g_propi_venta.id_t_prop
                WHERE id_propi = ?
                ORDER BY orden ASC";
        
        $stmt = $conectar->prepare($sql);
        $stmt->bindValue(1, $id_inmobiliaria);
        $stmt->execute();
        
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function propiedad_relacionado($id_inmobiliaria) {
        $conectar = parent::conexion();
        parent::set_names();

        // Obtener datos base del proyecto
        $proyect = "SELECT 
                        id_t_prop,
                        npisos,
                        ndormit,
                        nbanos
                    FROM g_propi_venta 
                    WHERE id=?";
        $proyect = $conectar->prepare($proyect);
        $proyect->bindValue(1, $id_inmobiliaria);
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
                    p.id_depart,
                    dp.nombre depart,
                    p.id_distri,
                    dt.nombre distrito,
                    p.modalidad,
                    p.moneda,
                    p.precio,
                    p.descrip,
                    p.npisos,
                    p.ndormit,
                    p.nbanos,
                    p.atotal AS area,
                    tp.nombre AS tipo_propiedad,
                    (SELECT ruta_imagen FROM g_propi_venta_foto 
                    WHERE id_propi = p.id 
                    ORDER BY orden ASC LIMIT 1) AS ruta_imagen
                FROM g_propi_venta p
                INNER JOIN m_tipo_propiedad tp ON p.id_t_prop = tp.id
                INNER JOIN m_distrito dt ON p.id_distri = dt.id
                INNER JOIN m_departamento dp ON p.id_depart = dp.id
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
        $sql->bindValue(2, $id_inmobiliaria);
        $sql->bindValue(3, $npisos);
        $sql->bindValue(4, $npisos);
        $sql->bindValue(5, $ndormit);
        $sql->bindValue(6, $ndormit);
        $sql->bindValue(7, $nbanos);
        $sql->bindValue(8, $nbanos);
        $sql->execute();

        return $sql->fetchAll(PDO::FETCH_ASSOC);
    }

    public function enviar_formulario($id_inmobiliaria,$nombre,$telefono,$correo,$mensaje) {
        require '../../vendor/autoload.php';
        $conectar = parent::conexion();
        parent::set_names();

        // Obtener información de la solicitud
        $sql = "SELECT nombre
                FROM g_propi_venta
                WHERE id = ?";
        $stmt = $conectar->prepare($sql);
        $stmt->bindValue(1, $id_inmobiliaria);
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
            $mail->Subject = 'Consulta de inmobiliaria';
            $mail->isHTML(true);
    
            $mail->Body = '
            <h3>Se ha registrado una consulta sobre una propiedad</h3>
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

