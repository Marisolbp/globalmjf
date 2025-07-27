<?php
require_once("../config/conexion.php");
require_once("../model/Propiedad.php");
$propiedad = new Propiedad();

switch($_GET["op"]){ 
    case "listar_tipos":
        $datos = $propiedad->listar_tipos();
        if(is_array($datos)==true and count($datos)>0){
            $html= "<option value='' data-display='Tipo de propiedad'>Tipo de propiedad</option>";
            foreach($datos as $row){
                $html.= "<option value='".$row['id']."'>".$row['nombre']."</option>";
            }
            echo $html;
        }
        break;
}