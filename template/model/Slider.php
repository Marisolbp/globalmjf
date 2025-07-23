<?php
date_default_timezone_set('America/Bogota');
class Slider extends Conectar{
    public function listar_foto_slider(){
        $conectar= parent::conexion();
        parent::set_names();
        $sql="SELECT
            id, 
            foto,
            titulo,
            subtitulo,
            orden
            FROM 
            m_foto_slider
            ORDER BY orden ASC";
        $sql=$conectar->prepare($sql);
        $sql->execute();
        return $resultado=$sql->fetchAll();
    }
}