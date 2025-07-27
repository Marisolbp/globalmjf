<?php
date_default_timezone_set('America/Bogota');

ini_set('display_errors', 1);
error_reporting(E_ALL);

class Propiedad extends Conectar{
    public function listar_tipos(){
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
}