<?php
date_default_timezone_set('America/Bogota');
class Tipo_propiedad extends Conectar{
    public function get_tipo_propiedad(){
        $conectar= parent::conexion();
        parent::set_names();
        $sql="SELECT
            id, 
            nombre,
            estado
            FROM 
            m_tipo_propiedad";
        // $sql="call sp_l_usuario_01()"
        $sql=$conectar->prepare($sql);
        $sql->execute();
        return $resultado=$sql->fetchAll();
    }

    public function registrar($nombre, $estado){
        $conectar= parent::conexion();
        parent::set_names();
        
        $sql = "INSERT INTO m_tipo_propiedad(nombre, estado) 
        VALUES (?,?)";
        $sql = $conectar->prepare($sql);
        $sql->bindValue(1, $nombre);
        $sql->bindValue(2, $estado);

        if( $sql->execute()){
            //Si hay datos entonces retornas algo
            $jsonData['success'] = 1;
        }
        else {
            $jsonData['success'] = 0;
        } 
        
        //Mostrando mi respuesta en formato Json
        header('Content-type: application/json; charset=utf-8');
        echo json_encode( $jsonData );   
    }

    public function tipo_propiedad_x_id($id){
        $conectar= parent::conexion();
        parent::set_names();
        $sql="SELECT 
            id,
            nombre,
            estado
            FROM 
            m_tipo_propiedad
            WHERE id = ?";
        $sql=$conectar->prepare($sql);
        $sql->bindValue(1,$id);
        $sql->execute();
        return $resultado=$sql->fetchAll();
    }

    public function editar($id, $nombre, $estado){
        $conectar= parent::conexion();
        parent::set_names();

        $sql = "UPDATE m_tipo_propiedad SET nombre=?, estado=? WHERE id=?";
        $sql = $conectar->prepare($sql);
        $sql->bindValue(1, $nombre);
        $sql->bindValue(2, $estado);
        $sql->bindValue(3, $id);

        if($sql->execute()){
            $jsonData['success'] = 1;
        } else {
            $jsonData['success'] = 0;
        }
    
        header('Content-type: application/json; charset=utf-8');
        echo json_encode($jsonData);
    }

    public function get_tipo_pro(){
        $conectar= parent::conexion();
        parent::set_names();
        $sql="SELECT 
        m_tipo_propiedad.id,
        m_tipo_propiedad.nombre
        FROM m_tipo_propiedad
        WHERE m_tipo_propiedad.estado = 'A'";
        $sql=$conectar->prepare($sql);
        $sql->execute();
        return $resultado=$sql->fetchAll();
    }

}