<?php
require_once("../config/conexion.php");
require_once("../model/Dashboard.php");
$dashboard = new Dashboard();

switch($_GET["op"]){   
    case "obtener_solicitudes_activas":
        $datos = $dashboard->obtener_solicitudes_activas();
        
        foreach ($datos as $row) {
            $output["total_solicitudes"] = $row["total_solicitudes"];
        } 
        echo json_encode($output);
       
        break;

    case "obtener_total_miembros":
        $datos = $dashboard->obtener_total_miembros();
        
        foreach ($datos as $row) {
            $output["total_miembros"] = $row["total_miembros"];
        } 
        echo json_encode($output);
       
        break;

    case "obtener_propiedades_disponibles":
        $datos = $dashboard->obtener_propiedades_disponibles();
        
        foreach ($datos as $row) {
            $output["total_propiedades"] = $row["total_propiedades"];
        } 
        echo json_encode($output);
       
        break;

    
    case "obtener_distrito_mayor_in":
        $datos = $dashboard->obtener_distrito_mayor_in();
        
        foreach ($datos as $row) {
            $output["mayor_distrito"] = $row["mayor_distrito"];
        } 
        echo json_encode($output);
       
        break;

    case "obtener_proyectos_en_curso":
        $datos = $dashboard->obtener_proyectos_en_curso();
        
        foreach ($datos as $row) {
            $output["total_proyectos"] = $row["total_proyectos"];
        } 
        echo json_encode($output);
       
        break;

    case "obtener_proyectos_mas_cotizado":
        $datos = $dashboard->obtener_proyectos_mas_cotizado();
        
        foreach ($datos as $row) {
            $output["proyectos_cotizados"] = $row["proyectos_cotizados"];
        } 
        echo json_encode($output);
       
        break;
   
   
   
}