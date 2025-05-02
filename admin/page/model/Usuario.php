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
}

?>