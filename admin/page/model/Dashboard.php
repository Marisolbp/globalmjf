<?php
date_default_timezone_set('America/Bogota');

class Dashboard extends Conectar{
 
    public function obtener_solicitudes_activas(){
        $conectar= parent::conexion();
        parent::set_names();

        /*$codusu = $_SESSION['codusu'];
        if ($_SESSION['codrol'] == 1) {
            $cond_c = "1 = 1";
        } else if ($_SESSION['codrol'] == 5) {
            $cond_c = "tb_constitucion.codusu='$codusu'";
        }
        AND $cond_c";    
        */
        
        $sql="SELECT COUNT(*) total_solicitudes
        FROM g_solicitud
        WHERE g_solicitud.estado = 'A' ";

        $sql=$conectar->prepare($sql);
        $sql->execute();

        return $resultado=$sql->fetchAll();
    }

    public function obtener_total_miembros(){
        $conectar= parent::conexion();
        parent::set_names();
        
        $sql="SELECT COUNT(*) total_miembros
        FROM m_miembro";

        $sql=$conectar->prepare($sql);
        $sql->execute();

        return $resultado=$sql->fetchAll();
    }

    public function obtener_propiedades_disponibles(){
        $conectar= parent::conexion();
        parent::set_names();
        
        $sql="SELECT COUNT(*) total_propiedades
        FROM g_propi_venta";

        $sql=$conectar->prepare($sql);
        $sql->execute();

        return $resultado=$sql->fetchAll();
    }

    public function obtener_distrito_mayor_in(){
        $conectar= parent::conexion();
        parent::set_names();
        
        $sql="SELECT nombre mayor_distrito
                FROM g_independizacion
                GROUP BY nombre
                ORDER BY COUNT(*) DESC
                LIMIT 1";

        $sql=$conectar->prepare($sql);
        $sql->execute();

        return $resultado=$sql->fetchAll();
    }

    public function obtener_proyectos_en_curso(){
        $conectar= parent::conexion();
        parent::set_names();
        
        $sql="SELECT COUNT(*) total_proyectos
                FROM g_proyec_arqui";

        $sql=$conectar->prepare($sql);
        $sql->execute();

        return $resultado=$sql->fetchAll();
    }

    public function obtener_proyectos_mas_cotizado(){
        $conectar= parent::conexion();
        parent::set_names();
        
        $sql="SELECT CASE 
		                WHEN id_t_prop = 1 
                        THEN 'Casas'
                        WHEN id_t_prop = 2 
                        THEN 'Departamentos' 
                        ELSE 'Terrenos'
                     END proyectos_cotizados
                    FROM `g_proyec_arqui` 
                    GROUP BY id_t_prop
                    ORDER BY COUNT(*) DESC
                LIMIT 1 ";

        $sql=$conectar->prepare($sql);
        $sql->execute();

        return $resultado=$sql->fetchAll();
    }

}