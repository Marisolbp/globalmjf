<?php
require_once("../config/conexion.php");
require_once("../model/Tipo_propiedad.php");
$tipo_propiedad = new Tipo_propiedad();

switch($_GET["op"]){

    case "listar":
        $datos=$tipo_propiedad->get_tipo_propiedad();
        $data= Array();
        foreach($datos as $row){
            $sub_array = array();
            $sub_array[] = $row["nombre"];

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

        $tipo_propiedad->registrar($_POST['nombre'], $estado);
        break;

    case "obtener":
        $datos = $tipo_propiedad->tipo_propiedad_x_id($_POST["id"]);
        if (is_array($datos) == true and count($datos) > 0) {
           foreach ($datos as $row) {
                $output["id"]           = $row["id"];
                $output["nombre"]       = $row["nombre"];
                $output["estado"]       = $row["estado"];
            }
            echo json_encode($output);
        }
        break;

    case "editar":
        $estado = $_POST['estado_real'];
        $tipo_propiedad->editar($_POST['codigo'], $_POST['nombre'], $estado);
        break;
    case "combo_tip_pro":
        $datos = $tipo_propiedad->get_tipo_pro();
        if(is_array($datos)==true and count($datos)>0){
            $html= "<option value=''>-- Seleccionar --</option>";
            foreach($datos as $row){
                $html.= "<option value='".$row['id']."'>".$row['nombre']."</option>";
            }
            echo $html;
        }
        break;  
}