<?php
date_default_timezone_set('America/Bogota');
class Nosotros extends Conectar{
    public function mostrar_datos(){
        $conectar= parent::conexion();
        parent::set_names();
        $sql="SELECT 
            quienes_somos,
            vision,
            mision
            FROM 
            m_nosotros";
        $sql=$conectar->prepare($sql);
        $sql->execute();
        return $resultado=$sql->fetchAll();
    }

    public function informacion_principal() {
        $conectar = parent::conexion();
        parent::set_names();
    
        $sql = "SELECT * FROM m_configuracion LIMIT 1";
        $stmt = $conectar->prepare($sql);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}