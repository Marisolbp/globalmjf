<?php

date_default_timezone_set('America/Bogota');
class Solicitud extends Conectar{
    public function get_tip_prop(){
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

    public function get_depart(){
        $conectar= parent::conexion();
        parent::set_names();
        $sql="SELECT 
        m_departamento.id,
        m_departamento.nombre
        FROM m_departamento";
        $sql=$conectar->prepare($sql);
        $sql->execute();
        return $resultado=$sql->fetchAll();
    }

    public function get_provin($id_depart){
        $conectar= parent::conexion();
        parent::set_names();
        $sql="SELECT 
        m_provincia.id,
        m_provincia.nombre
        FROM m_provincia
        WHERE id_depart = ?";
        $sql=$conectar->prepare($sql);
        $sql->bindValue(1, $id_depart);
        $sql->execute();
        return $resultado=$sql->fetchAll();
    }

    public function get_dist_prov($id_provin){
        $conectar= parent::conexion();
        parent::set_names();
        $sql="SELECT 
        m_distrito.id,
        m_distrito.id_depart,
        m_distrito.id_provin,
        m_distrito.nombre
        FROM m_distrito
        WHERE m_distrito.id_provin = ?";
        $sql=$conectar->prepare($sql);
        $sql->bindValue(1, $id_provin);
        $sql->execute();
        return $resultado=$sql->fetchAll();
    }
}