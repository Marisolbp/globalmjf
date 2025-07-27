<?php 
require_once("../config/encrypt.php");
require_once("../config/conexion.php");
require_once("../model/Proyecto.php");

$proyecto = new Proyecto();

switch ($_GET["op"]) {

    case "combo_pisos":
        $datos = $proyecto->combo_pisos();
        if(is_array($datos)==true and count($datos)>0){
            $html= "<option value='' data-display='Pisos'>Pisos</option>";
            foreach($datos as $row){
                $html.= "<option value='".$row['npisos']."'>".$row['npisos']."</option>";
            }
            echo $html;
        }
        break;
    
    case "combo_dormitorios":
        $datos = $proyecto->combo_dormitorios();
        if(is_array($datos)==true and count($datos)>0){
            $html= "<option value='' data-display='Pisos'>Dormitorios</option>";
            foreach($datos as $row){
                $html.= "<option value='".$row['ndormit']."'>".$row['ndormit']."</option>";
            }
            echo $html;
        }
        break;

    case "mostrar_proyectos":
        $datos = $proyecto->listar_proyectos($_POST);
        $html = '';

        foreach ($datos as $row) {

            $link = 'proyecto-detalle.php?v='.Encryption::encrypt($row['id']);

            $ruta_imagen = $row["ruta_imagen"];
            $ruta_web = "../" . $ruta_imagen; // Para mostrar la imagen en el navegador

            $npisos = ($row['npisos'] == 0) ? '-' : $row['npisos'];
            $ndormit = ($row['ndormit'] == 0) ? '-' : $row['ndormit'];
            $banos = ($row['nbanos'] == 0) ? '-' : $row['nbanos'];

            $html .= '
            <div class="col-md-4 col-lg-4">
                <div class="card__image card__box-v1">
                    <div class="card__image-header h-250">
                        <img src="' . $ruta_web . '" class="img-fluid w100 img-transition">
                    </div>
                    <div class="card__image-body">
                        <span class="badge badge-primary text-capitalize mb-2">'.htmlspecialchars($row["tipo_propiedad"]).'</span>
                        <h6 class="text-capitalize"><a href="'.$link.'">'.htmlspecialchars($row["nombre"]).'</a></h6>
                        <ul class="list-inline card__content">
                            <li class="list-inline-item">
                                <span>Pisos <br><i class="fa fa-inbox"></i> '.$npisos.'</span>
                            </li>
                            <li class="list-inline-item">
                                <span>Dormit. <br><i class="fa fa-bed"></i> '.$ndormit.'</span>
                            </li>
                            <li class="list-inline-item">
                                <span>Baños <br><i class="fa fa-bath"></i> '.$banos.'</span>
                            </li>
                            <li class="list-inline-item">
                                <span>Área <br><i class="fa fa-map"></i> '.$row["area"].' m²</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>';
        }

        echo $html;
        break;

    case "info_proyecto":
        $datos = $proyecto->info_proyecto($_POST["id"]);
        if (is_array($datos) == true and count($datos) > 0) {
            foreach ($datos as $row) {
                $output["id"]               = $row["id"];
                $output["nombre"]           = $row["nombre"];
                $output["descrip"]          = mb_convert_encoding($row["descrip"], 'UTF-8');
                $output["npisos"]           = $row["npisos"];
                $output["ndormit"]          = $row["ndormit"];
                $output["nbanos"]           = $row["nbanos"];
                $output["area"]             = $row["area"];
                $output["tipo_propiedad"]   = $row["tipo_propiedad"];
            }
            echo json_encode($output);
        }
        break;

    case "fotos_x_proyecto":
        $datos = $proyecto->fotos_x_proyecto($_POST["id"]);

        foreach ($datos as &$row) {
            $row["ruta_web"] = "../" . $row["ruta_imagen"];
            $row["proyecto_nombre"] =   $row["proyecto_nombre"];
            $row["tipo_propiedad"]  =   $row["tipo_propiedad"];
        }

        header('Content-Type: application/json');
        echo json_encode($datos);
        break;

    case "proyecto_relazionado":
        $datos = $proyecto->proyecto_relazionado($_POST["id"]);
        $html = '';

        if (empty($datos)) {
            echo '<div class="text-center p-4"><p class="text-muted">No hay proyectos relacionados disponibles</p></div>';
            break;
        }

        $html .= '<div class="carrusel-wrapper">';

        foreach ($datos as $row) {
            $link = 'proyecto-detalle.php?v=' . Encryption::encrypt($row['id']);
            $ruta_web = "../" . $row["ruta_imagen"];
            
            $npisos = ($row['npisos'] == 0) ? '-' : $row['npisos'];
            $ndormit = ($row['ndormit'] == 0) ? '-' : $row['ndormit'];
            $banos = ($row['nbanos'] == 0) ? '-' : $row['nbanos'];

            $html .= '
            <div class="col-12 col-lg-4" style="margin-top: -20px; padding-left: 0px !important; padding-right: 0px !important; max-width: 350px;">
                <div class="card__image card__box-v1">
                    <div class="card__image-header h-250">
                        <img src="' . $ruta_web . '" class="img-fluid w100 img-transition">
                    </div>
                    <div class="card__image-body">
                        <span class="badge badge-primary text-capitalize mb-2">'.htmlspecialchars($row["tipo_propiedad"]).'</span>
                        <h6 class="text-capitalize"><a href="'.$link.'">'.htmlspecialchars($row["nombre"]).'</a></h6>
                        <ul class="list-inline card__content">
                            <li class="list-inline-item">
                                <span>Pisos <br><i class="fa fa-inbox"></i> '.$npisos.'</span>
                            </li>
                            <li class="list-inline-item">
                                <span>Dormit. <br><i class="fa fa-bed"></i> '.$ndormit.'</span>
                            </li>
                            <li class="list-inline-item">
                                <span>Baños <br><i class="fa fa-bath"></i> '.$banos.'</span>
                            </li>
                            <li class="list-inline-item">
                                <span>Área <br><i class="fa fa-map"></i> '.$row["area"].' m²</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>';
        }

        $html .= '</div>'; // fin carrusel-wrapper
        echo $html;
        break;

    case "enviar_formulario":
        $proyecto->enviar_formulario($_POST['id_proyecto'], $_POST['nombre'], $_POST['telefono'], $_POST['correo'], $_POST['mensaje']);
        break;
}
