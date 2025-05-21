<?php
require_once("../config/conexion.php");
require_once("../model/Independizacion.php");
$independizacion = new Independizacion();

switch($_GET["op"]){

    case "listar":
        $datos=$independizacion->get_independizacion();
        $data= Array();
        foreach($datos as $row){
            $sub_array = array();
            $sub_array[] = $row["nombre"];
            $sub_array[] = $row["distrito"];
            $sub_array[] = $row["area"] . " m²";

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
                                   <a class="dropdown-item" style="cursor:pointer;" onClick="registrarFoto(\'' . $row['id'] . '\');"><i class="bx bx-images mr-1"></i> Fotos</a>
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

    case "obtener_descripcion":
        $datos = $independizacion->obtener_descripcion();

        if ($datos) {
            echo json_encode([
                "success" => 1,
                "data" => $datos
            ]);
        } else {
            echo json_encode([
                "success" => 0,
                "message" => "No hay datos de configuración"
            ]);
        }
        break;

    case "registrar":

        $estado = $_POST['estado_real'];
        $independizacion->registrar($_POST['nombre'], $_POST['id_distri'], $_POST['area'], $estado,  $_SESSION['usuario']);
        break;

    case "obtener":
        $datos = $independizacion->independizacion_x_id($_POST["id"]);
        if (is_array($datos) == true and count($datos) > 0) {
           foreach ($datos as $row) {
                $output["id"]         = $row["id"];
                $output["nombre"]     = $row["nombre"];
                $output["id_distri"]  = $row["id_distri"];
                $output["distrito"]   = $row["distrito"];
                $output["area"]       = $row["area"];
                $output["estado"]     = $row["estado"];
            }
            echo json_encode($output);
        }
        break;

    case "editar":

        $estado = $_POST['estado_real'];
        $independizacion->editar($_POST['codigo'], $_POST['nombre'], $_POST['id_distri'], $_POST['area'], $estado,  $_SESSION['usuario']);
        break;

    case "listar_foto":
        $datos=$independizacion->listar_foto($_POST['id_indep']);
        $data= Array();
        foreach($datos as $row){
            $sub_array = array();

            $sub_array[] = $row["nombre"];

            $foto_base64 = base64_encode($row["foto"]);

            $sub_array[] = '<img src="data:image/jpeg;base64,'.$foto_base64.'" alt="table-user" height="50px" width="50px" class="me-2 avatar-sm" />';

            $sub_array[] = '<input type="number" class="form-control form-control-sm text-center input-orden"
                            value="'.$row["orden"].'" 
                            data-id="'.$row["id"].'" 
                            style="width: 50px; margin: 0 auto;">';

            $sub_array[] = '<div style="margin:auto;" class="badge-circle badge-circle-sm badge-circle-light-danger">
                                <a class="badge-circle badge-circle-sm badge-circle-light-warning" style="cursor:pointer" onClick="return eliminarFoto('."'".$row['id']."'".');"><i class="bx bx-trash font-size-base"></i>
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

    case "registrar_foto":
        if (isset($_FILES) && count($_FILES) > 0) {
            $total_archivos = $_POST['total_archivos'];
            $response = [
                'success' => 0,
                'archivos_registrados' => 0,
                'archivos_duplicados' => 0,
                'errores' => 0
            ];

            // Obtener el último valor de orden desde el modelo
            $ultimo_orden = $independizacion->obtener_ultimo_orden();  // Este método lo creas en tu modelo

            for ($i = 0; $i < $total_archivos; $i++) {
                $file = $_FILES['foto' . $i];
                $foto_contenido = file_get_contents($file['tmp_name']);
                $foto_nombre = $file['name'];
                $orden = $ultimo_orden + $i + 1;
    
                // Llama al modelo con el orden calculado
                $resultado = $independizacion->registrar_foto($_POST['id_indep'], $foto_contenido, $foto_nombre, $orden);
                
                if ($resultado['success'] == 1) {
                    $response['archivos_registrados']++;
                } elseif ($resultado['success'] == 2) {
                    $response['archivos_duplicados']++;
                } else {
                    $response['errores']++;
                }
            }
    
            if ($response['archivos_registrados'] > 0) {
                $response['success'] = 1;
            }
    
            header('Content-type: application/json; charset=utf-8');
            echo json_encode($response);
        }
        break;

    case "actualizar_orden_foto":
        $id = $_POST["id"];
        $orden = $_POST["orden"];
        $respuesta = $independizacion->actualizar_orden_foto($id, $orden);
        echo json_encode($respuesta);
        break;
    
    case "eliminar":
        $independizacion->eliminar($_POST['id']);
        break;

    case "registrar_info_modulo":

        $descripcion = $_POST['descripcion'];
        $usuario = $_SESSION['usuario'];

        // Verificamos si ya existe algún registro en la tabla
        $datos = $independizacion->get_ifo_modulo();

        if (empty($datos)) {
            $independizacion->registrar_ifo_modulo($descripcion, $usuario);
        } else {
            $independizacion->editar_ifo_modulo($descripcion, $usuario);
        }

        break;
}