<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Rethouse - Real Estate HTML Template">
    <meta name="keywords" content="Real Estate, Property, Directory Listing, Marketing, Agency" />
    <meta name="author" content="mardianto - retenvi.com">
    <title>Rethouse - Real Estate HTML Template</title>

    <!-- Facebook and Twitter integration -->
    <meta property="og:title" content="" />
    <meta property="og:image" content="" />
    <meta property="og:url" content="" />
    <meta property="og:site_name" content="" />
    <meta property="og:description" content="" />
    <meta name="twitter:title" content="" />
    <meta name="twitter:image" content="" />
    <meta name="twitter:url" content="" />
    <meta name="twitter:card" content="" />

    <link rel="manifest" href="site.webmanifest">
    <!-- favicon.ico in the root directory -->
    <link rel="apple-touch-icon" href="icon.png">
    <meta name="theme-color" content="#3454d1">
    <link href="./css/styles.css?8918068d71def746395d" rel="stylesheet">

    <link rel="stylesheet" href="css/css/all.min.css">

    <style>
        .btn-filter a {
            text-decoration: none;
            color: inherit;
        }
    </style>
</head>

<body>
    
    <!-- HEADER -->
    <?php include "menu.php"?>

    <div class="slider-container" id="foto-slider">
        
    </div>

    <div class="clearfix"></div>
    <!-- END CAROUSEL -->
    <div class="clearfix"></div>
    
    <section>
        <div class="container">
            <div class="row">
                <div class="col-md-8 col-lg-6 mx-auto">
                    <div class="title__head">
                        <h2 class="text-center text-capitalize">
                            Inmobiliaria
                        </h2>
                        <p class="text-center">Propiedades exclusivas seleccionadas por nuestro equipo.</p>

                    </div>
                </div>
            </div>

            <div class="card__image-filter">
                <div class="filterizr-control">
                    <ul class="list-inline filterizr-filter" id="list_filter">
                    </ul>
                </div>
                <div class="row">
                    <div class="filtr-container" id="list_prop">

                    </div>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>
    </section>

    <section class="projects__partner bg-light">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8 col-lg-6">
                    <div class="title__head">
                        <h2 class="text-center text-capitalize">Certificación institucional</h2>
                        <p> Estamos registrados como agentes inmobiliarios ante el MVCS, somos 
                            miembros del Colegio de Arquitectos del Perú (CAP) - Regional Lima, 
                            y estamos habilitados por SUNARP como verificadores comunes.
                         </p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="projects__partner-logo">
                        <ul class="list-inline mb-0">
                            <li class="list-inline-item">
                                <img src="images/03-mvcs.png" alt="" class="img-fluid">
                            </li>
                            <li class="list-inline-item">
                                <img src="images/02-cap.png" alt="" class="img-fluid">
                            </li>
                            <li class="list-inline-item">
                                <img src="images/01-sunarp.png" alt="" class="img-fluid">
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- OUR TEAM -->
    <section class="our__team">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-7">
                    <div class="title__head">
                        <h2 class="text-center">Nuestro equipo de trabajo</h2>
                        <p class="text-center">Conoce más sobre su experiencia</p>
                    </div>
                </div>
            </div>
            <div class="row" id="nuestro-equipo">
                
            </div>
        </div>
    </section>
    <!-- END TEAM -->

    <!-- CALL TO ACTION -->
    <section class="cta-v1 py-5">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-9">
                    <h2 class="text-uppercase text-white">¿Desea vender o alquilar su propiedad?</h2>
                    <p class="text-white">Le ayudaremos con los mejores y más cómodos servicios inmobiliarios.
                    </p>

                </div>
                <div class="col-lg-3">
                    <a href="#" class="btn btn-light text-uppercase ">solicitar cotización</a>
                </div>
            </div>
        </div>
    </section>
    <!-- END CALL TO ACTION -->

    <?php include "footer.php";?>

    <!-- SCROLL TO TOP -->
    <a href="javascript:" id="return-to-top"><i class="fa fa-chevron-up"></i></a>
    <!-- END SCROLL TO TOP -->
    <script src="./js/index.bundle.js?8918068d71def746395d"></script>

    <script src="index.js"></script>
</body>

</html>