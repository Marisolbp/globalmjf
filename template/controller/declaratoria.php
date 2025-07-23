<?php
require_once("../config/conexion.php");
require_once("../model/Declaratoria.php");
$declaratoria = new Declaratoria();

switch($_GET["op"]) {
    case "mostrar_datos":
        $datos = $declaratoria->mostrar_datos();
        if (is_array($datos) == true and count($datos) > 0) {
           foreach ($datos as $row) {
                $output["descrip_decla"]  = $row["descrip_decla"];
                $output["descrip_indep"]  = $row["descrip_indep"];
            }
            echo json_encode($output);
        }
        break;
}