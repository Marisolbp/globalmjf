<?php
require_once("../config/conexion.php");
require_once("../model/Slider.php");
require_once("../model/Miembro.php");
require_once("../model/Nosotros.php");
$slider = new Slider();
$miembro = new Miembro();
$nosotros = new Nosotros();

switch($_GET["op"]){

    case "mostrar_foto":
        $datos = $slider->listar_foto_slider();

        if (count($datos) == 0) {
            echo "<p>No hay fotos para mostrar</p>";
            exit;
        }

        $indicators = '';
        $slides = '';
        $i = 0;

        foreach($datos as $row) {
            $active = ($i === 0) ? 'active' : '';
            $foto_base64 = base64_encode($row["foto"]);

            // Indicadores
            $indicators .= '<li data-target="#carouselExampleIndicators" data-slide-to="'.$i.'" class="'.$active.'"></li>';

            // Slides
            $slides .= '
                <div class="carousel-item '.$active.' banner-max-height">
                    <img class="d-block w-100" src="data:image/jpeg;base64,'.$foto_base64.'" alt="Slide '.$i.'">
                    <div class="carousel-caption banner__slide-overlay d-flex h-100">
                        <div class="carousel__content">
                            <div class="container">
                                <div class="row justify-content-center">
                                    <div class="col-lg-10 col-md-12 col-sm-12 text-center">
                                        <div class="slider__content-title ">
                                            <h2 data-animation="fadeInDown" data-delay=".2s" data-duration="1000ms"
                                                class="text-white animated fadeInDown">
                                                '.$row["titulo"].'
                                            </h2>
                                            <p data-animation="fadeInUp" data-delay=".4s" data-duration="1000ms"
                                                class="text-white animated fadeInUp">
                                                '.$row["subtitulo"].'
                                            </p>
                                            <a href="#" data-animation="fadeInUp" data-delay=".6s" data-duration="1000ms"
                                                class="btn btn-primary text-uppercase animated fadeInUp">
                                                CONTÁCTANOS
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>';
            $i++;
        }

        // Estructura del slider completo
        $html = '
            <div class="container-slider-image-full">
                <div id="carouselExampleIndicators" class="carousel slide carousel-fade" data-ride="carousel">
                    <ol class="carousel-indicators d-none">
                        '.$indicators.'
                    </ol>
                    <div class="carousel-inner">
                        '.$slides.'
                    </div>
                    <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                        <span class="carousel-control-nav-prev">
                            <i class="fa fa-2x fa-angle-left"></i>
                        </span>
                    </a>
                    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                        <span class="carousel-control-nav-next">
                            <i class="fa fa-2x fa-angle-right"></i>
                        </span>
                    </a>
                </div>
            </div>';

        echo $html;
        break;

    case "mostrar_equipo":
        $datos = $miembro->listar_miembro();

        if (count($datos) == 0) {
            echo "<p>No hay miembros para mostrar</p>";
            exit;
        }

        $html = '';

        foreach($datos as $row) {
            $foto_base64 = base64_encode($row["foto"]);
            $nombre_completo = $row["nombre"] . ' ' . $row["apellido"];

            $html .= '
            <div class="col-md-6 col-lg-4 mb-4">
                <div class="wrap-agent">
                    <div class="team-member">
                        <div class="team-img">
                            <img alt="team member" class="img-fluid w-100" src="data:image/jpeg;base64,'.$foto_base64.'">
                        </div>
                        <div class="team-hover">
                            <div class="desk">
                                <h5>
                                    CAP '.htmlspecialchars($row["codcap"]).'
                                </h5>
                                <p>
                                    '.htmlspecialchars($row["detapuesto"]).'
                                </p>
                                <a class="btn btn-primary" href="nosotros.php">
                                    Perfil profesional
                                </a>
                            </div>
                            <ul class="list-inline s-link mb-0">';

            // redes sociales opcionales
            if (!empty($row["linkedin"])) {
                $html .= '<li class="list-inline-item"><a href="https://www.linkedin.com/in/'.$row["linkedin"].'" target="_blank"><i class="fab fa-linkedin"></i></a></li>';
            }
            if (!empty($row["instagram"])) {
                $html .= '<li class="list-inline-item"><a href="https://www.instagram.com/'.$row["instagram"].'" target="_blank"><i class="fab fa-instagram"></i></a></li>';
            }
            if (!empty($row["correo"])) {
                $html .= '<li class="list-inline-item"><a href="mailto:'.$row["correo"].'"><i class="fa fa-envelope"></i></a></li>';
            }

            $html .= '</ul>
                        </div>
                        <div class="team-title">
                            <h6>'.htmlspecialchars($nombre_completo).'</h6>
                            <span>'.htmlspecialchars($row["puesto"]).'</span>
                        </div>
                    </div>
                </div>
            </div>';
        }

        echo $html;
        break;

    case "informacion_principal":
        $row = $nosotros->informacion_principal();

        if (is_array($row)) {
            $output["direccion"] = $row["direccion"];
            $output["numero"]    = $row["numero"];
            $output["correo"]    = $row["correo"];
            $output["facebook"]  = $row["facebook"];
            $output["linkedin"]  = $row["linkedin"];
            $output["instagram"] = $row["instagram"];
            echo json_encode($output);
        }
        break;

}