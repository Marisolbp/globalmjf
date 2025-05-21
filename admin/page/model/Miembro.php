<?php
date_default_timezone_set('America/Bogota');
class Miembro extends Conectar{
    public function get_miembro(){
        $conectar= parent::conexion();
        parent::set_names();
        $sql="SELECT
            id, 
            nombre,
            apellido,
            puesto,
            linkedin,
            instagram,
            correo,
            foto,
            descrip,
            orden,
            estado
            FROM 
            m_miembro
            ORDER BY orden DESC";
        // $sql="call sp_l_usuario_01()"
        $sql=$conectar->prepare($sql);
        $sql->execute();
        return $resultado=$sql->fetchAll();
    }
    public function registrar($nombre, $apellido, $puesto, $linkedin, $instagram, $correo, $descrip, $orden, $estado, $foto, $usuario){
        $conectar= parent::conexion();
        parent::set_names();
        
        $sql = "INSERT INTO m_miembro(nombre,apellido,puesto,linkedin,instagram,correo,descrip,orden,estado,foto,fec_crea,usu_crea,fec_actu,usu_actu) 
        VALUES (?,?,?,?,?,?,?,?,?,?,now(),?,now(),?)";
        $sql = $conectar->prepare($sql);
        $sql->bindValue(1, $nombre);
        $sql->bindValue(2, $apellido);
        $sql->bindValue(3, $puesto);
        $sql->bindValue(4, $linkedin);
        $sql->bindValue(5, $instagram);
        $sql->bindValue(6, $correo);
        $sql->bindValue(7, $descrip);
        $sql->bindValue(8, $orden);
        $sql->bindValue(9, $estado);
        $sql->bindValue(10, $foto, PDO::PARAM_LOB);
        $sql->bindValue(11, $usuario);
        $sql->bindValue(12, $usuario);

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
    public function miembro_x_id($id){
        $conectar= parent::conexion();
        parent::set_names();
        $sql="SELECT 
            id,
            nombre,
            apellido,
            correo,
            puesto,
            instagram,
            linkedin,
            descrip,
            orden,
            estado,
            foto
            FROM 
            m_miembro
            WHERE id = ?";
        $sql=$conectar->prepare($sql);
        $sql->bindValue(1,$id);
        $sql->execute();
        return $resultado=$sql->fetchAll();
    }
    public function editar($id, $nombre, $apellido, $puesto, $linkedin, $instagram, $correo, $descrip, $orden, $estado, $foto, $usuario){
        $conectar= parent::conexion();
        parent::set_names();

        if ($foto !== null) {
            $sql = "UPDATE m_miembro SET nombre=?, apellido=?, puesto=?, linkedin=?, instagram=?, correo=?, descrip=?, orden=?, estado=?, foto=?, fec_actu=now(), usu_actu=? WHERE id=?";
            $sql = $conectar->prepare($sql);
            $sql->bindValue(1, $nombre);
            $sql->bindValue(2, $apellido);
            $sql->bindValue(3, $puesto);
            $sql->bindValue(4, $linkedin);
            $sql->bindValue(5, $instagram);
            $sql->bindValue(6, $correo);
            $sql->bindValue(7, $descrip);
            $sql->bindValue(8, $orden);
            $sql->bindValue(9, $estado);
            $sql->bindValue(10, $foto, PDO::PARAM_LOB);
            $sql->bindValue(11, $usuario);
            $sql->bindValue(12, $id);
        } else {
            $sql = "UPDATE m_miembro SET nombre=?, apellido=?, puesto=?, linkedin=?, instagram=?, correo=?, descrip=?, orden=?, estado=?, fec_actu=now(), usu_actu=? WHERE id=?";
            $sql = $conectar->prepare($sql);
            $sql->bindValue(1, $nombre);
            $sql->bindValue(2, $apellido);
            $sql->bindValue(3, $puesto);
            $sql->bindValue(4, $linkedin);
            $sql->bindValue(5, $instagram);
            $sql->bindValue(6, $correo);
            $sql->bindValue(7, $descrip);
            $sql->bindValue(8, $orden);
            $sql->bindValue(9, $estado);
            $sql->bindValue(10, $usuario);
            $sql->bindValue(11, $id);
        }
    
        if($sql->execute()){
            $jsonData['success'] = 1;
        } else {
            $jsonData['success'] = 0;
        }
    
        header('Content-type: application/json; charset=utf-8');
        echo json_encode($jsonData);
    }
    public function actualizar_orden($id, $orden){
        $conectar = parent::conexion();
        parent::set_names();
    
        $sql = "UPDATE m_miembro SET orden = ? WHERE id = ?";
        $stmt = $conectar->prepare($sql);
        $stmt->bindValue(1, $orden);
        $stmt->bindValue(2, $id);
    
        if ($stmt->execute()) {
            return ["success" => 1];
        } else {
            return ["success" => 0];
        }
    }
}