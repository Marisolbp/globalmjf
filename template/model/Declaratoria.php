<?php
date_default_timezone_set('America/Bogota');
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
}