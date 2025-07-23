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
            g_proyec_arqui.ndormit,
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

    public function registrar($nombre, $id_t_prop, $descrip, $npisos, $ndormit, $nbanos, $area, $estado, $usuario){
        $conectar= parent::conexion();
        parent::set_names();

        // Asegurar que la conexión use UTF-8
        $conectar->exec("SET NAMES utf8mb4 COLLATE utf8mb4_unicode_ci");
        
        $sql = "INSERT INTO g_proyec_arqui(nombre,id_t_prop,descrip,npisos,ndormit,nbanos,area,estado,fec_crea,usu_crea,fec_actu,usu_actu) 
        VALUES (?,?,?,?,?,?,?,?,now(),?,now(),?)";
        $sql = $conectar->prepare($sql);
        $sql->bindValue(1, $nombre);
        $sql->bindValue(2, $id_t_prop);
        $sql->bindValue(3, $descrip, PDO::PARAM_STR);
        $sql->bindValue(4, $npisos);
        $sql->bindValue(5, $ndormit);
        $sql->bindValue(6, $nbanos);
        $sql->bindValue(7, $area);
        $sql->bindValue(8, $estado);
        $sql->bindValue(9, $usuario);
        $sql->bindValue(10, $usuario);

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
            g_proyec_arqui.ndormit,
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

    public function editar($codigo, $nombre, $id_t_prop, $descrip, $npisos, $ndormit, $nbanos, $area, $estado, $usuario){
        $conectar= parent::conexion();
        parent::set_names();

        // Asegurar que la conexión use UTF-8
        $conectar->exec("SET NAMES utf8mb4 COLLATE utf8mb4_unicode_ci");
        
        $sql = "UPDATE g_proyec_arqui SET nombre=?, id_t_prop=?, descrip=?, npisos=?, ndormit=?, nbanos=?, area=?, estado=?, fec_actu=now(), usu_actu=? WHERE id = ?";
        $sql = $conectar->prepare($sql);
        $sql->bindValue(1, $nombre);
        $sql->bindValue(2, $id_t_prop);
        $sql->bindValue(3, $descrip, PDO::PARAM_STR);
        $sql->bindValue(4, $npisos);
        $sql->bindValue(5, $ndormit);
        $sql->bindValue(6, $nbanos);
        $sql->bindValue(7, $area);
        $sql->bindValue(8, $estado);
        $sql->bindValue(9, $usuario);
        $sql->bindValue(10, $codigo);

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

    public function obtener_ultimo_orden($id_proyecto){
        $conectar = parent::conexion();
        parent::set_names();
        $stmt = "SELECT COALESCE(MAX(orden), 0) AS ultimo_orden FROM g_proyec_arqui_foto WHERE id_proyec = ?";
        $stmt = $conectar->prepare($stmt);
        $stmt->bindValue(1, $id_proyecto);
        $stmt->execute();
        $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
        return (int)$resultado["ultimo_orden"];
    }

    public function listar_foto($id_proyec){
        $conectar = parent::conexion();
        parent::set_names();
        
        $sql = "SELECT id, ruta_imagen, nombre_original, orden FROM g_proyec_arqui_foto WHERE id_proyec = ? ORDER BY orden ASC";
        $stmt = $conectar->prepare($sql);
        $stmt->bindValue(1, $id_proyec);
        $stmt->execute();
        
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function verificar_archivo_existente($id_proyec, $nombre_original) {
        $conectar = parent::conexion();
        parent::set_names();
        
        $sql_check = "SELECT COUNT(*) as total FROM g_proyec_arqui_foto WHERE nombre_original = ? AND id_proyec = ?";
        $stmt_check = $conectar->prepare($sql_check);
        $stmt_check->bindValue(1, $nombre_original);
        $stmt_check->bindValue(2, $id_proyec);
        $stmt_check->execute();
        $resultado_check = $stmt_check->fetch();
        
        return $resultado_check['total'] > 0;
    }

    public function registrar_foto($id_proyec, $ruta_imagen, $nombre_original, $orden) {
        $conectar = parent::conexion();
        parent::set_names();

        try {
            $sql_ins = "INSERT INTO g_proyec_arqui_foto (id_proyec, ruta_imagen, nombre_original, orden) VALUES (?, ?, ?, ?)";
            $sql_ins = $conectar->prepare($sql_ins);
            $sql_ins->bindValue(1, $id_proyec);
            $sql_ins->bindValue(2, $ruta_imagen);
            $sql_ins->bindValue(3, $nombre_original);
            $sql_ins->bindValue(4, $orden);

            if ($sql_ins->execute()) {
                return ['success' => 1]; // Éxito
            } else {
                return ['success' => 0]; // Error
            }
        } catch (Exception $e) {
            return ['success' => 0]; // Error
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

    public function eliminar($id_foto) {
        $conectar = parent::conexion();
        parent::set_names();
        
        // Primero obtener la ruta para eliminar el archivo físico
        $sql_select = "SELECT ruta_imagen FROM g_proyec_arqui_foto WHERE id = ?";
        $stmt_select = $conectar->prepare($sql_select);
        $stmt_select->bindValue(1, $id_foto);
        $stmt_select->execute();
        $foto = $stmt_select->fetch(PDO::FETCH_ASSOC);
        
        if ($foto) {
            // Eliminar archivo físico
            $ruta_completa = "../../../" . $foto['ruta_imagen'];
            if (file_exists($ruta_completa)) {
                unlink($ruta_completa);
            }
            
            // Eliminar registro de BD
            $sql_delete = "DELETE FROM g_proyec_arqui_foto WHERE id = ?";
            $stmt_delete = $conectar->prepare($sql_delete);
            $stmt_delete->bindValue(1, $id_foto);
            
            if ($stmt_delete->execute()) {
                return ['success' => 1];
            }
        }
        
        return ['success' => 0];
    }
}