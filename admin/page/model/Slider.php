<?php
date_default_timezone_set('America/Bogota');
class Slider extends Conectar{
    public function get_slider(){
        $conectar= parent::conexion();
        parent::set_names();
        $sql="SELECT
            id, 
            nombre,
            foto,
            orden
            FROM 
            m_foto_slider
            ORDER BY orden DESC";
        // $sql="call sp_l_usuario_01()"
        $sql=$conectar->prepare($sql);
        $sql->execute();
        return $resultado=$sql->fetchAll();
    }

    public function obtener_ultimo_orden(){
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "SELECT COALESCE(MAX(orden), 0) AS ultimo_orden FROM m_foto_slider";
        $stmt = $conectar->prepare($sql);
        $stmt->execute();
        $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
        return (int)$resultado["ultimo_orden"];
    }

    public function registrar_foto($foto, $nombre, $usuario, $orden) {
        $conectar = parent::conexion();
        parent::set_names();
    
        $sql_check = "SELECT COUNT(*) as total FROM m_foto_slider WHERE nombre = ?";
        $stmt_check = $conectar->prepare($sql_check);
        $stmt_check->bindValue(1, $nombre);
        $stmt_check->execute();
        $resultado_check = $stmt_check->fetch();
    
        if ($resultado_check['total'] > 0) {
            return ['success' => 2]; // Archivo duplicado
        } else {
            $sql_ins = "INSERT INTO m_foto_slider (foto, nombre, orden, fec_crea, usu_crea) VALUES (?, ?, ?, now(), ?)";
            $sql_ins = $conectar->prepare($sql_ins);
            $sql_ins->bindValue(1, $foto, PDO::PARAM_LOB);
            $sql_ins->bindValue(2, $nombre);
            $sql_ins->bindValue(3, $orden);
            $sql_ins->bindValue(4, $usuario);
    
            if ($sql_ins->execute()) {
                return ['success' => 1]; // Éxito
            } else {
                return ['success' => 0]; // Error
            }
        }
    }

    public function eliminar($id){
        $conectar= parent::conexion();
        parent::set_names();

        $del = "DELETE FROM m_foto_slider WHERE id = ?";
        $del=$conectar->prepare($del);
        $del->bindValue(1,$id);
        $del->execute();
        return $resultado = $del->fetchAll();
    }

    public function actualizar_orden($id, $orden){
        $conectar = parent::conexion();
        parent::set_names();
    
        $sql = "UPDATE m_foto_slider SET orden = ? WHERE id = ?";
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