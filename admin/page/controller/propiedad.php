<?php
require_once("../config/conexion.php");
require_once("../model/Propiedad.php");
$propiedad = new Propiedad();

switch($_GET["op"]){

    case "listar":
        $datos=$propiedad->get_propiedad();
        $data= Array();
        foreach($datos as $row){
            $sub_array = array();
            $sub_array[] = $row["codigo"];
            $sub_array[] = $row["nombre"];
            
            $sub_array[] = '<a class="badge badge-pill badge-light-primary">'.$row["tipo"].'</a>';

            $sub_array[] = $row["moneda_simbolo"] . ' ' . number_format((float)$row['precio'], 2, '.', ',');
            
            if ($row["modalidad"]=="A"){
                $sub_array[] = '<a class="badge badge-pill badge-light-warning">'.$row["tipo"].'</a>';
            }else{
                $sub_array[] = '<a class="badge badge-pill badge-light-warning">Venta</a>';
            }

            $sub_array[] = $row["distrito"];

            if ($row["estado_im"]=="B"){
                $sub_array[] = '<a class="badge badge-pill badge-light-success">Bueno</a>';
            } else if ($row["estado_im"]=="R"){
                $sub_array[] = '<a class="badge badge-pill badge-light-warning">Regular</a>';
            } else{
                $sub_array[] = '<a class="badge badge-pill badge-light-danger" >Malo</a>';
            }

            switch ($row["ubicacion"]) {
                case "E":
                    $sub_array[] = '<a class="badge badge-pill badge-light-secondary">Esquinero</a>';
                    break;
                case "ME":
                    $sub_array[] = '<a class="badge badge-pill badge-light-secondary">Medianero</a>';
                    break;
                case "I":
                    $sub_array[] = '<a class="badge badge-pill badge-light-secondary">Intermedio</a>';
                    break;
                case "F":
                    $sub_array[] = '<a class="badge badge-pill badge-light-secondary">Frontal</a>';
                    break;
                case "P":
                    $sub_array[] = '<a class="badge badge-pill badge-light-secondary">Posterior</a>';
                    break;
                case "D":
                    $sub_array[] = '<a class="badge badge-pill badge-light-secondary">Doble frente</a>';
                    break;
                default:
                    $sub_array[] = '<a class="badge badge-pill badge-light-secondary">Sin ubicación</a>';
                    break;
            }

            $sub_array[] = $row["atotal"]  . " m²";           

            if ($row["estado"]=="A"){
                $sub_array[] = '<a class="badge badge-pill badge-light-success" onClick="Inactivar('.$row["id"].');">Activo</a>';
            }else{
                $sub_array[] = '<a class="badge badge-pill badge-light-danger" onClick="Activar('.$row["id"].');">Inactivo</a>';
            }

            $sub_array[] = '<div class="dropup">
                               <span class="bx bx-dots-vertical-rounded font-medium-3 dropdown-toggle nav-hide-arrow cursor-pointer" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" role="menu">
                               </span>
                               <div class="dropdown-menu dropdown-menu-right dropdown-menu-end">
                                   <a class="dropdown-item" style="cursor:pointer;" onClick="editarRegistro(\'' . $row['id'] . '\');"><i class="bx bx-edit-alt mr-1"></i> Editar</a>
                                   <a class="dropdown-item" style="cursor:pointer;" onClick="registrarFoto(\'' . $row['id'] . '\');"><i class="bx bx-images mr-1"></i> Fotos</a>
                                   <a class="dropdown-item" style="cursor:pointer;" onClick="verDetalle(\'' . $row['id'] . '\');"><i class="bx bx-file mr-1"></i> Detalle</a>
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
        $usuario = $_SESSION['usuario'];

        $propiedad->registrar(
            $_POST['codigo'],
            $_POST['nombre'],
            $descripcion,
            $_POST['id_depart'],
            $_POST['id_provin'],
            $_POST['id_distri'],
            $_POST['direccion'],
            $_POST['longitud'],
            $_POST['latitud'],
            $_POST['npisos'],
            $_POST['ndormit'],
            $_POST['nbanos'],
            $_POST['ncochera'],
            $_POST['ncocina'],
            $_POST['nlavand'],
            $_POST['ndeposito'],
            $_POST['id_t_prop'],
            $_POST['moneda'],
            $_POST['precio'],
            $_POST['valmcua'],
            $_POST['modalidad'],
            $_POST['antiguedad'],
            $_POST['mantenimiento'],
            $_POST['estado_im'],
            $_POST['ubicacion'],
            $_POST['atotal'],
            $_POST['aconstru'],
            $estado,
            $usuario
        );
        break;

    case "obtener":
        $datos = $propiedad->propiedad_x_id($_POST["id"]);
        if (is_array($datos) == true and count($datos) > 0) {
            foreach ($datos as $row) {
                $output["id"]            = $row["id"];
                $output["codigo"]        = $row["codigo"];
                $output["nombre"]        = $row["nombre"];
                $output["descrip"]       = mb_convert_encoding($row["descrip"], 'UTF-8');
                $output["id_depart"]     = $row["id_depart"];
                $output["departamento"]  = $row["departamento"];
                $output["id_provin"]     = $row["id_provin"]; // ← Este campo es esencial
                $output["provincia"]     = $row["provincia"];
                $output["id_distri"]     = $row["id_distri"];
                $output["distrito"]      = $row["distrito"];
                $output["direccion"]     = $row["direccion"];
                $output["longitud"]      = $row["longitud"];
                $output["latitud"]       = $row["latitud"];
                $output["npisos"]        = $row["npisos"];
                $output["ndormit"]       = $row["ndormit"];
                $output["nbanos"]        = $row["nbanos"];
                $output["ncochera"]      = $row["ncochera"];
                $output["ncocina"]       = $row["ncocina"];
                $output["nlavand"]       = $row["nlavand"];
                $output["ndeposito"]     = $row["ndeposito"];
                $output["id_t_prop"]     = $row["id_t_prop"];
                $output["tipo"]          = $row["tipo"];
                $output["moneda"]        = $row["moneda"];
                $output["precio"]        = $row["precio"];
                $output["modalidad"]     = $row["modalidad"];
                $output["antiguedad"]    = $row["antiguedad"];
                $output["mantenimiento"] = $row["mantenimiento"];
                $output["ubicacion"]     = $row["ubicacion"];
                $output["estado_im"]     = $row["estado_im"];
                $output["atotal"]        = $row["atotal"];
                $output["aconstru"]      = $row["aconstru"];
                $output["valmcua"]       = $row["valmcua"];
                $output["estado"]        = $row["estado"];
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

        $estado  = $_POST['estado_real'];
        $usuario = $_SESSION['usuario'];

        $propiedad->editar(
            $_POST['id'],
            $_POST['codigo'],
            $_POST['nombre'],
            $descripcion,
            $_POST['id_depart'],
            $_POST['id_provin'],
            $_POST['id_distri'],
            $_POST['direccion'],
            $_POST['longitud'],
            $_POST['latitud'],
            $_POST['npisos'],
            $_POST['ndormit'],
            $_POST['nbanos'],
            $_POST['ncochera'],
            $_POST['ncocina'],
            $_POST['nlavand'],
            $_POST['ndeposito'],
            $_POST['id_t_prop'],
            $_POST['moneda'],
            $_POST['precio'],
            $_POST['valmcua'],
            $_POST['modalidad'],
            $_POST['antiguedad'],
            $_POST['mantenimiento'],
            $_POST['estado_im'],
            $_POST['ubicacion'],
            $_POST['atotal'],
            $_POST['aconstru'],
            $estado,
            $usuario
        );
        break;

    case "listar_foto":
        $datos = $propiedad->listar_foto($_POST['id_propiedad']);
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
                                <a class="badge-circle badge-circle-sm badge-circle-light-warning" style="cursor:pointer" onClick="return eliminarFoto('."'".$row['id']."'".');"><i class="bx bx-trash font-size-base"></i>
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
            $id_propiedad = $_POST['id_propiedad'];
            
            $response = [
                'success' => 0,
                'archivos_registrados' => 0,
                'archivos_duplicados' => 0,
                'errores' => 0
            ];

            // Crear directorio si no existe
            $directorio_base = "../../../photos/inmobiliaria/" . $id_propiedad . "/";
            if (!file_exists($directorio_base)) {
                mkdir($directorio_base, 0755, true);
            }

            // Obtener el último valor de orden desde el modelo
            $ultimo_orden = $propiedad->obtener_ultimo_orden($id_propiedad);

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
                    $ruta_bd = "photos/inmobiliaria/" . $id_propiedad . "/" . $nombre_archivo;
                    
                    $orden = $ultimo_orden + $i + 1;

                    // Verificar si ya existe un archivo con el mismo nombre original
                    $archivo_existe = $propiedad->verificar_archivo_existente($id_propiedad, $file['name']);
                    
                    if ($archivo_existe) {
                        $response['archivos_duplicados']++;
                        continue;
                    }

                    // Mover el archivo al directorio de destino
                    if (move_uploaded_file($file['tmp_name'], $ruta_completa)) {
                        // Registrar en la base de datos
                        $resultado = $propiedad->registrar_foto($id_propiedad, $ruta_bd, $file['name'], $orden);
                        
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
        $respuesta = $propiedad->actualizar_orden_foto($id, $orden);
        echo json_encode($respuesta);
        break;
    
    case "eliminar":
        $propiedad->eliminar($_POST['id']);
        break;

    case "detalle":
        // Obtener el ID de la propiedad
        $id = $_POST["id"];
        
        // Instanciar el modelo
        $propiedad = new Propiedad();
        
        // Obtener los datos de la propiedad
        $datos_propiedad = $propiedad->propiedad_x_id($id);
        
        // Obtener las fotos de la propiedad
        $fotos = $propiedad->listar_foto($id);
        
        // Verificar si hay datos
        if(is_array($datos_propiedad) && count($datos_propiedad) > 0){
            // Extraer los datos de la propiedad
            $datos = $datos_propiedad[0];
            
            // Iniciar la construcción del HTML
            $html = '';
            
            // Sección de encabezado de la propiedad
            $html .= '<div class="property-header row mb-3">
                        <div class="col-md-8">
                            <h2 class="property-title">' . $datos["nombre"] . '</h2>
                            <p class="property-address"><i class="fa fa-map-marker"></i> ' . $datos["direccion"] . '</p>
                        </div>
                        <div class="col-md-4 text-right">
                            <h3 class="property-price">' . $datos["moneda_simbolo"] . ' ' . number_format($datos["precio"], 0, ".", ",") . '</h3>
                        </div>
                    </div>';
            
            // Sección de galería de imágenes - Rediseñada
            $html .= '<div class="property-gallery mb-2">';
            
            // Imagen principal en tamaño uniforme
            $html .= '<div class="main-image-container mb-3" id="main-property-image">';
            
            // Si hay fotos, mostrar la primera como principal
            if(is_array($fotos) && count($fotos) > 0){
                $html .= '<img src="data:image/jpeg;base64,' . base64_encode($fotos[0]["foto"]) . '" class="img-fluid rounded main-image-display" alt="Imagen principal">';
            } else {
                // Imagen por defecto si no hay fotos
                $html .= '<img src="../../assets/img/default-property.jpg" class="img-fluid rounded main-image-display" alt="Imagen no disponible">';
            }
            
            $html .= '</div>';
            
            // Miniaturas como slider debajo de la imagen principal
            $html .= '<div class="thumbnail-slider-container">
                        <div class="thumbnail-slider-wrapper">
                            <div class="thumbnail-slider" id="thumbnail-slider">';
            
            // Agregar miniaturas al slider
            if(is_array($fotos) && count($fotos) > 0){
                foreach($fotos as $index => $foto){
                    $activeClass = ($index == 0) ? 'active-thumbnail' : '';
                    $html .= '
                    <div class="thumbnail-item">
                        <img src="data:image/jpeg;base64,' . base64_encode($foto["foto"]) . '" 
                            class="img-fluid rounded thumbnail-image ' . $activeClass . '" 
                            alt="Miniatura ' . ($index + 1) . '"
                            data-index="' . $index . '" 
                            onclick="showMainImage(' . $index . ')">
                    </div>';
                }
            } else {
                // Placeholder si no hay fotos
                $html .= '
                <div class="thumbnail-item">
                    <div class="empty-thumbnail rounded">
                        <div class="empty-thumbnail-placeholder">
                            <i class="fa fa-image"></i>
                        </div>
                    </div>
                </div>';
            }
            
            $html .= '</div>';
            
            // Controles de navegación para el slider
            if(is_array($fotos) && count($fotos) > 4){
                $html .= '
                <button class="thumbnail-nav prev-button" id="prev-thumbnail">
                    <i class="fa fa-chevron-left"></i>
                </button>
                <button class="thumbnail-nav next-button" id="next-thumbnail">
                    <i class="fa fa-chevron-right"></i>
                </button>';
            }
            
            $html .= '</div></div></div>';
            
            // Array de fotos en formato JavaScript para cambio de imagen principal
            $html .= '<script>
                var propertyImages = [];
            ';
            
            if(is_array($fotos) && count($fotos) > 0){
                foreach($fotos as $index => $foto){
                    $html .= 'propertyImages[' . $index . '] = "data:image/jpeg;base64,' . base64_encode($foto["foto"]) . '";';
                }
            }
            
            $html .= '
                function showMainImage(index) {
                    if(index >= 0 && index < propertyImages.length) {
                        document.querySelector(".main-image-display").src = propertyImages[index];
                        
                        // Actualizar clase activa
                        document.querySelectorAll(".thumbnail-image").forEach(function(thumb) {
                            thumb.classList.remove("active-thumbnail");
                        });
                        
                        // Encontrar y activar la miniatura correspondiente
                        var activeThumbnail = document.querySelector(".thumbnail-image[data-index=\'" + index + "\']");
                        if(activeThumbnail) {
                            activeThumbnail.classList.add("active-thumbnail");
                            
                            // Desplazar slider para que la miniatura activa sea visible
                            var thumbnailItem = activeThumbnail.closest(".thumbnail-item");
                            var slider = document.getElementById("thumbnail-slider");
                            if(thumbnailItem && slider) {
                                slider.scrollLeft = thumbnailItem.offsetLeft - (slider.clientWidth / 2) + (thumbnailItem.clientWidth / 2);
                            }
                        }
                    }
                }
                
                // Inicializar controles del slider de miniaturas
                document.addEventListener("DOMContentLoaded", function() {
                    var prevButton = document.getElementById("prev-thumbnail");
                    var nextButton = document.getElementById("next-thumbnail");
                    var slider = document.getElementById("thumbnail-slider");
                    
                    if(prevButton && nextButton && slider) {
                        // Scroll del slider de miniaturas
                        var scrollAmount = 150;
                        
                        prevButton.addEventListener("click", function() {
                            slider.scrollLeft -= scrollAmount;
                        });
                        
                        nextButton.addEventListener("click", function() {
                            slider.scrollLeft += scrollAmount;
                        });
                    }
                });
            </script>';
            
            // Tabs para mostrar diferentes secciones
            $html .= '
            <ul class="nav nav-tabs" id="propertyTabs" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="description-tab" data-toggle="tab" href="#description" role="tab" aria-controls="description" aria-selected="true">Descripción</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="details-tab" data-toggle="tab" href="#details" role="tab" aria-controls="details" aria-selected="false">Detalles</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="location-tab" data-toggle="tab" href="#location" role="tab" aria-controls="location" aria-selected="false">Ubicación</a>
                </li>
            </ul>';
            
            // Contenido de las pestañas
            $html .= '<div class="tab-content" id="propertyTabsContent">';
            
            // Pestaña de descripción
            $html .= '
            <div class="tab-pane fade show active" id="description" role="tabpanel" aria-labelledby="description-tab">
                <p>' . nl2br($datos["descrip"]) . '</p>
            </div>';
            
            // Pestaña de detalles - Mejorada para mejor visualización
            $html .= '
            <div class="tab-pane fade" id="details" role="tabpanel" aria-labelledby="details-tab">
                <div class="property-details-container">';
            
            // Determinar qué campos mostrar según el tipo de propiedad
            $id_tipo_propiedad = $datos["id_t_prop"];
            
            // Mapeo de IDs a nombres de tipos de propiedad
            $tipos_propiedades = [
                '1' => 'Casa',
                '2' => 'Departamento',
                '3' => 'Terreno'
            ];
            
            // Mapeo de campos a etiquetas y categorías para mostrar
            $categorias = [
                'informacion_basica' => [
                    'titulo' => 'Información Básica',
                    'campos' => [
                        'codigo' => 'Código',
                        'id_t_prop' => 'Tipo de Propiedad',
                        'modalidad_nombre' => 'Modalidad',
                        'estado_im_nombre' => 'Estado'
                    ]
                ],
                'precio' => [
                    'titulo' => 'Precio',
                    'campos' => [
                        'moneda' => 'Moneda',
                        'precio' => 'Precio',
                        'valmcua' => 'Valor por m²'
                    ]
                ],
                'caracteristicas' => [
                    'titulo' => 'Características',
                    'campos' => [
                        'npisos' => 'Número de Pisos',
                        'ndormit' => 'Dormitorios',
                        'nbanos' => 'Baños',
                        'ncochera' => 'Cocheras',
                        'ncocina' => 'Cocinas',
                        'nlavand' => 'Lavanderías',
                        'ndeposito' => 'Depósitos'
                    ]
                ],
                'medidas' => [
                    'titulo' => 'Medidas',
                    'campos' => [
                        'atotal' => 'Área Total',
                        'aconstru' => 'Área Construida'
                    ]
                ],
                'condicion' => [
                    'titulo' => 'Condición',
                    'campos' => [
                        'antiguedad' => 'Antigüedad',
                        'mantenimiento' => 'Mantenimiento',
                        'ubicacion_nombre' => 'Ubicación'
                    ]
                ]
            ];
            
            // Función para generar una fila de la tabla si el campo existe
            function generarFilaTabla($label, $campo, $datos, $unidad = '') {
                if (isset($datos[$campo]) && $datos[$campo] !== '') {
                    $valor = $datos[$campo];
                    
                    // Formatear algunos tipos especiales de datos
                    if ($campo === 'precio') {
                        $moneda = isset($datos['moneda']) ? $datos['moneda'] : '$';
                        $valor = $moneda . ' ' . number_format($valor, 0, '.', ',');
                    } elseif ($campo === 'atotal' || $campo === 'aconstru' || $campo === 'valmcua') {
                        $valor = $valor . ' m²';
                    }
                    
                    return '<div class="detail-item">
                        <span class="detail-label">' . $label . '</span>
                        <span class="detail-value">' . $valor . $unidad . '</span>
                    </div>';
                }
                return '';
            }
            
            // Arrays con los campos según el tipo de propiedad
            $campos_por_tipo = [
                '1' => [ // CASA
                    'informacion_basica' => ['codigo', 'id_t_prop', 'modalidad_nombre', 'estado_im_nombre'],
                    'precio' => ['moneda', 'precio', 'valmcua'],
                    'caracteristicas' => ['npisos', 'ndormit', 'nbanos', 'ncochera', 'ncocina', 'nlavand', 'ndeposito'],
                    'medidas' => ['atotal', 'aconstru'],
                    'condicion' => ['antiguedad', 'ubicacion_nombre']
                ],
                '2' => [ // DEPARTAMENTO
                    'informacion_basica' => ['codigo', 'id_t_prop', 'modalidad_nombre', 'estado_im_nombre'],
                    'precio' => ['moneda', 'precio', 'valmcua'],
                    'caracteristicas' => ['npisos', 'ndormit', 'nbanos', 'ncochera', 'ncocina', 'nlavand', 'ndeposito'],
                    'medidas' => ['atotal', 'aconstru'],
                    'condicion' => ['antiguedad', 'mantenimiento', 'ubicacion_nombre']
                ],
                '3' => [ // TERRENO
                    'informacion_basica' => ['codigo', 'id_t_prop', 'modalidad_nombre', 'estado_im_nombre'],
                    'precio' => ['moneda', 'precio', 'valmcua'],
                    'medidas' => ['atotal'],
                    'condicion' => ['ubicacion_nombre']
                ]
            ];
            
            // Usar los campos del tipo seleccionado o predeterminado
            $campos_tipo = isset($campos_por_tipo[$id_tipo_propiedad]) ? 
                        $campos_por_tipo[$id_tipo_propiedad] : 
                        $campos_por_tipo['1']; // Default a casa si el tipo no existe
            
            // Generar la vista por categorías
            foreach ($categorias as $categoria_id => $categoria_info) {
                // Verificar si esta categoría existe para este tipo de propiedad
                if (!isset($campos_tipo[$categoria_id])) continue;
                
                $html .= '<div class="detail-category">
                        <h5 class="category-title">' . $categoria_info['titulo'] . '</h5>
                        <div class="detail-items-container">';
                
                // Caso especial para el tipo de propiedad
                if ($categoria_id === 'informacion_basica' && in_array('id_t_prop', $campos_tipo[$categoria_id])) {
                    $tipo_prop = isset($tipos_propiedades[$datos['id_t_prop']]) ? 
                            $tipos_propiedades[$datos['id_t_prop']] : 
                            $datos['id_t_prop'];
                    $html .= '<div class="detail-item">
                            <span class="detail-label">Tipo de Propiedad</span>
                            <span class="detail-value">' . $tipo_prop . '</span>
                            </div>';
                }
                
                // Generar el resto de campos para esta categoría
                foreach ($campos_tipo[$categoria_id] as $campo) {
                    if ($campo === 'id_t_prop') continue; // Ya lo manejamos arriba
                    
                    $etiqueta = isset($categoria_info['campos'][$campo]) ? 
                            $categoria_info['campos'][$campo] : 
                            ucfirst($campo);
                    
                    $html .= generarFilaTabla($etiqueta, $campo, $datos);
                }
                
                $html .= '</div></div>';
            }
            
            $html .= '</div></div>';
            
            // Pestaña de ubicación
            $html .= '
                <div class="tab-pane fade" id="location" role="tabpanel" aria-labelledby="location-tab">
                    <div class="location-map">
                        <div class="map-placeholder" style="height: 300px; background-color: #f5f5f5; display: flex; justify-content: center; align-items: center;">
                            <iframe
                                src="https://maps.google.com/maps?q=' . $datos["longitud"] . ',' . $datos["latitud"] . '&z=15&output=embed&markers=' . $datos["longitud"] . ',' . $datos["latitud"] . '"
                                width="100%"
                                height="300"
                                style="border:0;"
                                allowfullscreen=""
                                loading="lazy"
                                >
                            </iframe>
                        </div>
                    </div>
                    <div class="location-info mt-3">
                        <h5>Información de ubicación</h5>
                        <p><strong>Dirección:</strong> ' . $datos["direccion"] . '</p>
                        <p><strong>Departamento:</strong> ' . (isset($datos["departamento"]) ? $datos["departamento"] : 'N/A') . '</p>
                        <p><strong>Provincia/Estado:</strong> ' . (isset($datos["provincia"]) ? $datos["provincia"] : 'N/A') . '</p>
                        <p><strong>Distrito:</strong> ' . (isset($datos["distrito"]) ? $datos["distrito"] : 'N/A') . '</p>
                    </div>
                </div>';

            
            $html .= '</div>'; // Cierre de tab-content
            
            // Estilos CSS para el modal
            $html .= '
            <style>
                /* Estilos para el modal de propiedades */
                .property-title {
                    font-size: 1.8rem;
                    font-weight: 600;
                    margin-bottom: 5px;
                }
                
                .property-address {
                    color: #6c757d;
                    margin-bottom: 0;
                }
                
                .property-price {
                    color: #3383FF;
                    font-weight: 600;
                    margin-bottom: 10px;
                }
                
                /* Estilo para la imagen principal - tamaño uniforme */
                .main-image-container {
                    text-align: center;
                    background-color: #f8f9fa;
                    border-radius: 0.25rem;
                    overflow: hidden;
                    position: relative;
                    padding-top: 56.25%; /* Ratio 16:9 para mantener proporción */
                }
                
                .main-image-display {
                    position: absolute;
                    top: 0;
                    left: 0;
                    width: 100%;
                    height: 100%;
                    object-fit: contain; /* Mantiene la proporción y muestra la imagen completa */
                    background-color: #f8f9fa;
                }
                
                /* Estilo para el slider de miniaturas */
                .thumbnail-slider-container {
                    position: relative;
                    padding: 0 25px; /* Espacio para los botones de navegación */
                }
                
                .thumbnail-slider-wrapper {
                    overflow: hidden;
                    position: relative;
                }
                
                .thumbnail-slider {
                    display: flex;
                    overflow-x: auto;
                    scroll-behavior: smooth;
                    scrollbar-width: none; /* Firefox */
                    -ms-overflow-style: none; /* IE/Edge */
                    padding: 10px 0;
                    gap: 10px;
                }
                
                .thumbnail-slider::-webkit-scrollbar {
                    display: none; /* Chrome/Safari/Opera */
                }
                
                .thumbnail-item {
                    flex: 0 0 auto;
                    width: 100px;
                    height: 100px;
                }
                
                .thumbnail-image {
                    width: 100%;
                    height: 100%;
                    object-fit: cover;
                    border: 2px solid transparent;
                    transition: all 0.2s ease-in-out;
                    cursor: pointer;
                    border-radius: 0.25rem;
                }
                
                .thumbnail-image:hover {
                    border-color: #3383FF;
                }
                
                .thumbnail-image.active-thumbnail {
                    border-color: #3383FF;
                }
                
                /* Botones de navegación del slider */
                .thumbnail-nav {
                    position: absolute;
                    top: 50%;
                    transform: translateY(-50%);
                    background-color: rgba(255, 255, 255, 0.8);
                    border: 1px solid #dee2e6;
                    border-radius: 50%;
                    width: 30px;
                    height: 30px;
                    display: flex;
                    justify-content: center;
                    align-items: center;
                    cursor: pointer;
                    z-index: 2;
                    transition: all 0.2s ease;
                }
                
                .thumbnail-nav:hover {
                    background-color: #3383FF;
                    color: white;
                    border-color: #3383FF;
                }
                
                .prev-button {
                    left: -5px;
                }
                
                .next-button {
                    right: -5px;
                }
                
                .empty-thumbnail {
                    height: 100px;
                    width: 100px;
                    background-color: #f8f9fa;
                    border: 1px dashed #dee2e6;
                    display: flex;
                    justify-content: center;
                    align-items: center;
                    border-radius: 0.25rem;
                }
                
                .empty-thumbnail-placeholder {
                    color: #adb5bd;
                    font-size: 2rem;
                }
                
                /* Estilo mejorado para la tabla de detalles */
                .property-details-container {
                    display: flex;
                    flex-wrap: wrap;
                    gap: 20px;
                }
                
                .detail-category {
                    flex: 1 1 300px;
                    border: 1px solid #e9ecef;
                    border-radius: 0.25rem;
                    overflow: hidden;
                    box-shadow: 0 1px 3px rgba(0,0,0,0.05);
                    margin-bottom: 15px;
                }
                
                .category-title {
                    background-color: #f8f9fa;
                    padding: 12px 15px;
                    margin: 0;
                    font-size: 1rem;
                    font-weight: 600;
                    border-bottom: 1px solid #e9ecef;
                }
                
                .detail-items-container {
                    padding: 15px;
                }
                
                .detail-item {
                    display: flex;
                    justify-content: space-between;
                    padding: 8px 0;
                    border-bottom: 1px solid #f2f2f2;
                }
                
                .detail-item:last-child {
                    border-bottom: none;
                }
                
                .detail-label {
                    font-weight: 500;
                    color: #495057;
                }
                
                .detail-value {
                    text-align: right;
                    color: #212529;
                }
                
                /* Mejora en los tabs */
                .nav-tabs .nav-link {
                    color: #495057;
                    border: none;
                    border-bottom: 2px solid transparent;
                    padding: 0.75rem 1rem;
                    margin-right: 1rem;
                    font-weight: 500;
                }
                
                .nav-tabs .nav-link:hover {
                    border-color: #e9ecef #e9ecef #dee2e6;
                }
                
                .nav-tabs .nav-link.active {
                    font-weight: 600;
                    color: #ffffff;
                    background-color: #3383FF;
                    border-bottom: 2px solid #3383FF;
                    border-radius: 0.25rem 0.25rem 0 0;
                }
                            
                /* Estilos responsive */
                @media (max-width: 767px) {
                    .property-header .text-right {
                        text-align: left !important;
                        margin-top: 15px;
                    }
                    
                    .main-image-container {
                        padding-top: 70%; /* Proporción más compacta en móvil */
                    }
                    
                    .thumbnail-item {
                        width: 70px;
                        height: 70px;
                    }
                    
                    .detail-category {
                        flex: 1 1 100%;
                    }
                }
            </style>';
            
            // Devolver el HTML generado
            echo $html;
        } else {
            echo '<div class="alert alert-warning">No se encontraron datos para esta propiedad.</div>';
        }
        break;

}