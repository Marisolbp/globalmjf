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

    <style>
        .image-slider {
            max-width: 100%;
            margin: 0 auto;
        }

        .main-image-container {
            position: relative;
            width: 100%;
            height: 640px;
            overflow: hidden;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
            margin-bottom: 5px;
        }

        .main-image {
            width: 100%;
            height: 100%;
            transition: opacity 0.3s ease;
        }

        .nav-arrow {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            background: rgba(0,0,0,0.5);
            color: white;
            border: none;
            width: 50px;
            height: 50px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.3s ease;
            z-index: 10;
        }

        .nav-arrow:hover {
            background: rgba(0,0,0,0.8);
            transform: translateY(-50%) scale(1.1);
        }

        .nav-arrow.prev {
            left: 15px;
        }

        .nav-arrow.next {
            right: 15px;
        }

        .property-info {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            background: linear-gradient(transparent, rgba(0,0,0,0.8));
            color: white;
            padding: 30px 20px 20px;
            border-radius: 0 0 10px 10px;
        }

        .property-badge {
            background: #094152;
            color: white;
            padding: .25em .4em;
            font-size: 75%;
            font-weight: bold;
            display: inline-block;
            margin-bottom: 10px;
        }

        .property-price {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 5px;
        }

        .property-title {
            font-size: 18px;
            margin-bottom: 0;
        }

        .thumbnails-container {
            position: relative;
            overflow: hidden;
        }

        .thumbnails-wrapper {
            display: flex;
            gap: 10px;
            overflow-x: auto;
            scroll-behavior: smooth;
            padding: 10px 0;
            scrollbar-width: none;
            -ms-overflow-style: none;
        }

        .thumbnails-wrapper::-webkit-scrollbar {
            display: none;
        }

        .thumbnail {
            flex: 0 0 120px;
            height: 80px;
            border-radius: 8px;
            overflow: hidden;
            cursor: pointer;
            transition: all 0.3s ease;
            border: 3px solid transparent;
            position: relative;
        }

        .thumbnail:hover {
            transform: scale(1.05);
            border-color: #094152;
        }

        .thumbnail.active {
            border-color: #094152;
            box-shadow: 0 0 10px rgba(0,123,255,0.5);
        }

        .thumbnail img {
            width: 100%;
            height: 100%;
        }

        .thumbnail-overlay {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0,0,0,0.3);
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .thumbnail:hover .thumbnail-overlay {
            opacity: 1;
        }

        .thumbnail.active .thumbnail-overlay {
            opacity: 0;
        }

        .scroll-button {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            background: rgba(0,0,0,0.5);
            color: white;
            border: none;
            width: 35px;
            height: 35px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.3s ease;
            z-index: 10;
        }

        .scroll-button:hover {
            background: rgba(0,0,0,0.8);
        }

        .scroll-button.left {
            left: 0;
        }

        .scroll-button.right {
            right: 0;
        }

        .image-counter {
            position: absolute;
            top: 15px;
            right: 15px;
            background: rgba(0,0,0,0.7);
            color: white;
            padding: 5px 10px;
            border-radius: 15px;
            font-size: 12px;
            font-weight: bold;
        }

        @media (max-width: 768px) {
            .main-image-container {
                height: 300px;
            }
            
            .nav-arrow {
                width: 40px;
                height: 40px;
            }
            
            .property-info {
                padding: 20px 15px 15px;
            }
            
            .property-price {
                font-size: 20px;
            }
            
            .property-title {
                font-size: 16px;
            }
            
            .thumbnail {
                flex: 0 0 100px;
                height: 70px;
            }
        }

        .carousel-container {
            position: relative;
            overflow: hidden;
            width: 100%;
        }

        .carrusel-wrapper {
            display: flex;
            gap: 20px; /* Espacio entre tarjetas */
            transition: transform 0.5s ease;
            padding: 0px 10px; /* Un poco de espacio interno opcional */
        }
        .carrusel-wrapper > div {
            width: calc(100% / 3);
            flex-shrink: 0;
        }
        .input-error {
            border: 2px solid #EF5350 !important;
        }
    </style>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</head>

<body>

    <!-- HEADER -->
    <?php include "menu.php"?>

    <div class="bg-theme-overlay">
        <section class="section__breadcrumb ">
            <div class="container">
                <div class="row d-flex justify-content-center">
                    <div class="col-md-8 text-center">
                        <h2 class="text-white">Detalle de proyecto</h2>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <div class="clearfix"></div>

    <section class="single__Detail">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <!-- TITLE PROPERTY AND PRICE  -->
                    <div class="single__detail-area pt-0 pb-4">
                        <div class="row">
                            <div class="col-md-12 col-lg-12">
                                <div class="single__detail-area-title">
                                    <h3 class="text-capitalize" id="title_proyect"></h3>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- END TITLE PROPERTY AND PRICE  -->
                    
                    <div class="image-slider">
                        <!-- Imagen Principal -->
                        <div class="main-image-container">
                            <img id="mainImage" src="" alt="Imagen principal" class="main-image">
                            
                            <!-- Contador de imágenes -->
                            <div class="image-counter">
                                <span id="currentImageNumber"></span> / <span id="totalImages"></span>
                            </div>
                            
                            <!-- Flechas de navegación -->
                            <button class="nav-arrow prev" onclick="changeImage(-1)">
                                <i class="fas fa-chevron-left"></i>
                            </button>
                            <button class="nav-arrow next" onclick="changeImage(1)">
                                <i class="fas fa-chevron-right"></i>
                            </button>
                            
                            <!-- Información de la propiedad -->
                            <div class="property-info">
                                <div id="t_propiedad" class="property-badge"></div>
                                <div id="proyect_name" class="property-price"></div>
                            </div>
                        </div>
                        
                        <!-- Miniaturas -->
                        <div class="thumbnails-container">
                            <button class="scroll-button left" onclick="scrollThumbnails(-1)">
                                <i class="fas fa-chevron-left"></i>
                            </button>
                            <button class="scroll-button right" onclick="scrollThumbnails(1)">
                                <i class="fas fa-chevron-right"></i>
                            </button>
                            
                            <div class="thumbnails-wrapper" id="thumbnailsWrapper"></div>
                        </div>
                    </div>

                </div>

                <div class="col-lg-4 pt-5">
                    <div class="sticky-top">
                        <form method="post" id="proyecto_form">
                            <div class="profile__agent mb-30">
                                <div class="profile__agent__group">
                                    <div class="profile__agent__body">
                                        <h3 class="text-center">Contacto</h3>
                                        <input type="hidden" id="id_proyecto" name="id_proyecto">
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="nombre" required="" placeholder="Nombres">
                                        </div>
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="telefono" required="" placeholder="N° Teléfono">
                                        </div>
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="correo" required="" placeholder="Correo" >
                                        </div>
                                        <div class="form-group mb-0">
                                            <textarea class="form-control required" name="mensaje" rows="5" required=""
                                                placeholder="Mensaje">¡Hola! Quiero que se comuniquen conmigo por este proyecto que vi en Global MJF.
                                            </textarea>
                                        </div>
                                    </div>
                                    <div class="profile__agent__footer">
                                        <div class="form-group mb-0">
                                            <button type="button" onclick="return enviarFormulario()" class="btn btn-primary text-capitalize btn-block"> 
                                                Enviar 
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form> 
                    </div>
                </div>

                <div class="col-lg-8">
                    <!-- DESCRIPTION -->
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="single__detail-desc">
                                <h6 class="text-capitalize detail-heading">Descripción</h6>
                                <div class="show__more visible">
                                    <p id="descrip"></p>
                                </div>
                            </div>
                            <div class="clearfix"></div>

                            <!-- PROPERTY DETAILS SPEC -->
                            <div class="single__detail-features">
                                <h6 class="text-capitalize detail-heading">Detalles</h6>
                                <!-- INFO PROPERTY DETAIL -->
                                <div class="property__detail-info">
                                    <div class="row">
                                        <div class="col-md-6 col-lg-6">
                                            <ul class="property__detail-info-list list-unstyled">
                                                <li><b>Área total:</b> <span class="area-value">Cargando...</span></li>
                                                <li><b>Dormitorios:</b> <span class="dormitorios-value">Cargando...</span></li>
                                                <li><b>Baños:</b> <span class="banos-value">Cargando...</span></li>
                                            </ul>
                                        </div>
                                        <div class="col-md-6 col-lg-6">
                                            <ul class="property__detail-info-list list-unstyled">
                                                <li><b>Área construida:</b> <span class="aconstru-value">Cargando...</span></li>
                                                <li><b>Pisos:</b> <span class="pisos-value">Cargando...</span></li>
                                            </ul>
                                        </div>
                                    </div>

                                </div>
                                <!-- END INFO PROPERTY DETAIL -->
                            </div>
                            <!-- END PROPERTY DETAILS SPEC -->
                            <div class="clearfix"></div>

                        </div>
                    </div>
                    <!-- END DESCRIPTION -->
                </div>
            </div>

                
            <div class="row">
                <div class="col-lg-12">
                    <div class="similiar__item">
                        <h6 class="text-capitalize detail-heading">
                            Proyectos relacionados
                        </h6>

                        <div id="carousel_proyectos" class="carousel-container"></div>

                    </div>
                </div>
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

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    
    <script src="./js/index.bundle.js?8918068d71def746395d"></script>
    <script src="./js/app.js"></script>
    
    <script src="proyecto-detalle.js"></script>
    
</body>

</html>