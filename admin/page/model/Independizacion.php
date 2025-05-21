<?php
date_default_timezone_set('America/Bogota');
class Independizacion extends Conectar{
    public function get_independizacion(){
        $conectar= parent::conexion();
        parent::set_names();
        $sql="SELECT
            g_independizacion.id, 
            g_independizacion.nombre,
            g_independizacion.id_distri,
            m_distrito.nombre distrito,
            g_independizacion.area,
            g_independizacion.estado
            FROM 
            g_independizacion
            INNER JOIN m_distrito ON g_independizacion.id_distri = m_distrito.id
            ORDER BY g_independizacion.fec_crea DESC";
        // $sql="call sp_l_usuario_01()"
        $sql=$conectar->prepare($sql);
        $sql->execute();
        return $resultado=$sql->fetchAll();
    }

    public function obtener_descripcion() {
        $conectar = parent::conexion();
        parent::set_names();
    
        $sql = "SELECT * FROM m_independizacion LIMIT 1";
        $stmt = $conectar->prepare($sql);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function registrar($nombre, $id_distri, $area, $estado, $usuario){
        $conectar= parent::conexion();
        parent::set_names();
        
        $sql = "INSERT INTO g_independizacion(nombre,id_distri,area,estado,fec_crea,usu_crea,fec_actu,usu_actu) 
        VALUES (?,?,?,?,now(),?,now(),?)";
        $sql = $conectar->prepare($sql);
        $sql->bindValue(1, $nombre);
        $sql->bindValue(2, $id_distri);
        $sql->bindValue(3, $area);
        $sql->bindValue(4, $estado);
        $sql->bindValue(5, $usuario);
        $sql->bindValue(6, $usuario);

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

    public function independizacion_x_id($id){
        $conectar= parent::conexion();
        parent::set_names();
        $sql="SELECT 
            g_independizacion.id,
            g_independizacion.nombre,
            g_independizacion.id_distri,
            m_distrito.nombre distrito,
            g_independizacion.area,
            g_independizacion.estado
            FROM 
            g_independizacion
            INNER JOIN m_distrito ON g_independizacion.id_distri = m_distrito.id
            WHERE g_independizacion.id = ?";
        $sql=$conectar->prepare($sql);
        $sql->bindValue(1,$id);
        $sql->execute();
        return $resultado=$sql->fetchAll();
    }

    public function editar($codigo, $nombre, $id_distri, $area, $estado, $usuario){
        $conectar= parent::conexion();
        parent::set_names();
        
        $sql = "UPDATE g_independizacion SET nombre=?, id_distri=?, area=?, estado=?, fec_actu=now(), usu_actu=? WHERE id = ?";
        $sql = $conectar->prepare($sql);
        $sql->bindValue(1, $nombre);
        $sql->bindValue(2, $id_distri);
        $sql->bindValue(3, $area);
        $sql->bindValue(4, $estado);
        $sql->bindValue(5, $usuario);
        $sql->bindValue(6, $codigo);

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

    public function obtener_ultimo_orden(){
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "SELECT COALESCE(MAX(orden), 0) AS ultimo_orden FROM g_independizacion_foto";
        $stmt = $conectar->prepare($sql);
        $stmt->execute();
        $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
        return (int)$resultado["ultimo_orden"];
    }

    public function listar_foto($id_indep){
        $conectar= parent::conexion();
        parent::set_names();
        $sql="SELECT
            id,
            id_indep,
            nombre,
            foto,
            orden
            FROM 
            g_independizacion_foto
            WHERE id_indep = ?
            ORDER BY orden DESC";
        // $sql="call sp_l_usuario_01()"
        $sql = $conectar->prepare($sql);
        $sql->bindValue(1, $id_indep);
        $sql->execute();
        return $resultado=$sql->fetchAll();
    }

    public function registrar_foto($id_indep, $foto, $nombre, $orden) {
        $conectar = parent::conexion();
        parent::set_names();
    
        $sql_check = "SELECT COUNT(*) as total FROM g_independizacion_foto WHERE nombre = ?";
        $stmt_check = $conectar->prepare($sql_check);
        $stmt_check->bindValue(1, $nombre);
        $stmt_check->execute();
        $resultado_check = $stmt_check->fetch();
    
        if ($resultado_check['total'] > 0) {
            return ['success' => 2]; // Archivo duplicado
        } else {
            $sql_ins = "INSERT INTO g_independizacion_foto (id_indep, foto, nombre, orden) VALUES (?, ?, ?, ?)";
            $sql_ins = $conectar->prepare($sql_ins);
            $sql_ins->bindValue(1, $id_indep);
            $sql_ins->bindValue(2, $foto, PDO::PARAM_LOB);
            $sql_ins->bindValue(3, $nombre);
            $sql_ins->bindValue(4, $orden);
    
            if ($sql_ins->execute()) {
                return ['success' => 1]; // Éxito
            } else {
                return ['success' => 0]; // Error
            }
        }
    }

    public function actualizar_orden_foto($id, $orden){
        $conectar = parent::conexion();
        parent::set_names();
    
        $sql = "UPDATE g_independizacion_foto SET orden = ? WHERE id = ?";
        $stmt = $conectar->prepare($sql);
        $stmt->bindValue(1, $orden);
        $stmt->bindValue(2, $id);
    
        if ($stmt->execute()) {
            return ["success" => 1];
        } else {
            return ["success" => 0];
        }
    }

    public function eliminar($id){
        $conectar= parent::conexion();
        parent::set_names();

        $del = "DELETE FROM g_independizacion_foto WHERE id = ?";
        $del=$conectar->prepare($del);
        $del->bindValue(1,$id);
        $del->execute();
        return $resultado = $del->fetchAll();
    }

    public function get_ifo_modulo() {
        $conectar = parent::conexion();
        parent::set_names();
    
        $sql = "SELECT * FROM m_independizacion LIMIT 1";
        $stmt = $conectar->prepare($sql);
        $stmt->execute();
    
        return $stmt->fetch(PDO::FETCH_ASSOC); // Devuelve solo un registro
    }

    public function registrar_ifo_modulo($descripcion, $usuario){
        $conectar = parent::conexion();
        parent::set_names();
    
        $sql = "INSERT INTO m_independizacion (descripcion, fec_crea, usu_crea, fec_actu, usu_actu) 
                VALUES (?, NOW(), ?, NOW(), ?)";
        $stmt = $conectar->prepare($sql);
        $stmt->bindValue(1, $descripcion);
        $stmt->bindValue(2, $usuario);
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
    
    public function editar_ifo_modulo($descripcion, $usuario){
        $conectar = parent::conexion();
        parent::set_names();
    
        $sql = "UPDATE m_independizacion 
                SET descripcion = ?, fec_actu = NOW(), usu_actu = ? 
                LIMIT 1";
        $stmt = $conectar->prepare($sql);
        $stmt->bindValue(1, $descripcion);
        $stmt->bindValue(2, $usuario);
    
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
}