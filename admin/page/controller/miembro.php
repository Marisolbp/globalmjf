<?php
require_once("../config/conexion.php");
require_once("../model/Miembro.php");
$miembro = new Miembro();

switch($_GET["op"]){

    case "listar":
        $datos=$miembro->get_miembro();
        $data= Array();
        foreach($datos as $row){
            $sub_array = array();
            $sub_array[] = $row["nombre"];
            $sub_array[] = $row["apellido"];
            $sub_array[] = $row["puesto"];

            $sub_array[] = '<div class="position-relative d-inline-block mr-1">
                                <a href="'.$row["linkedin"].'" target="_blank"><i class="bx bxl-linkedin font-medium-5 text-primary"></i></a>
                            </div>
                            <div class="position-relative d-inline-block mr-1">
                                <a href="'.$row["instagram"].'" target="_blank"><i class="bx bxl-instagram font-medium-5 text-danger"></i></a>
                            </div>
                            <div class="position-relative d-inline-block">
                                <a href="mailto:'.$row["correo"].'" target="_blank"><i class="bx bx-envelope font-medium-5 text-info"></i></a>
                            </div>';

            $foto_base64 = base64_encode($row["foto"]);

            $sub_array[] = 
                    '<a data-toggle="modal" id="botona" style="background-color: #ec4561; border-color: #ec4561">
                        <div class="">
                            <a class="">
                                <img src="data:image/jpeg;base64,'.$foto_base64.'" alt="avatar" class="rounded-circle" height="30" width="30">
                            </a>
                        </div>
                    </a>';

            $sub_array[] = '<input type="number" class="form-control form-control-sm text-center input-orden"
                    value="'.$row["orden"].'" 
                    data-id="'.$row["id"].'" 
                    style="width: 50px; margin: 0 auto;">';

            if ($row["estado"]=="A"){
                $sub_array[] = '<a class="badge badge-pill badge-light-success" style="cursor:pointer" onClick="Inactivar('.$row["id"].');">Activo</a>';
            }else{
                $sub_array[] = '<a class="badge badge-pill badge-light-danger" style="cursor:pointer" onClick="Activar('.$row["id"].');">Inactivo</a>';
            }

            $sub_array[] = '<div class="dropup">
                               <span class="bx bx-dots-vertical-rounded font-medium-3 dropdown-toggle nav-hide-arrow cursor-pointer" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" role="menu">
                               </span>
                               <div class="dropdown-menu dropdown-menu-right dropdown-menu-end">
                                   <a class="dropdown-item" style="cursor:pointer;" onClick="editarRegistro(\'' . $row['id'] . '\');"><i class="bx bx-edit-alt mr-1"></i> Editar</a>
                                   <a class="dropdown-item" style="cursor:pointer;" onClick="verEspecialidad(\'' . $row['id'] . '\');"><i class="bx bx-images mr-1"></i> Especialidades</a>
                               </div>
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

        $miembro->registrar($_POST['nombre'], $_POST['apellido'], $_POST['codcap'], $_POST['puesto'], $_POST['detapuesto'], $_POST['linkedin'], $_POST['instagram'], $_POST['correo'], $_POST['contacto'], $_POST['descrip'], $_POST['orden'], $estado, $fotoBlob, $_SESSION['usuario']);
        break;

    case "obtener":
        $datos = $miembro->miembro_x_id($_POST["id"]);
        if (is_array($datos) == true and count($datos) > 0) {
           foreach ($datos as $row) {
                $output["id"]           = $row["id"];
                $output["nombre"]       = $row["nombre"];
                $output["apellido"]     = $row["apellido"];
                $output["codcap"]       = $row["codcap"];
                $output["puesto"]       = $row["puesto"];
                $output["detapuesto"]   = $row["detapuesto"];
                $output["correo"]       = $row["correo"];
                $output["contacto"]     = $row["contacto"];
                $output["linkedin"]     = $row["linkedin"];
                $output["instagram"]    = $row["instagram"];
                $output["descrip"]      = $row["descrip"];
                $output["orden"]        = $row["orden"];
                $output["estado"]       = $row["estado"];

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
    
        $miembro->editar($_POST['codigo'], $_POST['nombre'], $_POST['apellido'], $_POST['codcap'], $_POST['puesto'], $_POST['detapuesto'], $_POST['linkedin'], $_POST['instagram'], $_POST['correo'], $_POST['contacto'], $_POST['descrip'], $_POST['orden'], $estado, $fotoBlob, $_SESSION['usuario']);
        break;
    
    case "actualizar_orden":
        $id = $_POST["id"];
        $orden = $_POST["orden"];
        $respuesta = $miembro->actualizar_orden($id, $orden);
        echo json_encode($respuesta);
        break;

    case "listar_especialidad":
        $datos=$miembro->listar_especialidad($_POST['id_miembro']);
        $data= Array();
        foreach($datos as $row){
            $sub_array = array();

            $sub_array[] = $row["especialidad"];

            $sub_array[] = '<div style="margin:auto;" class="badge-circle badge-circle-sm badge-circle-light-danger">
                                <a class="badge-circle badge-circle-sm badge-circle-light-warning" style="cursor:pointer" onClick="return eliminarEspecialidad('."'".$row['id']."'".');"><i class="bx bx-trash font-size-base"></i>
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

    case "registrar_especialidad":
        $miembro->registrar_especialidad($_POST['id_miembro'], $_POST['especialidad']);
        break;
    
    case "eliminar_especialidad":
        $miembro->eliminar_especialidad($_POST['id']);
        break;
}