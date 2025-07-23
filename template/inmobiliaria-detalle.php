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
        
    </style>

</head>

<body>
    <!-- HEADER -->
    <?php include "menu.php"?>

    <div class="bg-theme-overlay">
        <section class="section__breadcrumb ">
            <div class="container">
                <div class="row d-flex justify-content-center">
                    <div class="col-md-8 text-center">
                        <h2 class="text-white">Detalle de inmobiliaria</h2>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <div class="clearfix"></div>

    <!-- SINGLE DETAIL -->
    <section class="single__Detail">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <!-- TITLE PROPERTY AND PRICE  -->
                    <div class="single__detail-area pt-0 pb-4">
                        <div class="row">
                            <div class="col-md-8 col-lg-8">
                                <div class="single__detail-area-title">
                                    <h3 class="text-capitalize" id="title_proyect"></h3>
                                    <p id="direction"></p>
                                </div>
                            </div>
                            <div class="col-md-4 col-lg-4">
                                <div class="single__detail-area-price">
                                    <h3 class="text-capitalize text-gray" id="price"></h3>
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
                                <div id="inmobiliaria_name" class="property-price"></div>
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
                        <!-- PROFILE AGENT -->
                        <div class="profile__agent mb-30">
                            <div class="profile__agent__group">
                                <div class="profile__agent__body">
                                    <h3 class="text-center">Contacto</h3>
                                    <div class="form-group">
                                        <input type="text" class="form-control" placeholder="Nombres">
                                    </div>
                                    <div class="form-group">
                                        <input type="text" class="form-control" placeholder="N° Teléfono">
                                    </div>
                                    <div class="form-group">
                                        <input type="text" class="form-control" placeholder="Correo">
                                    </div>
                                    <div class="form-group mb-0">
                                        <textarea class="form-control required" rows="5" required="required"
                                            placeholder="Mensaje"></textarea>
                                    </div>
                                </div>
                                <div class="profile__agent__footer">
                                    <div class="form-group mb-0">
                                        <button class="btn btn-primary text-capitalize btn-block"> 
                                            Enviar 
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
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
                                                
                                            </ul>
                                        </div>
                                        <div class="col-md-6 col-lg-6">
                                            <ul class="property__detail-info-list list-unstyled">
                                                
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <!-- END INFO PROPERTY DETAIL -->
                            </div>
                            <!-- END PROPERTY DETAILS SPEC -->
                            <div class="clearfix"></div>

                            <!-- LOCATION -->
                            <div class="single__detail-features">
                                <h6 class="text-capitalize detail-heading">Ubicación</h6>
                                <!-- FILTER VERTICAL -->
                                <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" id="pills-map-location-tab" data-toggle="pill"
                                            href="#pills-map-location" role="tab" aria-controls="pills-map-location"
                                            aria-selected="true">
                                            <i class="fa fa-map-marker"></i>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="pills-street-view-tab" data-toggle="pill"
                                            href="#pills-street-view" role="tab" aria-controls="pills-street-view"
                                            aria-selected="false">
                                            <i class="fa fa-street-view "></i></a>
                                    </li>


                                </ul>
                                <div class="tab-content" id="pills-tabContent">
                                    <div class="tab-pane fade show active" id="pills-map-location" role="tabpanel"
                                        aria-labelledby="pills-map-location-tab">
                                        <div id="map-canvas">
                                            <iframe id="iframe-map" class="h600 w100"
                                                style="border:0;" allowfullscreen="" aria-hidden="false"
                                                tabindex="0">
                                            </iframe>
                                        </div>

                                    </div>
                                    <div class="tab-pane fade" id="pills-street-view" role="tabpanel"
                                        aria-labelledby="pills-street-view-tab">
                                        <iframe id="iframe-street-view" class="h600 w100"
                                        style="border:0;" allowfullscreen></iframe>
                                    </div>
                                </div>
                                <!-- END FILTER VERTICAL -->
                            </div>
                            <!-- END LOCATION -->

                        </div>
                    </div>
                    <!-- END DESCRIPTION -->
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <div class="similiar__item">
                        <h6 class="text-capitalize detail-heading">
                            Propiedades relacionadas
                        </h6>

                        <div id="carousel_propiedad" class="carousel-container"></div>

                    </div>
                </div>
            </div>

        </div>
    </section>
    <!-- END SINGLE DETAIL -->

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

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    
    <script src="./js/index.bundle.js?8918068d71def746395d"></script>
    <script src="./js/app.js"></script>
    
    <script src="inmobiliaria-detalle.js"></script>
    
</body>

</html>