<?php
require_once("../config/encrypt.php");
require_once("../config/conexion.php");
require_once("../model/Inmobiliaria.php");

$inmobiliaria = new Inmobiliaria();

switch ($_GET["op"]) {

    case "mostar_tipos":
        $datos = $inmobiliaria->mostar_tipos();
        echo json_encode($datos);
        break;

    case "listar_propiedades":

        $datos = $inmobiliaria->listar_inmobiliaria($_POST['id_t_prop']);
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
                        <span>Baths <br><i class="fa fa-bath"></i> ' . (int)$row["nbanos"] . '</span>
                    </li>
                    <li class="list-inline-item">
                        <span>Beds <br><i class="fa fa-bed"></i> ' . (int)$row["ndormit"] . '</span>
                    </li>
                    <li class="list-inline-item">
                        <span>Rooms <br><i class="fa fa-inbox"></i> ' . (int)$row["npisos"] . '</span>
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
                                    '.htmlspecialchars($row["distrito"]).'
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
        $datos = $inmobiliaria->listar_inmobiliaria(0);
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
                        <span>Baths <br><i class="fa fa-bath"></i> ' . (int)$row["nbanos"] . '</span>
                    </li>
                    <li class="list-inline-item">
                        <span>Beds <br><i class="fa fa-bed"></i> ' . (int)$row["ndormit"] . '</span>
                    </li>
                    <li class="list-inline-item">
                        <span>Rooms <br><i class="fa fa-inbox"></i> ' . (int)$row["npisos"] . '</span>
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
                            ' . htmlspecialchars($row["distrito"]) . '
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


        echo $html;
        break;
    
    case "info_propiedad":
        $datos = $inmobiliaria->info_propiedad($_POST["id"]);
        if (is_array($datos) == true and count($datos) > 0) {
            foreach ($datos as $row) {
                $output["id"]         = $row["id"];
                $output["codigo"]     = $row["codigo"];
                $output["id_t_prop"]  = $row["id_t_prop"];

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
                $output["ubicacion"]  = $row["ubicacion"];
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
                        <span>Baths <br><i class="fa fa-bath"></i> ' . (int)$row["nbanos"] . '</span>
                    </li>
                    <li class="list-inline-item">
                        <span>Beds <br><i class="fa fa-bed"></i> ' . (int)$row["ndormit"] . '</span>
                    </li>
                    <li class="list-inline-item">
                        <span>Rooms <br><i class="fa fa-inbox"></i> ' . (int)$row["npisos"] . '</span>
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
}
