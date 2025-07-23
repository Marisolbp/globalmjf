<?php
$active7 = "active";
require_once("../../config/conexion.php");

if(isset($_SESSION["id"])){

    include "../MainHead/head.php";
    include "../MainHeader/header.php";
    include "../MainNav/nav.php";
?>

<!-- BEGIN: Content-->
<div class="app-content content">
        <div class="content-overlay"></div>
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-12 mb-2 mt-1">
                    <div class="row breadcrumbs-top">
                        <div class="col-12">
                            <h5 class="content-header-title float-left pr-1 mb-0">Configuración general</h5>
                            <div class="breadcrumb-wrapper col-12">
                                <ol class="breadcrumb p-0 mb-0">
                                    <li class="breadcrumb-item"><a href="../Home/"><i class="bx bx-home-alt"></i></a>
                                    </li>
                                    <li class="breadcrumb-item active">Configuración general
                                    </li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-body">

                <!-- Zero configuration table -->
                <section id="basic-datatable">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-content">
                                    <div class="card-body">
                                        <ul class="nav nav-tabs" role="tablist">
                                            <li class="nav-item">
                                                <a class="nav-link active" id="home-tab" data-toggle="tab" href="#general" aria-controls="home" role="tab" aria-selected="true">
                                                    <i class="bx bx-home align-middle"></i>
                                                    <span class="align-middle">General</span>
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" id="profile-tab" data-toggle="tab" href="#nosotros" aria-controls="profile" role="tab" aria-selected="false">
                                                    <i class="bx bx-user align-middle"></i>
                                                    <span class="align-middle">Nosotros</span>
                                                </a>
                                            </li>
                                        </ul>
                                        <div class="tab-content">
                                            <div class="tab-pane active" id="general" aria-labelledby="home-tab" role="tabpanel">
                                                <form method="post" id="general_form">
                                                    <div class="row">
                                                        <div class="col-md-1">
                                                            <label>Número</label>
                                                        </div>
                                                        <div class="col-md-5 form-group ">
                                                            <div class="position-relative has-icon-left">
                                                                <input type="text" id="numero" class="form-control" name="numero" placeholder="Número">
                                                                <div class="form-control-position">
                                                                    <i class="bx bx-phone"></i>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-1">
                                                            <label>Correo</label>
                                                        </div>
                                                        <div class="col-md-5 form-group ">
                                                            <div class="position-relative has-icon-left">
                                                                <input type="text" id="correo" class="form-control" name="correo" placeholder="Correo">
                                                                <div class="form-control-position">
                                                                    <i class="bx bx-envelope"></i>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-1">
                                                            <label>Facebook</label>
                                                        </div>
                                                        <div class="col-md-5 form-group ">
                                                            <div class="position-relative has-icon-left">
                                                                <input type="text" id="facebook" class="form-control" name="facebook" placeholder="Faceook">
                                                                <div class="form-control-position">
                                                                    <i class="bx bxl-facebook"></i>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-1">
                                                            <label>LinkedIn</label>
                                                        </div>
                                                        <div class="col-md-5 form-group ">
                                                            <div class="position-relative has-icon-left">
                                                                <input type="text" id="linkedin" class="form-control" name="linkedin" placeholder="LinkedIn">
                                                                <div class="form-control-position">
                                                                    <i class="bx bxl-linkedin"></i>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-1">
                                                            <label>Instagram</label>
                                                        </div>
                                                        <div class="col-md-5 form-group ">
                                                            <div class="position-relative has-icon-left">
                                                                <input type="text" id="instagram" class="form-control" name="instagram" placeholder="Instagram">
                                                                <div class="form-control-position">
                                                                    <i class="bx bxl-instagram"></i>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-1">
                                                            <label>Dirección</label>
                                                        </div>
                                                        <div class="col-md-5 form-group ">
                                                            <div class="position-relative has-icon-left">
                                                                <input type="text" id="direccion" class="form-control" name="direccion" placeholder="Dirección">
                                                                <div class="form-control-position">
                                                                    <i class="bx bx-map"></i>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!-- <div class="col-md-1">
                                                            <label>Longitud</label>
                                                        </div>
                                                        <div class="col-md-2 form-group ">
                                                            <div class="position-relative has-icon-left">
                                                                <input type="text" id="longitud" class="form-control" name="longitud" placeholder="Longitud">
                                                                <div class="form-control-position">
                                                                    <i class="bx bx-map"></i>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-1">
                                                            <label>Latitud</label>
                                                        </div>
                                                        <div class="col-md-2 form-group ">
                                                            <div class="position-relative has-icon-left">
                                                                <input type="text" id="latitud" class="form-control" name="latitud" placeholder="Latitud">
                                                                <div class="form-control-position">
                                                                    <i class="bx bx-map"></i>
                                                                </div>
                                                            </div>
                                                        </div> -->
                                                        <div class="col-12 d-flex justify-content-end">
                                                            <button type="button" onclick="return guardarInfoGeneral()" class="btn btn-primary">
                                                                <i class="bx bx-check d-block d-sm-none"></i>
                                                                <span class="d-none d-sm-block">Guardar</span>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                            <div class="tab-pane" id="nosotros" aria-labelledby="profile-tab" role="tabpanel">
                                                <form method="post" id="nosotros_form">
                                                    <div class="row">
                                                        <div class="col-md-1">
                                                            <label>¿Quiénes somos?</label>
                                                        </div>
                                                        <div class="col-md-11 form-group ">
                                                            <div id="snow-editor-qs" style="height: 150px;">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-1">
                                                            <label>Misión</label>
                                                        </div>
                                                        <div class="col-md-11 form-group ">
                                                            <div id="snow-editor-m" style="height: 150px;">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-1">
                                                            <label>Visión</label>
                                                        </div>
                                                        <div class="col-md-11 form-group ">
                                                            <div id="snow-editor-v" style="height: 150px;">
                                                            </div>
                                                        </div>
                                                        <div class="col-12 d-flex justify-content-end">
                                                            <button type="button" onclick="return guardarInfoNosotros()" class="btn btn-primary">
                                                                <i class="bx bx-check d-block d-sm-none"></i>
                                                                <span class="d-none d-sm-block">Guardar</span>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </form>
                                                <div class="table-responsive">
                                                    
                                                    <button type="button" type="button" onclick="return nuevoValor()" class="btn btn-primary">Nuevo</button>
                                                    
                                                    <table id="data_valor" class="stripe row-border order-column">
                                                        <thead>
                                                            <tr>
                                                                <th colspan="3" style="text-align:center;">Valores de la empresa</th>
                                                            </tr>
                                                            <tr>
                                                                <th>Valor</th>
                                                                <th>Descripción</th>
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