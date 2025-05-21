<?php
require_once("../config/conexion.php");
require_once("../model/Ubicacion.php");
$ubicacion = new Ubicacion();

switch($_GET["op"]){ 
    case "combo_depart":
        $datos = $ubicacion->get_depart();
        if(is_array($datos)==true and count($datos)>0){
            $html= "<option value=''>-- Seleccionar --</option>";
            foreach($datos as $row){
                $html.= "<option value='".$row['id']."'>".$row['nombre']."</option>";
            }
            echo $html;
        }
        break; 

    case "combo_prov":
        $datos = $ubicacion->get_provin($_POST['id_depart']);
        if(is_array($datos)==true and count($datos)>0){
            $html= "<option value=''>-- Seleccionar --</option>";
            foreach($datos as $row){
                $html.= "<option value='".$row['id']."'>".$row['nombre']."</option>";
            }
            echo $html;
        }
        break;  
    
    case "combo_dist_prov":
        $datos = $ubicacion->get_dist_prov($_POST['id_provin']);
        if(is_array($datos)==true and count($datos)>0){
            $html= "<option value=''>-- Seleccionar --</option>";
            foreach($datos as $row){
                $html.= "<option value='".$row['id']."'>".$row['nombre']."</option>";
            }
            echo $html;
        }
        break; 
    case "combo_dist":
        $datos = $ubicacion->get_dist();
        if(is_array($datos)==true and count($datos)>0){
            $html= "<option value=''>-- Seleccionar --</option>";
            foreach($datos as $row){
                $html.= "<option value='".$row['id']."'>".$row['nombre']."</option>";
            }
            echo $html;
        }
        break;  

}