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
                                                            <i class="bx bx-briefcase-alt font-medium-5"></i>
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
                                                            <i class="bx bx-briefcase-alt font-medium-5"></i>
                                                        </div>
                                                        <div class="text-muted line-ellipsis">Propiedades disponibles en venta</div>
                                                        <h3 class="mb-0" id='lblPropiedadesDisponibles'></h3>
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
                                                            <i class="bx bx-briefcase-alt font-medium-5"></i>
                                                        </div>
                                                        <div class="text-muted line-ellipsis">Distrito con mayor independizacion</div>
                                                        <h3 class="mb-0" id='lblDistritoMayor'></h3>
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
                                                        <div class="text-muted line-ellipsis">Proyectos en curso</div>
                                                        <h3 class="mb-0" id='lblProyectoCurso'></h3>
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