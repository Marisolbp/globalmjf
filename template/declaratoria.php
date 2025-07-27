<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Rethouse - Real Estate HTML Template">
    <meta name="keywords" content="Real Estate, Property, Directory Listing, Marketing, Agency" />
    <meta name="author" content="mardianto - retenvi.com">
    <title>Global MJF Arquitectos</title>

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
    <link rel="shortcut icon"  href="imagen/logo-gold.png">
    <meta name="theme-color" content="#3454d1">
    <link href="./css/styles.css?8918068d71def746395d" rel="stylesheet">

    <link rel="stylesheet" href="css/css/all.min.css">

    <!-- SweetAlert2 CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

    <!-- SweetAlert2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</head>

<body>

    <style>
       
        .declaratoria-list {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .declaratoria-item {
            display: flex;
            align-items: flex-start;
            padding: 10px 0;
            margin-left: 30px;
            border-bottom: 1px solid #f1f3f4;
            transition: all 0.2s ease;
        }
        
        .declaratoria-item:last-child {
            border-bottom: none;
        }
        
        .declaratoria-item:hover {
            background-color: #f8f9ff;
            margin: 0 -20px;
            padding: 10px 20px;
            border-radius: 8px;
        }

         .declaratoria-bullet {
            width: 8px;
            height: 8px;
            background-color: #2c5aa0;
            border-radius: 50%;
            margin-right: 15px;
            margin-top: 8px;
            flex-shrink: 0;
        }

        .declaratoria-text {
            font-size: 14px;
            color: #495057;
            line-height: 1.5;
            word-wrap: break-word;
            hyphens: auto;
        }

        .txt-description{
            text-align: justify
        }


        .home__about .about__image {
            position: relative;
            min-height: 400px
        }
        .home__about .about__image-top {
            position: absolute;
            width: 50%;
            left: 0;
            bottom: -47%;
            transform: translateY(-50%);
            z-index: 1;
            margin-bottom: 40px;
        }

        @media screen and (min-width: 320px) and (max-width: 575px) {
            .home__about .about__image-top {
                position: relative;
                width: 100%;
                bottom: 0;
                transform: translateY(0);
                border: 0;
                margin-bottom: 15px
            }
        }

        @media screen and (min-width: 576px) and (max-width: 768px) {
            .home__about .about__image-top {
                position: relative;
                width: 100%;
                bottom: 0;
                transform: translateY(0);
                border: 0
            }
        }

        .home__about .about__image-top-hover {
            background: #ffc31d;
            overflow: hidden;
            position: relative;
            display: inline-block;
            margin: 0 -1.5px
        }

        .home__about .about__image-top-hover img {
            width: 100%;
            transition: 0.5s ease all
        }

        .home__about .about__image-top-hover:hover img {
            opacity: 0.6;
            -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=60)";
            filter: alpha(opacity=60);
            transform: scale(1.1, 1.1)
        }

        .home__about .about__image-bottom {
            position: absolute;
            width: 88%;
            right: 0;
            
        }

        .home__about .about__image-bottom .image-bottom-2{
            margin-top: 120px
        }

        @media screen and (min-width: 320px) and (max-width: 575px) {
            .home__about .about__image-bottom {
                position: relative;
                width: 100%
            }
        }

        @media screen and (min-width: 576px) and (max-width: 768px) {
            .home__about .about__image-bottom {
                position: relative;
                width: 100%
            }
        }

        .home__about .about__image-bottom-hover { 
            background: #ffc31d;
            overflow: hidden;
            position: relative;
            display: inline-block;
            margin: 0 -1.5px
        }

        .home__about .about__image-bottom-hover img {
            width: 100%;
            height: 300px;
            object-fit: cover;
            transition: 0.5s ease all
        }

        .home__about .about__image-bottom-hover:hover img {
            opacity: 0.6;
            -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=60)";
            filter: alpha(opacity=60);
            transform: scale(1.1, 1.1)
        }

        .input-error {
            border: 2px solid #EF5350 !important;
        }

    </style>

    <!-- HEADER -->
    <?php include "menu.php"?> 

    <div class="bg-theme-overlay">
        <section class="section__breadcrumb ">
            <div class="container">
                <div class="row d-flex justify-content-center">
                    <div class="col-md-8 text-center">
                        <h2 class="text-white ">Declaratoria de fábrica</h2>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <div class="clearfix"></div>

    <section class="home__about bg-light">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="title__leading">
                        <h2>¿Qué es la declaratoria de fábrica?</h2>
                        <p class="txt-description" id="descrip_decla">
                            
                        </p>

                        <div><strong>¿Qué datos se registran?</strong></div><br>
                        <ul class="declaratoria-list">
                            <li class="declaratoria-item">
                                <div class="declaratoria-bullet"></div>
                                <div class="declaratoria-text">Área construida por piso</div>
                            </li>
                            <li class="declaratoria-item">
                                <div class="declaratoria-bullet"></div>
                                <div class="declaratoria-text">Antigüedad de la edificación</div>
                            </li>
                            <li class="declaratoria-item">
                                <div class="declaratoria-bullet"></div>
                                <div class="declaratoria-text">Materiales</div>
                            </li>
                            <li class="declaratoria-item">
                                <div class="declaratoria-bullet"></div>
                                <div class="declaratoria-text">Uso (vivienda, comercio, etc.)</div>
                            </li>
                            <li class="declaratoria-item">
                                <div class="declaratoria-bullet"></div>
                                <div class="declaratoria-text">Planos visados</div>
                            </li>
                            <li class="declaratoria-item">
                                <div class="declaratoria-bullet"></div>
                                <div class="declaratoria-text">Licencia de construcción (si es reciente)</div>
                            </li>
                        </ul>
                        
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="about__image">
                        <div class="about__image-top"> 
                            <div class="about__image-top-hover">
                                <img src="images/fabrica2.jpg" alt="" class="img-fluid">
                            </div>

                        </div>
                        <div class="about__image-bottom">
                            <div class="about__image-bottom-hover">
                                <img src="images/fabrica.jpg" alt="" class="img-fluid">
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
   
    <section class="home__about">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="title__leading">
                        <h2>¿Qué es la independización de una propiedad?</h2>
                        <p class="txt-description" id="descrip_indep">
                            
                        </p>
                        <p><strong>¿Qué se requiere?</strong></p>

                        <ul class="declaratoria-list">
                            <li class="declaratoria-item">
                                <div class="declaratoria-bullet"></div>
                                <div class="declaratoria-text">Declaratoria de fábrica (previamente hecha)</div>
                            </li>
                            <li class="declaratoria-item">
                                <div class="declaratoria-bullet"></div>
                                <div class="declaratoria-text">Minuta y escritura pública ante notario</div>
                            </li>
                            <li class="declaratoria-item">
                                <div class="declaratoria-bullet"></div>
                                <div class="declaratoria-text">Inscripción en SUNARP</div>
                            </li>
                        </ul>
                    <hr>

                        <p><strong>¿Cuándo necesitas hacer esto?</strong></p>
                   
                        <ul class="declaratoria-list">
                            <li class="declaratoria-item">
                                <div class="declaratoria-bullet"></div>
                                <div class="declaratoria-text">Para vender un departamento dentro de un edificio</div>
                            </li>
                            <li class="declaratoria-item">
                                <div class="declaratoria-bullet"></div>
                                <div class="declaratoria-text">Para alquilar o hipotecar una parte del inmueble</div>
                            </li>
                            <li class="declaratoria-item">
                                <div class="declaratoria-bullet"></div>
                                <div class="declaratoria-text">Para formalizar una edificación antigua</div>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="about__image">
                        <div class="about__image-top"> 
                            <div class="about__image-top-hover">
                                <img src="images/independizacion.jpg" alt="" class="img-fluid">
                            </div>

                        </div>
                        <div class="about__image-bottom">
                            <div class="about__image-bottom-hover image-bottom-2">
                                <img src="images/independizacion2.jpg" alt="" class="img-fluid">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Form contact -->
    <section class="wrap__contact-form bg-light">
        <div class="container">
            <div class="row container-form">
                <form method="post" id="declaratoria_form">
                    <div class="col-md-12">
                        <div class="row">
                            
                            <div class="col-md-6">
                                <div class="form-group form-group-name">
                                    <label>Nombre <span class="required"></span></label>
                                    <input type="text" class="form-control input-light" name="nombre" required="">

                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group form-group-name">
                                    <label>Correo <span class="required"></span></label>
                                    <input type="email" class="form-control input-light" name="correo" required="">

                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group form-group-name">
                                    <label>Asunto <span class="required"></span></label>
                                    <input type="text" class="form-control input-light" name="asunto" required="">
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Consulta </label>
                                    <textarea class="form-control input-light" rows="9" name="consulta" required=""></textarea>
                                </div>

                            </div>

                            <div class="col-md-12 d-flex justify-content-center">
                                <button type="button" onclick="return enviarFormulario()" class="btn btn-primary btn-contact px-25 py-3">Enviar datos</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>

    <div id="loader" style="display:none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; 
        background: rgba(255,255,255,0.7); z-index: 9999; display: flex; align-items: center; justify-content: center;">
        <div class="spinner-border text-primary" role="status">
        </div>
    </div>

    <?php include "footer.php";?>

    <!-- SCROLL TO TOP -->
    <a href="javascript:" id="return-to-top"><i class="fa fa-chevron-up"></i></a>
    <!-- END SCROLL TO TOP -->
    <script src="./js/index.bundle.js?8918068d71def746395d"></script>

    <script src="declaratoria.js"></script>
</body>

</html>