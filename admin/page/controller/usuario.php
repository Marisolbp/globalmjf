<?php
require_once("../config/conexion.php");
require_once("../model/Usuario.php");
$usuario = new Usuario();

switch($_GET["op"]){
    //Envío de datos para login
    case "login":
        $usuario->login(htmlspecialchars($_POST['usuario'],ENT_QUOTES,'UTF-8'),htmlspecialchars($_POST['clave'],ENT_QUOTES,'UTF-8'));
        break;
    
}