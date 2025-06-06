<?php
require_once("../config/conexion.php");
require_once("../model/Slider.php");
$slider = new Slider();

switch($_GET["op"]){

    case "listar":
        $datos=$slider->get_slider();
        $data= Array();
        foreach($datos as $row){
            $sub_array = array();

            $sub_array[] = $row["nombre"];

            $foto_base64 = base64_encode($row["foto"]);

            $sub_array[] = '<img src="data:image/jpeg;base64,'.$foto_base64.'" alt="table-user" height="50px" width="50px" class="me-2 avatar-sm" />';

            $sub_array[] = '<input type="number" class="form-control form-control-sm text-center input-orden"
                            value="'.$row["orden"].'" 
                            data-id="'.$row["id"].'" 
                            style="width: 50px; margin: 0 auto;">';

            $sub_array[] = '<div style="margin:auto;" class="badge-circle badge-circle-sm badge-circle-light-danger">
                                <a class="badge-circle badge-circle-sm badge-circle-light-warning" style="cursor:pointer" onClick="return eliminarFoto('."'".$row['id']."'".');"><i class="bx bx-trash font-size-base"></i>
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

    case "registrar_foto":
        if (isset($_FILES) && count($_FILES) > 0) {
            $total_archivos = $_POST['total_archivos'];
            $response = [
                'success' => 0,
                'archivos_registrados' => 0,
                'archivos_duplicados' => 0,
                'errores' => 0
            ];

            // Obtener el último valor de orden desde el modelo
            $ultimo_orden = $slider->obtener_ultimo_orden();  // Este método lo creas en tu modelo

            for ($i = 0; $i < $total_archivos; $i++) {
                $file = $_FILES['foto' . $i];
                $foto_contenido = file_get_contents($file['tmp_name']);
                $foto_nombre = $file['name'];
                $orden = $ultimo_orden + $i + 1;
    
                // Llama al modelo con el orden calculado
                $resultado = $slider->registrar_foto($foto_contenido, $foto_nombre, $_SESSION['usuario'], $orden);
                
                if ($resultado['success'] == 1) {
                    $response['archivos_registrados']++;
                } elseif ($resultado['success'] == 2) {
                    $response['archivos_duplicados']++;
                } else {
                    $response['errores']++;
                }
            }
    
            if ($response['archivos_registrados'] > 0) {
                $response['success'] = 1;
            }
    
            header('Content-type: application/json; charset=utf-8');
            echo json_encode($response);
        }
        break;

    case "eliminar":
        $slider->eliminar($_POST['id']);
        break;
    
    case "actualizar_orden":
        $id = $_POST["id"];
        $orden = $_POST["orden"];
        $respuesta = $slider->actualizar_orden($id, $orden);
        echo json_encode($respuesta);
        break;

}