<?php
require_once("../config/conexion.php");
require_once("../model/General.php");
$general = new General();

switch($_GET["op"]){

    case "registrar_general":

        $general->registrar_general($_POST['numero'], $_POST['correo'], $_POST['facebook'], $_POST['linkedin'], $_POST['instagram'], $_POST['direccion'], $_SESSION['usuario']);

        break;

    case "obtener_configuracion":
        $datos = $general->obtener_datos_configuracion();

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

    case "registrar_nosotros":

        $qsomos = $_POST['qsomos'];
        $mision = $_POST['mision'];
        $vision = $_POST['vision'];
        $usuario = $_SESSION['usuario'];

        // Verificamos si ya existe algún registro en la tabla
        $datos = $general->get_nosotros();

        if (empty($datos)) {
            $general->registrar_nosotros($qsomos, $mision, $vision, $usuario);
        } else {
            $general->editar_nosotros($qsomos, $mision, $vision, $usuario);
        }

        break;

    case "obtener_nosotros":
        $datos = $general->obtener_nosotros();

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

    case "listar_valor":
        $datos=$general->listar_valor();
        $data= Array();
        foreach($datos as $row){
            $sub_array = array();
            $sub_array[] = $row["valor"];
            $sub_array[] = $row["descripcion"];

            $sub_array[] = '<div style="margin:auto;" class="badge-circle badge-circle-sm badge-circle-light-danger">
                                <a class="badge-circle badge-circle-sm badge-circle-light-warning" style="cursor:pointer" onClick="return eliminarValor('."'".$row['id']."'".');"><i class="bx bx-trash font-size-base"></i>
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

    case "registrar_valor":

        $general->registrar_valor($_POST['valor'], $_POST['descrip']);
        break;

    case "eliminar_valor":
        $general->eliminar_valor($_POST['id']);
        break;
}

