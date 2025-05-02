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
}