<?php
date_default_timezone_set('America/Bogota');
class Proyecto extends Conectar{
    public function listar_proyectos() {
        $conectar = parent::conexion();
        parent::set_names();

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
            ORDER BY p.id DESC";

        $stmt = $conectar->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
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
}

