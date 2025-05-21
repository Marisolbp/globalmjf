<?php
$active9 = "active";
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
                            <h5 class="content-header-title float-left pr-1 mb-0">Tipos de propiedad</h5>
                            <div class="breadcrumb-wrapper col-12">
                                <ol class="breadcrumb p-0 mb-0">
                                    <li class="breadcrumb-item"><a href="../Home/"><i class="bx bx-home-alt"></i></a>
                                    </li>
                                    <li class="breadcrumb-item active">Tipos de propiedad
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
                        <button type="button" type="button" onclick="return nuevoTipoPropiedad()" class="btn mr-1 mb-1 btn-primary">Nuevo</button>
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
                                            <table id="data_tipo_propiedad" class="stripe row-border order-column">
                                                <thead>
                                                    <tr>
                                                        <th>Nombres</th>
                                                        <th>Estado</th>
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