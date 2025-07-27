<?php
require_once("../config/conexion.php");
require_once("../model/Solicitud.php");
$solicitud = new Solicitud();

switch($_GET["op"]){

    case "listar":
        $datos=$solicitud->get_solicitud();
        $data= Array();
        foreach($datos as $row){
            $sub_array = array();
            $sub_array[] = $row["nombre"]. ' ' . $row["apellido"];
            $sub_array[] = $row["dni"];
            $sub_array[] = $row["telefono"];
            $sub_array[] = '<a class="badge badge-pill badge-light-primary">'.$row["tipo"].'</a>';
            $sub_array[] = '<a class="badge badge-pill badge-light-secondary">'.$row["modalidad_nombre"].'</a>';

            if ($row["estado"]=="P"){
                $sub_array[] = '<a class="badge badge-pill badge-light-warning");">Pendiente</a>';
            } else if ($row["estado"]=="R"){
                $sub_array[] = '<a class="badge badge-pill badge-light-danger" );">Rechazado</a>';
            } else{
                $sub_array[] = '<a class="badge badge-pill badge-light-success" );">Aprobado</a>';
            }
            
           $sub_array[] = '<div style="margin:auto;" class="badge-circle badge-circle-sm badge-circle-light-primary">
                                <a class="badge-circle badge-circle-sm badge-circle-light-primary" style="cursor:pointer" onClick="verSolicitud('."'".$row['id']."'".');"><i class="bx bx-file font-size-base"></i>
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

    case "obtener":
        $datos = $solicitud->solicitud_x_id($_POST["id"]);
        if (is_array($datos) == true and count($datos) > 0) {
           foreach ($datos as $row) {
                $output["id"]           = $row["id"];
                $output["nombre"]       = $row["nombre"];
                $output["apellido"]     = $row["apellido"];
                $output["tip_doc"]      = $row["tip_doc"];
                $output["dni"]          = $row["dni"];
                $output["email"]        = $row["email"];
                $output["telefono"]     = $row["telefono"];
                $output["id_t_prop"]    = $row["id_t_prop"];
                $output["tipo"]         = $row["tipo"];
                $output["modalidad"]    = $row["modalidad"];
                $output["id_depart"]    = $row["id_depart"];
                $output["departamento"] = $row["departamento"];
                $output["id_provin"]    = $row["id_provin"]; // ← Este campo es esencial
                $output["provincia"]    = $row["provincia"];
                $output["id_distri"]    = $row["id_distri"];
                $output["distrito"]     = $row["distrito"];
                $output["detalle"]      = $row["detalle"];
            }
            echo json_encode($output);
        }
        break;
    case "actualizar_estado":
        $solicitud->actualizar_estado($_POST['id'], $_POST['tipo'], $_SESSION['usuario']);
        break;
}