<?php
date_default_timezone_set('America/Bogota');
class Proyecto extends Conectar{
    public function get_proyecto(){
        $conectar= parent::conexion();
        parent::set_names();
        $sql="SELECT
            g_proyec_arqui.id, 
            g_proyec_arqui.nombre,
            g_proyec_arqui.npisos,
            g_proyec_arqui.nbanos,
            g_proyec_arqui.area,
            g_proyec_arqui.id_t_prop,
            m_tipo_propiedad.nombre tipo,
            g_proyec_arqui.estado
            FROM 
            g_proyec_arqui
            INNER JOIN m_tipo_propiedad ON m_tipo_propiedad.id = g_proyec_arqui.id_t_prop
            ORDER BY g_proyec_arqui.fec_crea DESC";
        // $sql="call sp_l_usuario_01()"
        $sql=$conectar->prepare($sql);
        $sql->execute();
        return $resultado=$sql->fetchAll();
    }

    public function registrar($nombre, $id_t_prop, $descrip, $npisos, $nbanos, $area, $estado, $usuario){
        $conectar= parent::conexion();
        parent::set_names();
        
        $sql = "INSERT INTO g_proyec_arqui(nombre,id_t_prop,descrip,npisos,nbanos,area,estado,fec_crea,usu_crea,fec_actu,usu_actu) 
        VALUES (?,?,?,?,?,?,?,now(),?,now(),?)";
        $sql = $conectar->prepare($sql);
        $sql->bindValue(1, $nombre);
        $sql->bindValue(2, $id_t_prop);
        $sql->bindValue(3, $descrip);
        $sql->bindValue(4, $npisos);
        $sql->bindValue(5, $nbanos);
        $sql->bindValue(6, $area);
        $sql->bindValue(7, $estado);
        $sql->bindValue(8, $usuario);
        $sql->bindValue(9, $usuario);

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

    public function proyecto_x_id($id){
        $conectar= parent::conexion();
        parent::set_names();
        $sql="SELECT 
            g_proyec_arqui.id,
            g_proyec_arqui.nombre,
            g_proyec_arqui.descrip,
            g_proyec_arqui.npisos,
            g_proyec_arqui.nbanos,
            g_proyec_arqui.area,
            g_proyec_arqui.id_t_prop,
            m_tipo_propiedad.nombre tipo,
            g_proyec_arqui.estado
            FROM
            g_proyec_arqui
            INNER JOIN m_tipo_propiedad ON m_tipo_propiedad.id = g_proyec_arqui.id_t_prop
            WHERE g_proyec_arqui.id = ?";
        $sql=$conectar->prepare($sql);
        $sql->bindValue(1,$id);
        $sql->execute();
        return $resultado=$sql->fetchAll();
    }

    public function editar($codigo, $nombre, $id_t_prop, $descrip, $npisos, $nbanos, $area, $estado, $usuario){
        $conectar= parent::conexion();
        parent::set_names();
        
        $sql = "UPDATE g_proyec_arqui SET nombre=?, id_t_prop=?, descrip=?, npisos=?, nbanos=?, area=?, estado=?, fec_actu=now(), usu_actu=? WHERE id = ?";
        $sql = $conectar->prepare($sql);
        $sql->bindValue(1, $nombre);
        $sql->bindValue(2, $id_t_prop);
        $sql->bindValue(3, $descrip);
        $sql->bindValue(4, $npisos);
        $sql->bindValue(5, $nbanos);
        $sql->bindValue(6, $area);
        $sql->bindValue(7, $estado);
        $sql->bindValue(8, $usuario);
        $sql->bindValue(9, $codigo);

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
        $sql = "SELECT COALESCE(MAX(orden), 0) AS ultimo_orden FROM g_proyec_arqui_foto";
        $stmt = $conectar->prepare($sql);
        $stmt->execute();
        $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
        return (int)$resultado["ultimo_orden"];
    }

    public function listar_foto($id_proyec){
        $conectar= parent::conexion();
        parent::set_names();
        $sql="SELECT
            id,
            id_proyec,
            nombre,
            foto,
            orden
            FROM 
            g_proyec_arqui_foto
            WHERE id_proyec = ?
            ORDER BY orden DESC";
        // $sql="call sp_l_usuario_01()"
        $sql = $conectar->prepare($sql);
        $sql->bindValue(1, $id_proyec);
        $sql->execute();
        return $resultado=$sql->fetchAll();
    }

    public function registrar_foto($id_proyec, $foto, $nombre, $orden) {
        $conectar = parent::conexion();
        parent::set_names();
    
        $sql_check = "SELECT COUNT(*) as total FROM g_proyec_arqui_foto WHERE nombre = ?";
        $stmt_check = $conectar->prepare($sql_check);
        $stmt_check->bindValue(1, $nombre);
        $stmt_check->execute();
        $resultado_check = $stmt_check->fetch();
    
        if ($resultado_check['total'] > 0) {
            return ['success' => 2]; // Archivo duplicado
        } else {
            $sql_ins = "INSERT INTO g_proyec_arqui_foto (id_proyec, foto, nombre, orden) VALUES (?, ?, ?, ?)";
            $sql_ins = $conectar->prepare($sql_ins);
            $sql_ins->bindValue(1, $id_proyec);
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
    
        $sql = "UPDATE g_proyec_arqui_foto SET orden = ? WHERE id = ?";
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

        $del = "DELETE FROM g_proyec_arqui_foto WHERE id = ?";
        $del=$conectar->prepare($del);
        $del->bindValue(1,$id);
        $del->execute();
        return $resultado = $del->fetchAll();
    }
}