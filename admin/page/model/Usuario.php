<?php
date_default_timezone_set('America/Bogota');
class Usuario extends Conectar{
    
    public function login($usuario,$clave){
        $conectar=parent::conexion();
        parent::set_names();
        $query_login = "SELECT
            id,
            nombre,
            apellido,
            correo,
            usuario,
            clave,
            estado,
            rol,
            foto
        FROM m_usuario
        WHERE (usuario = ? OR correo = ?)";
        $query_login=$conectar->prepare($query_login);
        $query_login->bindValue(1,$usuario);
        $query_login->bindValue(2,$usuario);
        $query_login->execute();
        $result_login = $query_login->fetch();

        if (is_array($result_login) and count($result_login)>0){

            $_SESSION["id"]         = $result_login["id"];
            $_SESSION["nombre"]     = $result_login["nombre"];
            $_SESSION["apellido"]   = $result_login["apellido"];
            $_SESSION["correo"]     = $result_login["correo"];
            $_SESSION["usuario"]    = $result_login["usuario"];
            $_SESSION["estado"]     = $result_login["estado"];
            $_SESSION["rol"]        = $result_login["rol"];
            $_SESSION["foto"]       = $result_login["foto"];

            $pass_valid = $result_login["clave"];

            if ($_SESSION["estado"] == 'I') {
                $jsonData['success'] = 2;
                $jsonData['mensaje'] = 'Usuario inactivo';
                session_destroy();
            } else {
                if (password_verify($clave, $pass_valid)) {
                    $jsonData['success'] = 1;
                    $jsonData['mensaje'] = 'Acceso correcto';
                } else {
                    $jsonData['success'] = 0;
                    $jsonData['mensaje'] = 'Contraseña incorrecta';
                    session_destroy();
                }
            }
        } else{
            $jsonData['success'] = 0;
            $jsonData['mensaje'] = 'Usuario no registrado';
        }
         header('Content-type: application/json; charset=utf-8');
         echo json_encode($jsonData);  
    }

    public function get_usuario(){
        $conectar= parent::conexion();
        parent::set_names();
        $sql="SELECT
            id, 
            nombre,
            apellido,
            correo,
            usuario,
            rol,
            foto,
            estado
            FROM 
            m_usuario
            ORDER BY id DESC";
        // $sql="call sp_l_usuario_01()"
        $sql=$conectar->prepare($sql);
        $sql->execute();
        return $resultado=$sql->fetchAll();
    }

    public function registrar($nombre, $apellido, $correo, $usuario, $clave, $rol, $estado, $foto, $user_created){
        $conectar= parent::conexion();
        parent::set_names();
        
        $sql = "INSERT INTO m_usuario(nombre,apellido,correo,usuario,clave,rol,estado,foto,fec_crea,usu_crea,fec_actu,usu_actu) 
        VALUES (?,?,?,?,?,?,?,?,now(),?,now(),?)";
        $sql = $conectar->prepare($sql);
        $sql->bindValue(1, $nombre);
        $sql->bindValue(2, $apellido);
        $sql->bindValue(3, $correo);
        $sql->bindValue(4, $usuario);
        $sql->bindValue(5, $clave);
        $sql->bindValue(6, $rol);
        $sql->bindValue(7, $estado);
        $sql->bindValue(8, $foto, PDO::PARAM_LOB);
        $sql->bindValue(9, $usuario);
        $sql->bindValue(10, $user_created);

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

    public function usuario_x_id($id){
        $conectar= parent::conexion();
        parent::set_names();
        $sql="SELECT 
            id,
            nombre,
            apellido,
            correo,
            usuario,
            rol,
            estado,
            foto
            FROM 
            m_usuario
            WHERE id = ?";
        $sql=$conectar->prepare($sql);
        $sql->bindValue(1,$id);
        $sql->execute();
        return $resultado=$sql->fetchAll();
    }
    public function editar($id, $nombre, $apellido, $correo, $usuario, $clave, $rol, $estado, $foto, $user_modified) {
        try {
            $conectar = parent::conexion();
            parent::set_names();
            
            // Verificamos si hay una nueva contraseña
            if (!empty($clave)) {
                // Si se proporciona una nueva contraseña, incluirla en la actualización
                $sql = "UPDATE m_usuario 
                    SET nombre = ?, 
                        apellido = ?, 
                        correo = ?, 
                        usuario = ?,
                        clave = ?, 
                        rol = ?, 
                        estado = ?, 
                        fec_actu = now(), 
                        usu_actu = ? 
                    WHERE id = ?";
                
                $sql = $conectar->prepare($sql);
                $sql->bindValue(1, $nombre);
                $sql->bindValue(2, $apellido);
                $sql->bindValue(3, $correo);
                $sql->bindValue(4, $usuario);
                $sql->bindValue(5, $clave);
                $sql->bindValue(6, $rol);
                $sql->bindValue(7, $estado);
                $sql->bindValue(8, $user_modified);
                $sql->bindValue(9, $id);
            } else {
                // Si no hay nueva contraseña, no actualizar ese campo
                $sql = "UPDATE m_usuario 
                    SET nombre = ?, 
                        apellido = ?, 
                        correo = ?, 
                        usuario = ?,
                        rol = ?, 
                        estado = ?, 
                        fec_actu = now(), 
                        usu_actu = ? 
                    WHERE id = ?";
                
                $sql = $conectar->prepare($sql);
                $sql->bindValue(1, $nombre);
                $sql->bindValue(2, $apellido);
                $sql->bindValue(3, $correo);
                $sql->bindValue(4, $usuario);
                $sql->bindValue(5, $rol);
                $sql->bindValue(6, $estado);
                $sql->bindValue(7, $user_modified);
                $sql->bindValue(8, $id);
            }
            
            // Ejecutar la consulta principal
            $result1 = $sql->execute();
            
            // Si hay una nueva foto, actualizarla
            if ($foto !== null) {
                // Actualizar la foto en un query separado
                $sqlFoto = "UPDATE m_usuario SET foto = ? WHERE id = ?";
                $stmtFoto = $conectar->prepare($sqlFoto);
                $stmtFoto->bindValue(1, $foto, PDO::PARAM_LOB);
                $stmtFoto->bindValue(2, $id);
                $result2 = $stmtFoto->execute();
                
                // Si ambas actualizaciones fueron exitosas
                $success = ($result1 && $result2) ? 1 : 0;
            } else {
                // Si no hay actualización de foto, solo verificar el resultado principal
                $success = $result1 ? 1 : 0;
            }
            
            $jsonData = ['success' => $success];
            
        } catch (PDOException $e) {
            // Log del error para depuración
            error_log("Error en editar usuario: " . $e->getMessage());
            $jsonData = ['success' => 0, 'error' => $e->getMessage()];
        }
    
    // Mostrando respuesta en formato Json
    header('Content-type: application/json; charset=utf-8');
    echo json_encode($jsonData);
}

}

?>