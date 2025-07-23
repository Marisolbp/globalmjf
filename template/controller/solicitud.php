<?php
require_once("../config/conexion.php");
require_once("../model/Solicitud.php");
$solicitud = new Solicitud();

switch($_GET["op"]){ 
    case "combo_tipo_prop":
        $datos = $solicitud->get_tip_prop();
        if(is_array($datos)==true and count($datos)>0){
            $html= "<option value=''>Seleccione una opción</option>";
            foreach($datos as $row){
                $html.= "<option value='".$row['id']."'>".$row['nombre']."</option>";
            }
            echo $html;
        }
        break;
    
    case "combo_depart":
        $datos = $solicitud->get_depart();
        if(is_array($datos)==true and count($datos)>0){
            $html= "<option value=''>Seleccione una opción</option>";
            foreach($datos as $row){
                $html.= "<option value='".$row['id']."'>".$row['nombre']."</option>";
            }
            echo $html;
        }
        break; 

    case "combo_prov":
        $datos = $solicitud->get_provin($_POST['id_depart']);
        if(is_array($datos)==true and count($datos)>0){
            $html= "<option value=''>Seleccione una opción</option>";
            foreach($datos as $row){
                $html.= "<option value='".$row['id']."'>".$row['nombre']."</option>";
            }
            echo $html;
        }
        break;  
    
    case "combo_dist_prov":
        $datos = $solicitud->get_dist_prov($_POST['id_provin']);
        if(is_array($datos)==true and count($datos)>0){
            $html= "<option value=''>Seleccione una opción</option>";
            foreach($datos as $row){
                $html.= "<option value='".$row['id']."'>".$row['nombre']."</option>";
            }
            echo $html;
        }
        break; 
}