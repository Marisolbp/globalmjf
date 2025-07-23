<?php
require_once("../config/conexion.php");
require_once("../model/Nosotros.php");
require_once("../model/Miembro.php");
$nosotros = new Nosotros();
$miembro = new Miembro();

switch($_GET["op"]) {
    case "mostrar_datos":
        $datos = $nosotros->mostrar_datos();
        if (is_array($datos) == true and count($datos) > 0) {
           foreach ($datos as $row) {
                $output["quienes_somos"]    = $row["quienes_somos"];
                $output["vision"]           = $row["vision"];
                $output["mision"]           = $row["mision"];
            }
            echo json_encode($output);
        }
        break;

    case "mostrar_perfiles_completos":
        $miembros = $miembro->listar_miembro();
        $html = '';

        foreach ($miembros as $row) {
            $id_miembro = $row["id"];
            $especialidades = $miembro->listar_especialidades($id_miembro);
            $foto_base64 = base64_encode($row["foto"]);
            $nombre_completo = strtoupper($row["nombre"] . ' ' . $row["apellido"]);

            $html .= '
            <div class="col-12 col-xl-12">
                <div class="agent-container">
                    <div class="col-lg-4 d-flex">
                        <div class="agent-card">
                            <div class="photo-container text-center">
                                <div class="listing-badge">CAP '.$row["codcap"].'</div>
                                <img src="data:image/jpeg;base64,'.$foto_base64.'" class="agent-photo">
                            </div>
                            <div class="agent-info">
                                <h2 class="agent-name">'.$nombre_completo.'</h2>
                                <p class="agent-title">'.htmlspecialchars($row["detapuesto"]).'</p>
                                <ul class="contact-list">
                                    <li class="contact-item">
                                        <div class="contact-icon"><i class="fas fa-phone"></i></div>
                                        <div class="contact-text"><a href="tel:'.$row["contacto"].'">'.$row["contacto"].'</a></div>
                                    </li>
                                    <li class="contact-item">
                                        <div class="contact-icon"><i class="fas fa-envelope"></i></div>
                                        <div class="contact-text"><a href="mailto:'.$row["correo"].'">'.$row["correo"].'</a></div>
                                    </li>
                                </ul>
                                <div class="social-buttons">';
                                    if (!empty($row["linkedin"])) {
                                        $html .= '<a href="https://www.linkedin.com/in/'.$row["linkedin"].'" class="social-btn linkedin" target="_blank"><i class="fab fa-linkedin-in"></i></a>';
                                    }
                                    if (!empty($row["instagram"])) {
                                        $html .= '<a href="https://www.instagram.com/'.$row["instagram"].'" class="social-btn instagram" target="_blank"><i class="fab fa-instagram"></i></a>';
                                    }
            $html .=        '</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-8 d-flex">
                        <div class="description-section">
                            <h3 class="section-title">Descripción</h3>
                            <p class="description-text">'.nl2br($row["descrip"]).'</p>';

                            if (count($especialidades) > 0) {
                                $html .= '
                                    <h4 class="specialties-title">Especialidades y Certificaciones:</h4>
                                    <ul class="specialties-list">';

                                foreach ($especialidades as $esp) {
                                    $html .= '
                                        <li class="specialty-item">
                                            <div class="specialty-bullet"></div>
                                            <div class="specialty-text">'.htmlspecialchars($esp["especialidad"]).'</div>
                                        </li>';
                                }

                                $html .= '</ul>';
                            }

            $html .= '</div>
                    </div>
                </div>
            </div>';
        }

        echo $html;
        break;

}