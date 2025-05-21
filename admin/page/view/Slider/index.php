<?php
$active8 = "active";
require_once("../../config/conexion.php");

if(isset($_SESSION["id"])){

    include "../MainHead/head.php";
    include "../MainHeader/header.php";
    include "../MainNav/nav.php";
?>

<style>
    .dz-custom-style {
        border: 2px dashed #ced4da; /* Color del borde */
        height: 280px;
        background-color: #ffffff; /* Fondo blanco */
        border-radius: 12px; /* Bordes redondeados */
        padding: 20px; /* Espaciado interno */
        text-align: center; /* Centrar contenido */
        box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.05); /* Sombra ligera */
        transition: background-color 0.3s ease, border-color 0.3s ease, box-shadow 0.3s ease;
    }

    /* Efecto hover en el dropzone */
    .dz-custom-style:hover {
        border-color: #007bff; /* Cambiar el borde a azul */
        box-shadow: 0px 6px 15px rgba(0, 123, 255, 0.1); /* Sombras más pronunciadas */
    }

    /* Estilo cuando arrastras un archivo sobre el área */
    .dz-custom-style.dz-drag-hover {
        background-color: #f0f8ff; /* Fondo suave azul claro */
        border-color: #17a2b8; /* Cambiar color del borde al arrastrar */
        box-shadow: 0px 6px 20px rgba(23, 162, 184, 0.15); /* Efecto de sombra más fuerte */
    }

    /* Estilo del icono de subida */
    .upload-icon {
        font-size: 48px;
        color: #007bff;
        margin-bottom: 10px;
        transition: color 0.3s ease;
    }

    /* Estilo del mensaje de subir archivos */
    .dz-message p {
        font-size: 15px;
        color: #6c757d;
        margin: 0;
        font-family: 'Helvetica Neue', sans-serif;
        font-weight: 500;
        transition: color 0.3s ease;
    }

    /* Cambiar el color del mensaje y el icono al arrastrar */
    .dz-custom-style.dz-drag-hover .upload-icon,
    .dz-custom-style.dz-drag-hover p {
        color: #17a2b8;
    }


    /* Estilo del enlace de eliminación */
    .dz-remove {
        display: block;
        font-size: 14px;
        color: #ff4d4f; /* Rojo elegante */
        margin-top: 5px;
        cursor: pointer;
        text-decoration: none;
        transition: color 0.3s ease;
    }

    /* Cambiar el color al pasar sobre el enlace de eliminar */
    .dz-remove:hover {
        color: #ff0000; /* Más visible al pasar sobre */
        text-decoration: underline;
    }

    /* Progreso de subida */
    .dz-progress {
        background-color: #007bff; /* Color del progreso de subida */
        height: 6px;
        border-radius: 4px;
        margin-top: 10px;
        transition: width 0.4s ease;
    }

</style>

<!-- BEGIN: Content-->
<div class="app-content content">
        <div class="content-overlay"></div>
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-12 mb-2 mt-1">
                    <div class="row breadcrumbs-top">
                        <div class="col-12">
                            <h5 class="content-header-title float-left pr-1 mb-0">Fotos slider</h5>
                            <div class="breadcrumb-wrapper col-12">
                                <ol class="breadcrumb p-0 mb-0">
                                    <li class="breadcrumb-item"><a href="../Home/"><i class="bx bx-home-alt"></i></a>
                                    </li>
                                    <li class="breadcrumb-item active">Fotos slider
                                    </li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-body">
                <div class="row">
                    <div class="col-12">
                        <button type="button" type="button" onclick="return nuevoSlider()" class="btn mr-1 mb-1 btn-primary">Nuevo</button>
                    </div>
                </div>
                <!-- Zero configuration table -->
                <section id="basic-datatable">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-content">
                                    <div class="card-body card-dashboard">
                                        <div class="table-responsive">
                                            <table id="data_slider" class="stripe row-border order-column">
                                                <thead>
                                                    <tr>
                                                        <th>Nombre</th>
                                                        <th>Foto</th>
                                                        <th>Orden</th>
                                                        <th>Acción</th>
                                                    </tr>
                                                </thead>
                                                <tbody>

                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!--/ Zero configuration table -->
            </div>
        </div>
    </div>
    <!-- END: Content-->

    <div class="sidenav-overlay"></div>
    <div class="drag-target"></div>


    <?php include "../MainJs/js.php"; ?>

    <?php include "modal.php"; ?>

    <script type="text/javascript" src="index.js"></script>
    
</body>
<!-- END: Body-->
    
</html>
    
<?php 
} else{
    header("Location:".Conectar::ruta());
}
    
?>