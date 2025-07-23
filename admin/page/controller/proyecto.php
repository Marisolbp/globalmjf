<?php
require_once("../config/conexion.php");
require_once("../model/Proyecto.php");
$proyecto = new Proyecto();

switch($_GET["op"]){

    case "listar":
        $datos=$proyecto->get_proyecto();
        $data= Array();
        foreach($datos as $row){
            $sub_array = array();
            $sub_array[] = $row["nombre"];
            $sub_array[] = ($row['npisos'] == 0) ? '----' : $row['npisos'];
            $sub_array[] = ($row['ndormit'] == 0) ? '----' : $row['ndormit'];
            $sub_array[] = ($row['nbanos'] == 0) ? '----' : $row['nbanos'];
            $sub_array[] = $row["area"] . " m²";
            $sub_array[] = '<a class="badge badge-pill badge-light-primary">'.$row["tipo"].'</a>';

            if ($row["estado"]=="A"){
                $sub_array[] = '<a class="badge badge-pill badge-light-success" style="cursor:pointer" onClick="Inactivar('.$row["id"].');">Activo</a>';
            }else{
                $sub_array[] = '<a class="badge badge-pill badge-light-danger" style="cursor:pointer" onClick="Activar('.$row["id"].');">Inactivo</a>';
            }
            
            $sub_array[] = '<div class="dropup">
                               <span class="bx bx-dots-vertical-rounded font-medium-3 dropdown-toggle nav-hide-arrow cursor-pointer" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" role="menu">
                               </span>
                               <div class="dropdown-menu dropdown-menu-right dropdown-menu-end">
                                   <a class="dropdown-item" style="cursor:pointer;" onClick="editarRegistro(\'' . $row['id'] . '\');"><i class="bx bx-edit-alt mr-1"></i> Editar</a>
                                   <a class="dropdown-item" style="cursor:pointer;" onClick="registrarFoto(\'' . $row['id'] . '\');"><i class="bx bx-images mr-1"></i> Fotos</a>
                               </div>
                           </div>';

            $data[] = $sub_array;
        }

        $results = array(
            "sEcho"=>1,
            "iTotalRecords"=>count($data),
            "iTotalDisplayRecords"=>count($data),
            "aaData"=>$data);
        echo json_encode($results);
        break;

    case "registrar":

        header('Content-Type: application/json; charset=utf-8');
        $descripcion = $_POST['descrip'];

        if (!mb_check_encoding($descripcion, 'UTF-8')) {
            $descripcion = mb_convert_encoding($descripcion, 'UTF-8');
        }

        $estado = $_POST['estado_real'];
        $proyecto->registrar($_POST['nombre'], $_POST['id_t_prop'], $descripcion, $_POST['npisos'], $_POST['ndormit'], $_POST['nbanos'], $_POST['area'], $estado,  $_SESSION['usuario']);
        break;

    case "obtener":
        $datos = $proyecto->proyecto_x_id($_POST["id"]);
        if (is_array($datos) == true and count($datos) > 0) {
           foreach ($datos as $row) {
                $output["id"]           = $row["id"];
                $output["nombre"]       = $row["nombre"];
                $output["descrip"]      = $row["descrip"];
                $output["npisos"]       = $row["npisos"];
                $output["ndormit"]      = $row["ndormit"];
                $output["nbanos"]       = $row["nbanos"];
                $output["area"]         = $row["area"];
                $output["id_t_prop"]    = $row["id_t_prop"];
                $output["tipo"]         = $row["tipo"];
                $output["estado"]       = $row["estado"];
            }
            echo json_encode($output);
        }
        break;

    case "editar":

        header('Content-Type: application/json; charset=utf-8');
        $descripcion = $_POST['descrip'];

        if (!mb_check_encoding($descripcion, 'UTF-8')) {
            $descripcion = mb_convert_encoding($descripcion, 'UTF-8');
        }

        $estado = $_POST['estado_real'];
        $proyecto->editar($_POST['codigo'], $_POST['nombre'], $_POST['id_t_prop'], $descripcion, $_POST['npisos'],  $_POST['ndormit'], $_POST['nbanos'], $_POST['area'], $estado,  $_SESSION['usuario']);
        break;

    case "listar_foto":
        $datos = $proyecto->listar_foto($_POST['id_proyecto']);
        $data = Array();
        foreach($datos as $row){
            $sub_array = array();
            $sub_array[] = $row["nombre_original"];
            
            $ruta_imagen = $row["ruta_imagen"];
            $ruta_fisica = "../../../" . $ruta_imagen; // Para file_exists()
            $ruta_web = "../../../../" . $ruta_imagen; // Para mostrar la imagen en el navegador

            if (file_exists($ruta_fisica)) {
                $sub_array[] = '<img src="' . $ruta_web . '" alt="table-user" height="50px" width="50px" class="me-2 avatar-sm" />';
            } else {
                // Imagen por defecto si no existe el archivo
                $sub_array[] = '<img src="../../../assets/img/default-image.jpg" alt="imagen no encontrada" height="50px" width="50px" class="me-2 avatar-sm" />';
            }
            
            $sub_array[] = '<input type="number" class="form-control form-control-sm text-center input-orden"
                            value="'.$row["orden"].'" 
                            data-id="'.$row["id"].'" 
                            style="width: 50px; margin: 0 auto;">';
            
            $sub_array[] = '<div style="margin:auto;" class="badge-circle badge-circle-sm badge-circle-light-danger">
                                <a class="badge-circle badge-circle-sm badge-circle-light-warning" style="cursor:pointer" onClick="return eliminarFoto('."'".$row['id']."'".');"><i class="bx bx-trash font-size-base"></i></a>
                            </div>';
            
            $data[] = $sub_array;
        }
        
        $results = array(
            "sEcho" => 1,
            "iTotalRecords" => count($data),
            "iTotalDisplayRecords" => count($data),
            "aaData" => $data
        );
        
        echo json_encode($results);
        break;

    case "registrar_foto":
        if (isset($_FILES) && count($_FILES) > 0) {
            $total_archivos = $_POST['total_archivos'];
            $id_proyecto = $_POST['id_proyecto'];
            
            $response = [
                'success' => 0,
                'archivos_registrados' => 0,
                'archivos_duplicados' => 0,
                'errores' => 0
            ];

            // Crear directorio si no existe
            $directorio_base = "../../../photos/proyectos/" . $id_proyecto . "/";
            if (!file_exists($directorio_base)) {
                mkdir($directorio_base, 0755, true);
            }

            // Obtener el último valor de orden desde el modelo
            $ultimo_orden = $proyecto->obtener_ultimo_orden($id_proyecto);

            for ($i = 0; $i < $total_archivos; $i++) {
                if (isset($_FILES['foto' . $i])) {
                    $file = $_FILES['foto' . $i];
                    
                    // Validar que sea una imagen
                    $extensiones_permitidas = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
                    $extension = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
                    
                    if (!in_array($extension, $extensiones_permitidas)) {
                        $response['errores']++;
                        continue;
                    }

                    // Validar que sea realmente una imagen
                    if (getimagesize($file['tmp_name']) === false) {
                        $response['errores']++;
                        continue;
                    }

                    // Generar nombre único para el archivo
                    $nombre_original = pathinfo($file['name'], PATHINFO_FILENAME);
                    $nombre_archivo = $nombre_original . '_' . time() . '_' . ($i + 1) . '.' . $extension;
                    $ruta_completa = $directorio_base . $nombre_archivo;
                    $ruta_bd = "photos/proyectos/" . $id_proyecto . "/" . $nombre_archivo;
                    
                    $orden = $ultimo_orden + $i + 1;

                    // Verificar si ya existe un archivo con el mismo nombre original
                    $archivo_existe = $proyecto->verificar_archivo_existente($id_proyecto, $file['name']);
                    
                    if ($archivo_existe) {
                        $response['archivos_duplicados']++;
                        continue;
                    }

                    // Mover el archivo al directorio de destino
                    if (move_uploaded_file($file['tmp_name'], $ruta_completa)) {
                        // Registrar en la base de datos
                        $resultado = $proyecto->registrar_foto($id_proyecto, $ruta_bd, $file['name'], $orden);
                        
                        if ($resultado['success'] == 1) {
                            $response['archivos_registrados']++;
                        } else {
                            // Si falla la BD, eliminar el archivo físico
                            unlink($ruta_completa);
                            $response['errores']++;
                        }
                    } else {
                        $response['errores']++;
                    }
                }
            }

            if ($response['archivos_registrados'] > 0) {
                $response['success'] = 1;
            }

            header('Content-type: application/json; charset=utf-8');
            echo json_encode($response);
        }
        break;

    case "actualizar_orden_foto":
        $id = $_POST["id"];
        $orden = $_POST["orden"];
        $respuesta = $proyecto->actualizar_orden_foto($id, $orden);
        echo json_encode($respuesta);
        break;
    
    case "eliminar":
        $proyecto->eliminar($_POST['id']);
        break;
}