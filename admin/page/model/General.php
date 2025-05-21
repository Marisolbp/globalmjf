<?php
date_default_timezone_set('America/Bogota');
class General extends Conectar{
    
    public function registrar_general($numero, $correo, $direccion, $longitud, $latitud, $usuario){
        $conectar= parent::conexion();
        parent::set_names();
        
        $sql = "INSERT INTO m_configuracion(numero, correo, direccion, longitud, latitud, fec_crea, usu_crea, fec_actu, usu_actu) 
        VALUES (?,?,?,?,?, now(), ?, now(), ?)";
        $sql = $conectar->prepare($sql);
        $sql->bindValue(1, $numero);
        $sql->bindValue(2, $correo);
        $sql->bindValue(3, $direccion);
        $sql->bindValue(4, $longitud);
        $sql->bindValue(5, $latitud);
        $sql->bindValue(6, $usuario);
        $sql->bindValue(7, $usuario);

        try {
            if ($sql->execute()) {
                $jsonData['success'] = 1;
            } else {
                $jsonData['success'] = 0;
            }
        } catch (PDOException $e) {
            $jsonData['success'] = 0;
            $jsonData['error'] = $e->getMessage();
        }
        
        //Mostrando mi respuesta en formato Json
        header('Content-type: application/json; charset=utf-8');
        echo json_encode( $jsonData );   
    }

    public function editar_general($numero, $correo, $direccion, $longitud, $latitud, $usuario){
        $conectar= parent::conexion();
        parent::set_names();

        $sql = "UPDATE m_configuracion SET numero = ?, correo = ?, direccion = ?, longitud = ?, latitud = ?, fec_actu = now(), usu_actu = ?";
        $sql = $conectar->prepare($sql);
        $sql->bindValue(1, $numero);
        $sql->bindValue(2, $correo);
        $sql->bindValue(3, $direccion);
        $sql->bindValue(4, $longitud);
        $sql->bindValue(5, $latitud);
        $sql->bindValue(6, $usuario);

        if($sql->execute()){
            $jsonData['success'] = 1;
        } else {
            $jsonData['success'] = 0;
        }
    
        header('Content-type: application/json; charset=utf-8');
        echo json_encode($jsonData);
    }

    public function obtener_datos_configuracion() {
        $conectar = parent::conexion();
        parent::set_names();
    
        $sql = "SELECT * FROM m_configuracion LIMIT 1";
        $stmt = $conectar->prepare($sql);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function get_nosotros() {
        $conectar = parent::conexion();
        parent::set_names();
    
        $sql = "SELECT * FROM m_nosotros LIMIT 1";
        $stmt = $conectar->prepare($sql);
        $stmt->execute();
    
        return $stmt->fetch(PDO::FETCH_ASSOC); // Devuelve solo un registro
    }

    public function registrar_nosotros($mision, $vision, $usuario){
        $conectar = parent::conexion();
        parent::set_names();
    
        $sql = "INSERT INTO m_nosotros (mision, vision, fec_crea, usu_crea, fec_actu, usu_actu) 
                VALUES (?, ?, NOW(), ?, NOW(), ?)";
        $stmt = $conectar->prepare($sql);
        $stmt->bindValue(1, $mision);
        $stmt->bindValue(2, $vision);
        $stmt->bindValue(3, $usuario);
        $stmt->bindValue(4, $usuario);
    
        try {
            if ($stmt->execute()) {
                $jsonData['success'] = 1;
            } else {
                $jsonData['success'] = 0;
            }
        } catch (PDOException $e) {
            $jsonData['success'] = 0;
            $jsonData['error'] = $e->getMessage();
        }
    
        header('Content-type: application/json; charset=utf-8');
        echo json_encode($jsonData);
    }
    
    public function editar_nosotros($mision, $vision, $usuario){
        $conectar = parent::conexion();
        parent::set_names();
    
        $sql = "UPDATE m_nosotros 
                SET mision = ?, vision = ?, fec_actu = NOW(), usu_actu = ? 
                LIMIT 1";
        $stmt = $conectar->prepare($sql);
        $stmt->bindValue(1, $mision);
        $stmt->bindValue(2, $vision);
        $stmt->bindValue(3, $usuario);
    
        try {
            if ($stmt->execute()) {
                $jsonData['success'] = 1;
            } else {
                $jsonData['success'] = 0;
            }
        } catch (PDOException $e) {
            $jsonData['success'] = 0;
            $jsonData['error'] = $e->getMessage();
        }
    
        header('Content-type: application/json; charset=utf-8');
        echo json_encode($jsonData);
    }

    public function obtener_nosotros() {
        $conectar = parent::conexion();
        parent::set_names();
    
        $sql = "SELECT * FROM m_nosotros LIMIT 1";
        $stmt = $conectar->prepare($sql);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function listar_valor(){
        $conectar= parent::conexion();
        parent::set_names();
        $sql="SELECT
            id, 
            valor,
            descripcion
            FROM 
            m_nosotros_valores";
        // $sql="call sp_l_usuario_01()"
        $sql=$conectar->prepare($sql);
        $sql->execute();
        return $resultado=$sql->fetchAll();
    }

    public function registrar_valor($valor, $descrip){
        $conectar = parent::conexion();
        parent::set_names();
    
        $sql = "INSERT INTO m_nosotros_valores (valor, descripcion) 
                VALUES (?, ?)";
        $stmt = $conectar->prepare($sql);
        $stmt->bindValue(1, $valor);
        $stmt->bindValue(2, $descrip);
    
        try {
            if ($stmt->execute()) {
                $jsonData['success'] = 1;
            } else {
                $jsonData['success'] = 0;
            }
        } catch (PDOException $e) {
            $jsonData['success'] = 0;
            $jsonData['error'] = $e->getMessage();
        }
    
        header('Content-type: application/json; charset=utf-8');
        echo json_encode($jsonData);
    }

    public function eliminar_valor($id){
        $conectar= parent::conexion();
        parent::set_names();

        $del = "DELETE FROM m_nosotros_valores WHERE id = ?";
        $del=$conectar->prepare($del);
        $del->bindValue(1,$id);
        $del->execute();
        return $resultado = $del->fetchAll();
    }
}