<?php
$active1 = "active";
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
            </div>
            <div class="content-body">
                <!-- Dashboard Ecommerce Starts -->
                <section id="dashboard-ecommerce">
                    <div class="row">
                       
                        <div class="col-xl-12 col-12 dashboard-users">
                            <div class="row  ">
                                <!-- Statistics Cards Starts -->
                                <div class="col-12">
                                    <div class="row">
                                        <div class="col-sm-4 col-12 dashboard-users-success">
                                            <div class="card text-center">
                                                <div class="card-content">
                                                    <div class="card-body py-4">
                                                        <div class="badge-circle badge-circle-lg badge-circle-light-success mx-auto mb-50">
                                                            <i class="bx bx-note font-medium-5"></i>
                                                        </div>
                                                        <div class="text-muted line-ellipsis">Solicitudes activas</div>
                                                        <h3 class="mb-0" id='lblSolicitudesOn'></h3>
                                                    </div>
                                                </div>
                                            </div>
                                        </div> 
                                        
                                        <div class="col-sm-4 col-12 dashboard-users-success">
                                            <div class="card text-center">
                                                <div class="card-content">
                                                    <div class="card-body py-4">
                                                        <div class="badge-circle badge-circle-lg badge-circle-light-success mx-auto mb-50">
                                                            <i class="bx bx-briefcase-alt font-medium-5"></i>
                                                        </div>
                                                        <div class="text-muted line-ellipsis">Miembros registrados</div>
                                                        <h3 class="mb-0" id='lblTotalMiembros'></h3>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>    
                                        
                                        <div class="col-sm-4 col-12 dashboard-users-success">
                                            <div class="card text-center">
                                                <div class="card-content">
                                                    <div class="card-body py-4">
                                                        <div class="badge-circle badge-circle-lg badge-circle-light-success mx-auto mb-50">
                                                            <i class="bx bx-home font-medium-5"></i>
                                                        </div>
                                                        <div class="text-muted line-ellipsis">Total propiedades</div>
                                                        <h3 class="mb-0" id='lblTotalPropiedades'></h3>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>     
                                    </div>
                                </div>                                
                            </div>
                        </div>
                        
                    </div>

                     <div class="row">
                       
                        <div class="col-xl-12 col-12 dashboard-users">
                            <div class="row  ">
                                <!-- Statistics Cards Starts -->
                                <div class="col-12">
                                    <div class="row">
                                        <div class="col-sm-4 col-12 dashboard-users-success">
                                            <div class="card text-center">
                                                <div class="card-content">
                                                    <div class="card-body py-4">
                                                        <div class="badge-circle badge-circle-lg badge-circle-light-success mx-auto mb-50">
                                                            <i class="bx bx-building font-medium-5"></i>
                                                        </div>
                                                        <div class="text-muted line-ellipsis">Total independizaciones</div>
                                                        <h3 class="mb-0" id='lblTotalIndependizaciones'></h3>
                                                    </div>
                                                </div>
                                            </div>
                                        </div> 
                                        
                                         <div class="col-sm-4 col-12 dashboard-users-success"> 
                                            <div class="card text-center">
                                                <div class="card-content">
                                                    <div class="card-body py-4">
                                                        <div class="badge-circle badge-circle-lg badge-circle-light-success mx-auto mb-50">
                                                            <i class="bx bx-buildings font-medium-5"></i>
                                                        </div>
                                                        <div class="text-muted line-ellipsis">Total Proyectos</div>
                                                        <h3 class="mb-0" id='lblTotalProyectos'></h3>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>    
                                        
                                         <div class="col-sm-4 col-12 dashboard-users-success">
                                            <div class="card text-center">
                                                <div class="card-content">
                                                    <div class="card-body py-4">
                                                        <div class="badge-circle badge-circle-lg badge-circle-light-success mx-auto mb-50">
                                                            <i class="bx bx-building-house font-medium-5"></i>
                                                        </div> 
                                                        <div class="text-muted line-ellipsis">Proyectos mas cotizados</div>
                                                        <h3 class="mb-0" id='lblProyectoCotizado'></h3> 
                                                    </div>
                                                </div>
                                            </div>
                                        </div>     
                                    </div>
                                </div>                                
                            </div>
                        </div>
                        
                    </div>
              
              
                </section>
                <!-- Dashboard Ecommerce ends -->

            </div>
        </div>
    </div>

    <div class="sidenav-overlay"></div>
    <div class="drag-target"></div>

    <?php include "../MainJs/js.php"; ?>
    
    <script type="text/javascript" src="index.js"></script>
</body>
<!-- END: Body-->

</html>

<?php 
} else{
    header("Location:".Conectar::ruta());
}

?>