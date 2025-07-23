<?php
date_default_timezone_set('America/Bogota');
class Inmobiliaria extends Conectar{
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
    
    public function listar_inmobiliaria($id_t_prop) {
    $conectar = parent::conexion();
    parent::set_names();

    $filtro = ($id_t_prop == 0) ? "1=1" : "p.id_t_prop = :id_t_prop";

    $sql = "SELECT 
                p.id,
                p.nombre,
                p.direccion,
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
            WHERE p.estado = 'A' AND $filtro
            ORDER BY p.id DESC";

    $stmt = $conectar->prepare($sql);

    if ($id_t_prop != 0) {
        $stmt->bindParam(':id_t_prop', $id_t_prop, PDO::PARAM_INT);
    }

    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
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
}

