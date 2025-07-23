<?php
date_default_timezone_set('America/Bogota');
class Propiedad extends Conectar{
    public function get_propiedad(){
        $conectar= parent::conexion();
        parent::set_names();
        $sql="SELECT
            g_propi_venta.id, 
            g_propi_venta.codigo, 
            g_propi_venta.nombre,
            g_propi_venta.descrip,
            g_propi_venta.id_depart,
            m_departamento.nombre departamento,
            g_propi_venta.id_provin,
            m_provincia.nombre provincia,
            g_propi_venta.id_distri,
            m_distrito.nombre distrito,
            g_propi_venta.direccion,
            g_propi_venta.npisos,
            g_propi_venta.ndormit,
            g_propi_venta.nbanos,
            g_propi_venta.ncochera,
            g_propi_venta.ncocina,
            g_propi_venta.nlavand,
            g_propi_venta.ndeposito,
            g_propi_venta.id_t_prop,
            m_tipo_propiedad.nombre tipo,
            CASE g_propi_venta.moneda
                WHEN 'USD' THEN '$'
                ELSE 'S/.'
            END moneda_simbolo,
            g_propi_venta.precio,
            g_propi_venta.modalidad,
            g_propi_venta.antiguedad,
            g_propi_venta.mantenimiento,
            g_propi_venta.ubicacion,
            g_propi_venta.estado_im,
            g_propi_venta.atotal,
            g_propi_venta.aconstru,
            g_propi_venta.valmcua,
            g_propi_venta.estado
            FROM
            g_propi_venta
            INNER JOIN m_tipo_propiedad ON m_tipo_propiedad.id = g_propi_venta.id_t_prop
            INNER JOIN m_departamento ON g_propi_venta.id_depart = m_departamento.id
            INNER JOIN m_provincia ON g_propi_venta.id_provin = m_provincia.id
            INNER JOIN m_distrito ON g_propi_venta.id_distri = m_distrito.id
            ORDER BY g_propi_venta.fec_crea DESC";
        // $sql="call sp_l_usuario_01()"
        $sql=$conectar->prepare($sql);
        $sql->execute();
        return $resultado=$sql->fetchAll();
    }

    public function registrar(
        $codigo, $nombre, $descrip,
        $id_depart, $id_provin, $id_distri,
        $direccion, $longitud, $latitud,
        $npisos, $ndormit, $nbanos, $ncochera, $ncocina, $nlavand, $ndeposito,
        $id_t_prop, $moneda, $precio, $valmcua, $modalidad,
        $antiguedad, $mantenimiento, $estado_im, $ubicacion,
        $atotal, $aconstru, $estado, $usuario
    ) {
        $conectar = parent::conexion();
        parent::set_names();

        // Asegurar que la conexión use UTF-8
        $conectar->exec("SET NAMES utf8mb4 COLLATE utf8mb4_unicode_ci");
    
        $sql = "INSERT INTO g_propi_venta(
            codigo, nombre, descrip,
            id_depart, id_provin, id_distri,
            direccion, longitud, latitud,
            npisos, ndormit, nbanos, ncochera, ncocina, nlavand, ndeposito,
            id_t_prop, moneda, precio, valmcua, modalidad,
            antiguedad, mantenimiento, estado_im, ubicacion,
            atotal, aconstru, estado,
            fec_crea, usu_crea, fec_actu, usu_actu
        ) VALUES (
            ?, ?, ?,
            ?, ?, ?,
            ?, ?, ?,
            ?, ?, ?, ?, ?, ?, ?,
            ?, ?, ?, ?, ?,
            ?, ?, ?, ?,
            ?, ?, ?,
            now(), ?, now(), ?
        )";
    
        $sql = $conectar->prepare($sql);
    
        // Asignar parámetros
        $sql->bindValue(1, $codigo);
        $sql->bindValue(2, $nombre);
        $sql->bindValue(3, $descrip, PDO::PARAM_STR);
        $sql->bindValue(4, $id_depart);
        $sql->bindValue(5, $id_provin);
        $sql->bindValue(6, $id_distri);
        $sql->bindValue(7, $direccion);
        $sql->bindValue(8, $longitud);
        $sql->bindValue(9, $latitud);
        $sql->bindValue(10, $npisos);
        $sql->bindValue(11, $ndormit);
        $sql->bindValue(12, $nbanos);
        $sql->bindValue(13, $ncochera);
        $sql->bindValue(14, $ncocina);
        $sql->bindValue(15, $nlavand);
        $sql->bindValue(16, $ndeposito);
        $sql->bindValue(17, $id_t_prop);
        $sql->bindValue(18, $moneda);
        $sql->bindValue(19, $precio);
        $sql->bindValue(20, $valmcua);
        $sql->bindValue(21, $modalidad);
        $sql->bindValue(22, $antiguedad);
        $sql->bindValue(23, $mantenimiento);
        $sql->bindValue(24, $estado_im);
        $sql->bindValue(25, $ubicacion);
        $sql->bindValue(26, $atotal);
        $sql->bindValue(27, $aconstru);
        $sql->bindValue(28, $estado);
        $sql->bindValue(29, $usuario);
        $sql->bindValue(30, $usuario);
    
        if ($sql->execute()) {
            $jsonData['success'] = 1;
        } else {
            $jsonData['success'] = 0;
        }
    
        header('Content-type: application/json; charset=utf-8');
        echo json_encode($jsonData);
    }
    public function propiedad_x_id($id){
        $conectar= parent::conexion();
        parent::set_names();
        $sql="SELECT
            g_propi_venta.id, 
            g_propi_venta.codigo, 
            g_propi_venta.nombre,
            g_propi_venta.descrip,
            g_propi_venta.id_depart,
            m_departamento.nombre departamento,
            g_propi_venta.id_provin,
            m_provincia.nombre provincia,
            g_propi_venta.id_distri,
            m_distrito.nombre distrito,
            g_propi_venta.direccion,
            g_propi_venta.longitud,
            g_propi_venta.latitud,
            g_propi_venta.npisos,
            g_propi_venta.ndormit,
            g_propi_venta.nbanos,
            g_propi_venta.ncochera,
            g_propi_venta.ncocina,
            g_propi_venta.nlavand,
            g_propi_venta.ndeposito,
            g_propi_venta.id_t_prop,
            m_tipo_propiedad.nombre tipo,
            g_propi_venta.moneda,
            CASE g_propi_venta.moneda
                WHEN 'USD' THEN '$'
                ELSE 'S/.'
            END moneda_simbolo,
            g_propi_venta.precio,
            g_propi_venta.modalidad,
            CASE g_propi_venta.modalidad
                WHEN 'V' THEN 'Venta'
                ELSE 'ALQUILER'
            END modalidad_nombre,
            g_propi_venta.antiguedad,
            g_propi_venta.mantenimiento,
            g_propi_venta.ubicacion,
            CASE g_propi_venta.ubicacion
                WHEN 'E' THEN 'Esquinero'
                WHEN 'ME' THEN 'Medianero'
                WHEN 'I' THEN 'Intermedio'
                WHEN 'F' THEN 'Frontal'
                WHEN 'P' THEN 'Posterior'
                ELSE 'Doble Esquinero'
            END ubicacion_nombre,
            g_propi_venta.estado_im,
            CASE g_propi_venta.estado_im
                WHEN 'B' THEN 'Bueno'
                WHEN 'R' THEN 'Regular'
                ELSE 'Malo'
            END estado_im_nombre,
            g_propi_venta.atotal,
            g_propi_venta.aconstru,
            g_propi_venta.valmcua,
            g_propi_venta.estado
            FROM
            g_propi_venta
            INNER JOIN m_tipo_propiedad ON m_tipo_propiedad.id = g_propi_venta.id_t_prop
            INNER JOIN m_departamento ON g_propi_venta.id_depart = m_departamento.id
            INNER JOIN m_provincia ON g_propi_venta.id_provin = m_provincia.id
            INNER JOIN m_distrito ON g_propi_venta.id_distri = m_distrito.id
            WHERE g_propi_venta.id = ?";
        $sql=$conectar->prepare($sql);
        $sql->bindValue(1,$id);
        $sql->execute();
        return $resultado=$sql->fetchAll();
    }

    public function editar(
        $id, $codigo, $nombre, $descrip,
        $id_depart, $id_provin, $id_distri,
        $direccion, $longitud, $latitud,
        $npisos, $ndormit, $nbanos, $ncochera, $ncocina, $nlavand, $ndeposito,
        $id_t_prop, $moneda, $precio, $valmcua, $modalidad,
        $antiguedad, $mantenimiento, $estado_im, $ubicacion,
        $atotal, $aconstru, $estado, $usuario
    ) {
        $conectar = parent::conexion();
        parent::set_names();

        // Asegurar que la conexión use UTF-8MB4 para emojis
        $conectar->exec("SET NAMES utf8mb4 COLLATE utf8mb4_unicode_ci");

        $sql = "UPDATE g_propi_venta SET
            codigo = ?, nombre = ?, descrip = ?,
            id_depart = ?, id_provin = ?, id_distri = ?,
            direccion = ?, longitud = ?, latitud = ?,
            npisos = ?, ndormit = ?, nbanos = ?, ncochera = ?, ncocina = ?, nlavand = ?, ndeposito = ?,
            id_t_prop = ?, moneda = ?, precio = ?, valmcua = ?, modalidad = ?,
            antiguedad = ?, mantenimiento = ?, estado_im = ?, ubicacion = ?,
            atotal = ?, aconstru = ?, estado = ?,
            fec_actu = now(), usu_actu = ?
            WHERE id = ?";

        $sql = $conectar->prepare($sql);

        $params = [
            $codigo, $nombre, $descrip,
            $id_depart, $id_provin, $id_distri,
            $direccion, $longitud, $latitud,
            $npisos, $ndormit, $nbanos, $ncochera, $ncocina, $nlavand, $ndeposito,
            $id_t_prop, $moneda, $precio, $valmcua, $modalidad,
            $antiguedad, $mantenimiento, $estado_im, $ubicacion,
            $atotal, $aconstru, $estado,
            $usuario, $id
        ];

        // Vincular parámetros con especial atención al campo descrip
        foreach ($params as $i => $val) {
            if ($i == 2) { // índice 2 corresponde a $descrip
                $sql->bindValue($i + 1, $val, PDO::PARAM_STR);
            } else {
                $sql->bindValue($i + 1, $val);
            }
        }

        if ($sql->execute()) {
            $jsonData['success'] = 1;
        } else {
            $jsonData['success'] = 0;
        }

        header('Content-type: application/json; charset=utf-8');
        echo json_encode($jsonData);
    }

    public function listar_foto($id_propiedad){
        $conectar = parent::conexion();
        parent::set_names();
        
        $sql = "SELECT id, ruta_imagen, nombre_original, orden FROM g_propi_venta_foto WHERE id_propi = ? ORDER BY orden ASC";
        $stmt = $conectar->prepare($sql);
        $stmt->bindValue(1, $id_propiedad);
        $stmt->execute();
        
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function verificar_archivo_existente($id_propiedad, $nombre_original) {
        $conectar = parent::conexion();
        parent::set_names();
        
        $sql_check = "SELECT COUNT(*) as total FROM g_propi_venta_foto WHERE nombre_original = ? AND id_propi = ?";
        $stmt_check = $conectar->prepare($sql_check);
        $stmt_check->bindValue(1, $nombre_original);
        $stmt_check->bindValue(2, $id_propiedad);
        $stmt_check->execute();
        $resultado_check = $stmt_check->fetch();
        
        return $resultado_check['total'] > 0;
    }

    public function obtener_ultimo_orden($id_propiedad){
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "SELECT COALESCE(MAX(orden), 0) AS ultimo_orden FROM g_propi_venta_foto WHERE id_propi = ?";
        $stmt = $conectar->prepare($sql);
        $stmt->bindValue(1, $id_propiedad);
        $stmt->execute();
        $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
        return (int)$resultado["ultimo_orden"];
    }

    public function registrar_foto($id_propi, $ruta_imagen, $nombre_original, $orden) {
        $conectar = parent::conexion();
        parent::set_names();

        try {
            $sql_ins = "INSERT INTO g_propi_venta_foto (id_propi, ruta_imagen, nombre_original, orden) VALUES (?, ?, ?, ?)";
            $sql_ins = $conectar->prepare($sql_ins);
            $sql_ins->bindValue(1, $id_propi);
            $sql_ins->bindValue(2, $ruta_imagen);
            $sql_ins->bindValue(3, $nombre_original);
            $sql_ins->bindValue(4, $orden);

            if ($sql_ins->execute()) {
                return ['success' => 1]; // Éxito
            } else {
                return ['success' => 0]; // Error
            }
        } catch (Exception $e) {
            return ['success' => 0]; // Error
        }
    }

    public function actualizar_orden_foto($id, $orden){
        $conectar = parent::conexion();
        parent::set_names();
    
        $sql = "UPDATE g_propi_venta_foto SET orden = ? WHERE id = ?";
        $stmt = $conectar->prepare($sql);
        $stmt->bindValue(1, $orden);
        $stmt->bindValue(2, $id);
    
        if ($stmt->execute()) {
            return ["success" => 1];
        } else {
            return ["success" => 0];
        }
    }

    public function eliminar($id){
        $conectar= parent::conexion();
        parent::set_names();

        $del = "DELETE FROM g_propi_venta_foto WHERE id = ?";
        $del=$conectar->prepare($del);
        $del->bindValue(1,$id);
        $del->execute();
        return $resultado = $del->fetchAll();
    }
}