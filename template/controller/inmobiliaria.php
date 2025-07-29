<?php
require_once("../config/encrypt.php");
require_once("../config/conexion.php");
require_once("../model/Inmobiliaria.php");

$inmobiliaria = new Inmobiliaria();

switch ($_GET["op"]) {

    case "combo_distri":
        $datos = $inmobiliaria->combo_distri();
        if(is_array($datos)==true and count($datos)>0){
            $html= "<option value='' data-display='Ubicación'>Ubicación </option>";
            foreach($datos as $row){
                $html.= "<option value='".$row['id']."'>".$row['depart']." - ".$row['distri']."</option>";
            }
            echo $html;
        }
        break;

    case "combo_pisos":
        $datos = $inmobiliaria->combo_pisos();
        if(is_array($datos)==true and count($datos)>0){
            $html= "<option value='' data-display='Pisos'>Pisos</option>";
            foreach($datos as $row){
                $html.= "<option value='".$row['npisos']."'>".$row['npisos']."</option>";
            }
            echo $html;
        }
        break;
    
    case "combo_dormitorios":
        $datos = $inmobiliaria->combo_dormitorios();
        if(is_array($datos)==true and count($datos)>0){
            $html= "<option value='' data-display='Pisos'>Dormitorios</option>";
            foreach($datos as $row){
                $html.= "<option value='".$row['ndormit']."'>".$row['ndormit']."</option>";
            }
            echo $html;
        }
        break;
    
    case "rango_precio":
        $datos = $inmobiliaria->rango_precio();
        
        if (!empty($datos)) {
            echo json_encode($datos);
        }
        break;

    case "mostar_tipos":
        $datos = $inmobiliaria->mostar_tipos();
        echo json_encode($datos);
        break;

    case "listar_propiedades":

        $datos = $inmobiliaria->listar_inmobiliaria($_POST);
        $html = '';

        foreach ($datos as $row) {

            $link = 'inmobiliaria-detalle.php?v='.Encryption::encrypt($row['id']);

            $ruta_imagen = $row["ruta_imagen"];
            $ruta_web = "../" . $ruta_imagen; // Para mostrar la imagen en el navegador
            
            $moneda = ($row["moneda"]) == 'USD' ? '$' : 'S/';
            $precio = $moneda .' '. number_format($row["precio"], 0, '.', ',');
            $badge = strtolower($row["modalidad"]) == 'v' ? 'Venta' : 'Alquiler';

            // Comprobamos si es terreno
            $esTerreno = strtolower(trim($row["tipo_propiedad"])) === 'terreno';

            // Comprobamos si es local
            $esLocal = strtolower(trim($row["tipo_propiedad"])) === 'local comercial';

            // Contenido dinámico para las características
            $contenido_propiedad = '';
            if ($esTerreno || $esLocal) {
                $contenido_propiedad .= '
                    <li class="list-inline-item">
                        <span>Área <br><i class="fa fa-map"></i> ' . htmlspecialchars($row["area"]) . ' m²</span>
                    </li>';
            } else {
                $contenido_propiedad .= '
                    <li class="list-inline-item">
                        <span>Pisos <br><i class="fa fa-inbox"></i> ' . (int)$row["npisos"] . '</span>
                    </li>
                    <li class="list-inline-item">
                        <span>Dormit. <br><i class="fa fa-bed"></i> ' . (int)$row["ndormit"] . '</span>
                    </li>
                    <li class="list-inline-item">
                        <span>Baños <br><i class="fa fa-bath"></i> ' . (int)$row["nbanos"] . '</span>
                    </li>
                    <li class="list-inline-item">
                        <span>Área <br><i class="fa fa-map"></i> ' . htmlspecialchars($row["area"]) . ' m²</span>
                    </li>';
            }

            $html.= '<div class="col-md-6 col-lg-4 filtr-item" data-category="2, 4" data-title="">
                        <div class="card__image card__box-v1">
                            <div class="card__image-header h-250">
                                <img src="' . $ruta_web . '" class="img-fluid w100 img-transition">
                                <div class="info">'.htmlspecialchars($badge).'</div>
                            </div>
                            <div class="card__image-body">
                                <span class="badge badge-primary text-capitalize mb-2">'.htmlspecialchars($row["tipo_propiedad"]).'</span>
                                <h6 class="text-capitalize"><a href="'.$link.'">'.htmlspecialchars($row["nombre"]).'</a></h6>
                                <p class="text-capitalize">
                                    <i class="fa fa-map-marker"></i>
                                    '.htmlspecialchars($row["distrito"]).', '.htmlspecialchars($row["depart"]).'
                                </p>
                                <ul class="list-inline card__content">
                                    ' . $contenido_propiedad . '
                                </ul>
                            </div>
                            <div class="card__image-footer">
                                <figure>
                                    <img src="images/logo_g2.png" alt="" class="img-fluid rounded-circle">
                                </figure>
                                <ul class="list-inline my-auto">
                                    <li class="list-inline-item">
                                        <a href="#">Global MJF</a>
                                    </li>
                                </ul>
                                <ul class="list-inline my-auto ml-auto">
                                    <li class="list-inline-item">
                                        <h6>'.$precio.'</h6>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>';
        }
        echo $html;
        break;
    
    case "mostrar_inmobiliaria":
        $params = $_POST;
        $params['limit'] = isset($_POST['limit']) ? intval($_POST['limit']) : 15;
        $params['offset'] = isset($_POST['offset']) ? intval($_POST['offset']) : 0;

        $resultado = $inmobiliaria->mostrar_inmobiliaria($params);
        $datos = $resultado['data'];
        $total = $resultado['total'];

        $html = '';

        foreach ($datos as $row) {
            $link = 'inmobiliaria-detalle.php?v=' . Encryption::encrypt($row['id']);
            $ruta_imagen = $row["ruta_imagen"];
            $ruta_web = "../" . $ruta_imagen;
            
            $moneda = ($row["moneda"] == 'USD') ? '$' : 'S/';
            $precio = $moneda . ' ' . number_format($row["precio"], 0, '.', ',');
            $badge = strtolower($row["modalidad"]) == 'v' ? 'Venta' : 'Alquiler';

            // Comprobamos si es terreno
            $esTerreno = strtolower(trim($row["tipo_propiedad"])) === 'terreno';

            // Comprobamos si es local
            $esLocal = strtolower(trim($row["tipo_propiedad"])) === 'local comercial';

            // Contenido dinámico para las características
            $contenido_propiedad = '';
            if ($esTerreno || $esLocal) {
                $contenido_propiedad .= '
                    <li class="list-inline-item">
                        <span>Área <br><i class="fa fa-map"></i> ' . htmlspecialchars($row["area"]) . ' m²</span>
                    </li>';
            } else {
                $contenido_propiedad .= '
                    <li class="list-inline-item">
                        <span>Pisos <br><i class="fa fa-inbox"></i> ' . (int)$row["npisos"] . '</span>
                    </li>
                    <li class="list-inline-item">
                        <span>Dormit. <br><i class="fa fa-bed"></i> ' . (int)$row["ndormit"] . '</span>
                    </li>
                    <li class="list-inline-item">
                        <span>Baños <br><i class="fa fa-bath"></i> ' . (int)$row["nbanos"] . '</span>
                    </li>
                    <li class="list-inline-item">
                        <span>Área <br><i class="fa fa-map"></i> ' . htmlspecialchars($row["area"]) . ' m²</span>
                    </li>';
            }

            $html .= '
            <div class="col-md-4 col-lg-4">
                <div class="card__image card__box-v1">
                    <div class="card__image-header h-250">
                        <img src="' . $ruta_web . '" class="img-fluid w100 img-transition">
                        <div class="info">' . htmlspecialchars($badge) . '</div>
                    </div>
                    <div class="card__image-body">
                        <span class="badge badge-primary text-capitalize mb-2">' . htmlspecialchars($row["tipo_propiedad"]) . '</span>
                        <h6 class="text-capitalize"><a href="' . $link . '">' . htmlspecialchars($row["nombre"]) . '</a></h6>
                        <p class="text-capitalize">
                            <i class="fa fa-map-marker"></i>
                            '.htmlspecialchars($row["distrito"]).', '.htmlspecialchars($row["depart"]).'
                        </p>
                        <ul class="list-inline card__content">
                            ' . $contenido_propiedad . '
                        </ul>
                    </div>
                    <div class="card__image-footer">
                        <figure>
                            <img src="images/logo_g2.png" alt="" class="img-fluid rounded-circle">
                        </figure>
                        <ul class="list-inline my-auto">
                            <li class="list-inline-item">
                                <a href="#">Global MJF</a>
                            </li>
                        </ul>
                        <ul class="list-inline my-auto ml-auto">
                            <li class="list-inline-item">
                                <h6>' . $precio . '</h6>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>';
        }

        echo json_encode([
            'html' => $html,
            'total' => $total
        ]);
        break;
    
    case "info_propiedad":
        $datos = $inmobiliaria->info_propiedad($_POST["id"]);
        if (is_array($datos) == true and count($datos) > 0) {
            foreach ($datos as $row) {
                $output["id"]         = $row["id"];
                $output["codigo"]     = $row["codigo"];
                $output["id_t_prop"]  = $row["id_t_prop"];
                $output["tipo_propiedad"]  = $row["tipo_propiedad"];

                $output["area"]       = $row["area"];
                $output["aconstru"]   = $row["aconstru"];
                
                $output["nombre"]     = $row["nombre"];
                $output["direccion"]  = $row["direccion"];
                $output["distrito"]   = $row["distrito"];
                $output["precio"]     = number_format((float)$row['precio'], 2, '.', ',');
                $output["moneda"]     = $row["moneda"];
                $output["modalidad"]  = $row["modalidad"];
                $output["longitud"]   = $row["longitud"];
                $output["latitud"]    = $row["latitud"];
                $output["descrip"]    = mb_convert_encoding($row["descrip"], 'UTF-8');
                
                $output["npisos"]           = $row["npisos"];
                $output["ndormit"]          = $row["ndormit"];
                $output["nbanos"]           = $row["nbanos"];
                $output["ncochera"]         = $row["ncochera"];
                $output["ncocina"]          = $row["ncocina"];
                $output["nlavand"]          = $row["nlavand"];
                $output["ndeposito"]        = $row["ndeposito"];
                $output["antiguedad"]       = $row["antiguedad"];
                $output["mantenimiento"]    = $row["mantenimiento"];

                $output["valmcua"]    = $row["valmcua"];
                $output["estado_im"]  = $row["estado_im"];

                switch ($row["ubicacion"]) {
                    case "E":
                        $ubicacion = 'Esquinero';
                        break;
                    case "ME":
                       $ubicacion = 'Medianero';
                        break;
                    case "I":
                       $ubicacion = 'Intermedio';
                        break;
                    case "F":
                       $ubicacion = 'Frontal';
                        break;
                    case "P":
                       $ubicacion = 'Posterior';
                        break;
                    case "D":
                       $ubicacion = 'Doble frente';
                        break;
                    default:
                       $ubicacion = 'Sin ubicación';
                        break;
                }

                $output["ubicacion"]  = $ubicacion;
            }
            echo json_encode($output);
        }
        break;
    
    case "fotos_x_inmobiliaria":
        $datos = $inmobiliaria->fotos_x_inmobiliaria($_POST["id"]);

        foreach ($datos as &$row) {
            $row["ruta_web"]            =  "../" . $row["ruta_imagen"];
            $row["inmobiliaria_nombre"] =  $row["inmobiliaria_nombre"];
            $row["tipo_propiedad"]      =  $row["tipo_propiedad"];
        }

        header('Content-Type: application/json');
        echo json_encode($datos);
        break;

    case "propiedad_relacionado":
        $datos = $inmobiliaria->propiedad_relacionado($_POST["id"]);
        $html = '';

        if (empty($datos)) {
            echo '<div class="text-center p-4"><p class="text-muted">No hay propiedades relacionados disponibles</p></div>';
            break;
        }

        $html .= '<div class="carrusel-wrapper">';

        foreach ($datos as $row) {
            $link = 'inmobiliaria-detalle.php?v=' . Encryption::encrypt($row['id']);
            $ruta_web = "../" . $row["ruta_imagen"];

            $moneda = ($row["moneda"]) == 'USD' ? '$' : 'S/';
            $precio = $moneda .' '. number_format($row["precio"], 0, '.', ',');
            $badge = strtolower($row["modalidad"]) == 'v' ? 'Venta' : 'Alquiler';

            // Comprobamos si es terreno
            $esTerreno = strtolower(trim($row["tipo_propiedad"])) === 'terreno';

            // Contenido dinámico para las características
            $contenido_propiedad = '';
            if ($esTerreno) {
                $contenido_propiedad .= '
                    <li class="list-inline-item">
                        <span>Área <br><i class="fa fa-map"></i> ' . htmlspecialchars($row["area"]) . ' m²</span>
                    </li>';
            } else {
                $contenido_propiedad .= '
                    <li class="list-inline-item">
                        <span>Pisos <br><i class="fa fa-inbox"></i> ' . (int)$row["npisos"] . '</span>
                    </li>
                    <li class="list-inline-item">
                        <span>Dormit. <br><i class="fa fa-bed"></i> ' . (int)$row["ndormit"] . '</span>
                    </li>
                    <li class="list-inline-item">
                        <span>Baños <br><i class="fa fa-bath"></i> ' . (int)$row["nbanos"] . '</span>
                    </li>
                    <li class="list-inline-item">
                        <span>Área <br><i class="fa fa-map"></i> ' . htmlspecialchars($row["area"]) . ' m²</span>
                    </li>';
            }

            $html .= '
            <div class="col-12 col-lg-4" style="margin-top: -20px; padding-left: 0px !important; padding-right: 0px !important; max-width: 350px;">
                <div class="card__image card__box-v1">
                    <div class="card__image-header h-250">
                        <img src="' . $ruta_web . '" class="img-fluid w100 img-transition">
                        <div class="info">'.htmlspecialchars($badge).'</div>
                    </div>
                    <div class="card__image-body">
                        <span class="badge badge-primary text-capitalize mb-2">'.htmlspecialchars($row["tipo_propiedad"]).'</span>
                        <h6 class="text-capitalize"><a href="'.$link.'">'.htmlspecialchars($row["nombre"]).'</a></h6>
                        <p class="text-capitalize">
                            <i class="fa fa-map-marker"></i>
                            '.htmlspecialchars($row["distrito"]).', '.htmlspecialchars($row["depart"]).'
                        </p>
                        <ul class="list-inline card__content">
                            ' . $contenido_propiedad . '
                        </ul>
                    </div>
                    <div class="card__image-footer">
                        <figure>
                            <img src="images/logo_g2.png" alt="" class="img-fluid rounded-circle">
                        </figure>
                        <ul class="list-inline my-auto">
                            <li class="list-inline-item">
                                <a href="#">Global MJF</a>
                            </li>
                        </ul>
                        <ul class="list-inline my-auto ml-auto">
                            <li class="list-inline-item">
                                <h6>'.$precio.'</h6>
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
        $inmobiliaria->enviar_formulario($_POST['id_inmobiliaria'], $_POST['nombre'], $_POST['telefono'], $_POST['correo'], $_POST['mensaje']);
        break;
}
