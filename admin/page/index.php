<?php
require_once("config/conexion.php");
if (!empty($_SESSION["codusu"])) {
    header("Location:" . conectar::ruta() . "view/Home/");
}
?>
<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
<!-- BEGIN: Head-->

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <meta name="description" content="Frest admin is super flexible, powerful, clean &amp; modern responsive bootstrap 4 admin template with unlimited possibilities.">
    <meta name="keywords" content="admin template, Frest admin template, dashboard template, flat admin template, responsive admin template, web app">
    <meta name="author" content="PIXINVENT">
    <title>Login Page - Frest - Bootstrap HTML admin template</title>
    <link rel="apple-touch-icon" href="../assets/images/logo_ef_icon.png">
    <link rel="shortcut icon" type="image/x-icon" href="../assets/images/logo_ef_icon.png">
    <link href="https://fonts.googleapis.com/css?family=Rubik:300,400,500,600%7CIBM+Plex+Sans:300,400,500,600,700" rel="stylesheet">

    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="../app-assets/vendors/css/vendors.min.css">
    <!-- END: Vendor CSS-->

    <!-- BEGIN: Theme CSS-->
    <link rel="stylesheet" type="text/css" href="../app-assets/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="../app-assets/css/bootstrap-extended.css">
    <link rel="stylesheet" type="text/css" href="../app-assets/css/colors.css">
    <link rel="stylesheet" type="text/css" href="../app-assets/css/components.css">
    <link rel="stylesheet" type="text/css" href="../app-assets/css/themes/dark-layout.css">
    <link rel="stylesheet" type="text/css" href="../app-assets/css/themes/semi-dark-layout.css">
    <!-- END: Theme CSS-->

    <!-- BEGIN: Page CSS-->
    <link rel="stylesheet" type="text/css" href="../app-assets/css/core/menu/menu-types/vertical-menu.css">
    <link rel="stylesheet" type="text/css" href="../app-assets/css/pages/authentication.css">
    <!-- END: Page CSS-->

    <!-- BEGIN: Custom CSS-->
    <link rel="stylesheet" type="text/css" href="../assets/css/style.css">
    <!-- END: Custom CSS-->

    <link rel="stylesheet" type="text/css" href="../assets/css/alert.css">
</head>
<!-- END: Head-->

<!-- BEGIN: Body-->
<!-- dark-layout -->
<body class="vertical-layout vertical-menu-modern semi-dark-layout 1-column  navbar-sticky footer-static bg-full-screen-image  blank-page blank-page" data-open="click" data-menu="vertical-menu-modern" data-col="1-column" data-layout="semi-dark-layout">
<!-- BEGIN: Content-->
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="content-wrapper">
            <div class="content-header row">
            </div>
            <div class="content-body">
                <!-- login page start -->
                <section id="auth-login" class="row flexbox-container">
                    <div class="col-xl-4 col-md-5 col-11">
                        <div class="card bg-authentication mb-0" style="border-radius: 20px">
                            <div class="row m-0">
                                <!-- left section-login -->
                                <div class="col-md-12 col-xl-12 px-0">
                                    <div class="card disable-rounded-right mb-0 p-2 h-100 d-flex justify-content-center" style="border-radius: 20px">
                                        <div class="text-center mt-0">
                                            <img src="../archivos/LOGO GOLD.png" height="170">
                                        </div> 
                                        <div class="card-header pb-0">
                                            <div class="card-title" style="text-transform: none !important;">
                                                <h4 class="text-center mb-0">Acceso al sistema de administración</h4>
                                            </div>
                                        </div>
                                        
                                        <div class="card-content">
                                            <div class="card-body">
                                                <div class="divider">
                                                    <div class="divider-text text-muted">Ingresa tus credenciales</div>
                                                </div>
                                                <form method="post" id="formlogin">
                                                    <div class="form-group mb-50">
                                                        <label class="text-bold-600" for="usuario">Usuario</label>
                                                        <input type="text" class="form-control" id="usuario" name="usuario" placeholder="Usuario"></div>
                                                    <div class="form-group">
                                                        <label class="text-bold-600" for="clave">Contraseña</label>
                                                        <input type="password" class="form-control" id="clave" name="clave" placeholder="Contraseña">
                                                    </div>
                                                    <input type="submit" value="Ingresar" class="btn btn-primary glow w-100 position-relative">
                                        
                                                </form>
                                                <hr>
                                                <div class="text-center">
                                                    <small class="mr-25">
                                                        © 2025 MainCode
                                                    </small></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                </section>
                <!-- login page ends -->

            </div>
        </div>
    </div>
    <!-- END: Content-->


    <!-- BEGIN: Vendor JS-->
    <script src="../app-assets/vendors/js/vendors.min.js"></script>
    <script src="../app-assets/fonts/LivIconsEvo/js/LivIconsEvo.tools.js"></script>
    <script src="../app-assets/fonts/LivIconsEvo/js/LivIconsEvo.defaults.js"></script>
    <script src="../app-assets/fonts/LivIconsEvo/js/LivIconsEvo.min.js"></script>
    <!-- BEGIN Vendor JS-->

    <!-- BEGIN: Page Vendor JS-->
    <!-- END: Page Vendor JS-->

    <!-- BEGIN: Theme JS-->
    <script src="../app-assets/js/scripts/configs/vertical-menu-dark.js"></script>
    <script src="../app-assets/js/core/app-menu.js"></script>
    <script src="../app-assets/js/core/app.js"></script>
    <script src="../app-assets/js/scripts/components.js"></script>
    <script src="../app-assets/js/scripts/footer.js"></script>
    
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <!-- END: Theme JS-->

    <!-- BEGIN: Page JS-->
    <!-- END: Page JS-->

    <script src="index.js"></script>

</body>
<!-- END: Body-->

</html>