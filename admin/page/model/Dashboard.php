<?php
date_default_timezone_set('America/Bogota');

class Dashboard extends Conectar{
 
    public function obtener_solicitudes_activas(){
        $conectar= parent::conexion();
        parent::set_names();
        
        $sql="SELECT COUNT(*) total_solicitudes
        FROM g_solicitud
        WHERE estado = 'A' ";

        $sql=$conectar->prepare($sql);
        $sql->execute();

        return $resultado=$sql->fetchAll();
    }

    public function obtener_total_miembros(){
        $conectar= parent::conexion();
        parent::set_names();
        
        $sql="SELECT COUNT(*) total_miembros
                FROM m_miembro
                WHERE estado = 'A'";

        $sql=$conectar->prepare($sql);
        $sql->execute();

        return $resultado=$sql->fetchAll();
    }

    public function obtener_total_propiedades(){
        $conectar= parent::conexion();
        parent::set_names();
        
        $sql="SELECT COUNT(*) total_propiedades
        FROM g_propi_venta
        WHERE estado = 'A'";

        $sql=$conectar->prepare($sql);
        $sql->execute();

        return $resultado=$sql->fetchAll();
    }

    public function obtener_total_independizacion(){
        $conectar= parent::conexion();
        parent::set_names();
        
        $sql="SELECT COUNT(*) total_independizacion
                FROM g_independizacion
                WHERE estado = 'A'";

        $sql=$conectar->prepare($sql);
        $sql->execute();

        return $resultado=$sql->fetchAll();
    }

    public function obtener_total_proyectos(){
        $conectar= parent::conexion();
        parent::set_names();
        
        $sql="SELECT COUNT(*) total_proyectos
                FROM g_proyec_arqui
                WHERE estado = 'A'";

        $sql=$conectar->prepare($sql);
        $sql->execute();

        return $resultado=$sql->fetchAll();
    }

    public function obtener_proyectos_mas_cotizado(){
        $conectar= parent::conexion();
        parent::set_names();
        
        $sql="SELECT m_tipo_propiedad.nombre proyectos_cotizados
                    FROM g_proyec_arqui
                    JOIN m_tipo_propiedad 
                    ON g_proyec_arqui.id_t_prop = m_tipo_propiedad.id
                    WHERE g_proyec_arqui.estado = 'A'
                    GROUP BY id_t_prop
                    ORDER BY COUNT(*) DESC
                LIMIT 1 ";

        $sql=$conectar->prepare($sql);
        $sql->execute();

        return $resultado=$sql->fetchAll();
    }

}