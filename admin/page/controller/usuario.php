<?php
require_once("../config/conexion.php");
require_once("../model/Usuario.php");
$usuario = new Usuario();

switch($_GET["op"]){
    //Envío de datos para login
    case "login":
        $usuario->login(htmlspecialchars($_POST['usuario'],ENT_QUOTES,'UTF-8'),htmlspecialchars($_POST['clave'],ENT_QUOTES,'UTF-8'));
        break;

    case "listar":
        $datos=$usuario->get_usuario();
        $data= Array();
        foreach($datos as $row){
            $sub_array = array();
            $sub_array[] = $row["nombre"];
            $sub_array[] = $row["apellido"];
            $sub_array[] = $row["correo"];
            $sub_array[] = $row["usuario"];

            if ($row["rol"]=="A"){
                $sub_array[] = '<a class="badge badge-pill badge-light-primary" style="cursor:pointer" onClick="Inactivar('.$row["id"].');">Administrador</a>';
            }else{
                $sub_array[] = '<a class="badge badge-pill badge-light-primary" style="cursor:pointer" onClick="Activar('.$row["id"].');">Usuario</a>';
            }

            $foto_base64 = base64_encode($row["foto"]);

            $sub_array[] = 
                    '<a data-toggle="modal" id="botona" style="background-color: #ec4561; border-color: #ec4561">
                        <div class="">
                            <a class="">
                                <img src="data:image/jpeg;base64,'.$foto_base64.'" alt="avatar" class="rounded-circle" height="30" width="30">
                            </a>
                        </div>
                    </a>';

            if ($row["estado"]=="A"){
                $sub_array[] = '<a class="badge badge-pill badge-light-success" style="cursor:pointer" onClick="Inactivar('.$row["id"].');">Activo</a>';
            }else{
                $sub_array[] = '<a class="badge badge-pill badge-light-danger" style="cursor:pointer" onClick="Activar('.$row["id"].');">Inactivo</a>';
            }

            $sub_array[] = '<div style="margin:auto;" class="badge-circle badge-circle-sm badge-circle-light-warning">
                                <a class="badge-circle badge-circle-sm badge-circle-light-warning" style="cursor:pointer" onClick="editarRegistro('."'".$row['id']."'".');"><i class="bx bx-edit-alt font-size-base"></i>
                            </div>';


            $data[] = $sub_array;
        }

        $results = array(
            "sEcho"=>1,
            "iTotalRecords"=>count($data),
            "iTotalDisplayRecords"=>count($data),
            "aaData"=>$data);
        echo json_encode($results);
        break;

    case "registrar":

        $estado = $_POST['estado_real'];

        // Recibir los archivos de Dropzone
        if (!empty($_FILES['foto0'])) {  // Verifica si hay archivos en Dropzone
            $fotoBlob = file_get_contents($_FILES['foto0']['tmp_name']);
        }

        $usuario->registrar($_POST['nombre'], $_POST['apellido'], $_POST['correo'],$_POST['usuario'], password_hash($_POST["clave"], PASSWORD_DEFAULT, ['const' => 10]), $_POST['rol'], $estado, $fotoBlob, $_SESSION['usuario']);
        break;

    case "obtener":
        $datos = $usuario->usuario_x_id($_POST["id"]);
        if (is_array($datos) == true and count($datos) > 0) {
           foreach ($datos as $row) {
                $output["id"]          = $row["id"];
                $output["nombre"]      = $row["nombre"];
                $output["apellido"]    = $row["apellido"];
                $output["correo"]      = $row["correo"];
                $output["usuario"]     = $row["usuario"];
                $output["rol"]         = $row["rol"];
                $output["estado"]      = $row["estado"];

                $output["foto"] = 'data:image/png;base64,' . base64_encode($row["foto"]);
            }
            echo json_encode($output);
        }
        break;

    case "editar":
        $estado = $_POST['estado_real'];
        $fotoBlob = null; // Inicialmente no hay nueva foto
        if (!empty($_FILES['foto0']['tmp_name'])) {
            $fotoBlob = file_get_contents($_FILES['foto0']['tmp_name']);
        }

        // Verificar si se ha proporcionado una nueva contraseña
        if (!empty($_POST["clave"])) {
            // Si hay contraseña nueva, actualizarla con hash
            $password = password_hash($_POST["clave"], PASSWORD_DEFAULT, ['cost' => 10]);
        } else {
            // Si no hay contraseña nueva, mantener la actual (no actualizar)
            $password = null;
        }
        
        $usuario->editar(
            $_POST['id'], 
            $_POST['nombre'], 
            $_POST['apellido'], 
            $_POST['correo'],
            $_POST['usuario'], 
            $password, 
            $_POST['rol'], 
            $estado, 
            $fotoBlob, 
            $_SESSION['usuario']
        );
        break;
}