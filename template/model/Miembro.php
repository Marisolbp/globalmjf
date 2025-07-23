<?php
date_default_timezone_set('America/Bogota');
class Miembro extends Conectar{
    public function listar_miembro(){
        $conectar= parent::conexion();
        parent::set_names();
        $sql="SELECT
            id, nombre,
            apellido, puesto,
            detapuesto, codcap,
            linkedin, instagram,
            correo, contacto,
            foto, descrip, orden
            FROM 
            m_miembro
            WHERE estado = 'A'
            ORDER BY orden ASC";
        $sql=$conectar->prepare($sql);
        $sql->execute();
        return $resultado=$sql->fetchAll();
    }

    public function listar_especialidades($id_miembro){
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "SELECT especialidad FROM m_miembro_especialidad WHERE id_miembro = ?";
        $sql = $conectar->prepare($sql);
        $sql->bindValue(1, $id_miembro);
        $sql->execute();
        return $sql->fetchAll(PDO::FETCH_ASSOC);
    }
}