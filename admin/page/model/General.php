<?php
date_default_timezone_set('America/Bogota');
class General extends Conectar{
    
    public function registrar_general($numero, $correo, $facebook, $linkedin, $instagram, $direccion, $usuario){
        $conectar= parent::conexion();
        parent::set_names();
    
        $sql_check = "SELECT COUNT(*) as total FROM m_configuracion";
        $stmt_check = $conectar->prepare($sql_check);
        $stmt_check->execute();
        $resultado_check = $stmt_check->fetch();
    
        if ($resultado_check['total'] > 0) {
            $sql = "UPDATE m_configuracion SET numero = ?, correo = ?, facebook = ?, linkedin = ?, instagram = ?, direccion = ?, fec_actu = now(), usu_actu = ?";
            $sql = $conectar->prepare($sql);
            $sql->bindValue(1, $numero);
            $sql->bindValue(2, $correo);
            $sql->bindValue(3, $facebook);
            $sql->bindValue(4, $linkedin);
            $sql->bindValue(5, $instagram);
            $sql->bindValue(6, $direccion);
            $sql->bindValue(7, $usuario);  
        } else {
            $sql = "INSERT INTO m_configuracion(numero, correo, facebook, linkedin, instagram, direccion, fec_crea, usu_crea, fec_actu, usu_actu) 
            VALUES (?,?,?,?,?,?, now(), ?, now(), ?)";
            $sql = $conectar->prepare($sql);
            $sql->bindValue(1, $numero);
            $sql->bindValue(2, $correo);
            $sql->bindValue(3, $facebook);
            $sql->bindValue(4, $linkedin);
            $sql->bindValue(5, $instagram);
            $sql->bindValue(6, $direccion);
            $sql->bindValue(7, $usuario);
            $sql->bindValue(8, $usuario);
        }

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

    public function registrar_nosotros($qsomos, $mision, $vision, $usuario){
        $conectar = parent::conexion();
        parent::set_names();
    
        $sql = "INSERT INTO m_nosotros (quienes_somos, mision, vision, fec_crea, usu_crea, fec_actu, usu_actu) 
                VALUES (?, ?, ?, NOW(), ?, NOW(), ?)";
        $stmt = $conectar->prepare($sql);
        $stmt->bindValue(1, $qsomos);
        $stmt->bindValue(2, $mision);
        $stmt->bindValue(3, $vision);
        $stmt->bindValue(4, $usuario);
        $stmt->bindValue(5, $usuario);
    
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
    
    public function editar_nosotros($qsomos, $mision, $vision, $usuario){
        $conectar = parent::conexion();
        parent::set_names();
    
        $sql = "UPDATE m_nosotros 
                SET quienes_somos = ?, mision = ?, vision = ?, fec_actu = NOW(), usu_actu = ? 
                LIMIT 1";
        $stmt = $conectar->prepare($sql);
        $stmt->bindValue(1, $qsomos);
        $stmt->bindValue(2, $mision);
        $stmt->bindValue(3, $vision);
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