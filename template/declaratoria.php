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
</head>

<body>

    <style>
        ul {
            font-family: "Open Sans", sans-serif;
            font-weight: 500;
            color: #495057;
            line-height: 1.5;
            margin: auto;
        }
         .specialties-list {
            
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .specialty-item {
            display: flex;
            align-items: flex-start;
            padding: 10px 0;
            margin-left: 30px;
            border-bottom: 1px solid #f1f3f4;
            transition: all 0.2s ease;
        }
        
        .specialty-item:last-child {
            border-bottom: none;
        }
        
        .specialty-item:hover {
            background-color: #f8f9ff;
            margin: 0 -20px;
            padding: 10px 20px;
            border-radius: 8px;
        }

         .specialty-bullet {
            width: 8px;
            height: 8px;
            background-color: #2c5aa0;
            border-radius: 50%;
            margin-right: 15px;
            margin-top: 8px;
            flex-shrink: 0;
        }

        .specialty-text {
            font-size: 14px;
            color: #495057;
            line-height: 1.5;
            word-wrap: break-word;
            hyphens: auto;
        }

        .agent-container {
            background: white;
            border-radius: 15px;
            box-shadow: 0 8px 30px rgba(0,0,0,0.08);
            overflow: hidden;
            margin: 20px 0;
            display: flex;
            min-height: 400px;
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

    <section class="home__about">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="title__leading">
                        <h2>¿Qué es la declaratoria de fábrica?</h2>
                        <p style="text-align: justify;">Es el acto registral mediante el cual se inscribe una edificación construida sobre un terreno en los Registros Públicos. Sirve para dejar constancia oficial de que sobre ese terreno ya existe una construcción.<br>Ten en cuenta que el terreno puede estar inscrito, pero si no has hecho la declaratoria, legalmente no existe la construcción que has levantado.</p>

                        <div><strong>¿Qué datos se registran?</strong></div><br>
                        <ul class="specialties-list">
                            <li class="specialty-item">
                                <div class="specialty-bullet"></div>
                                <div class="specialty-text">Área construida por piso</div>
                            </li>
                            <li class="specialty-item">
                                <div class="specialty-bullet"></div>
                                <div class="specialty-text">Antigüedad de la edificación</div>
                            </li>
                            <li class="specialty-item">
                                <div class="specialty-bullet"></div>
                                <div class="specialty-text">Materiales</div>
                            </li>
                            <li class="specialty-item">
                                <div class="specialty-bullet"></div>
                                <div class="specialty-text">Uso (vivienda, comercio, etc.)</div>
                            </li>
                            <li class="specialty-item">
                                <div class="specialty-bullet"></div>
                                <div class="specialty-text">Planos visados</div>
                            </li>
                            <li class="specialty-item">
                                <div class="specialty-bullet"></div>
                                <div class="specialty-text">Licencia de construcción (si es reciente)</div>
                            </li>
                        </ul>
                        
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="about__image">
                        <div class="about__image-bottom">
                           <div class="">
                                <img src="images/fabrica.jpg" alt="" class="img-fluid">
                                <img src="images/fabrica.jpg" alt="" class="img-fluid">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="home__about bg-light">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="title__leading">
                        <h2>¿Qué es la independización de una propiedad?</h2>
                        <p>
                            La independización es el proceso mediante el cual una edificación (por ejemplo, un edificio de varios
                            departamentos) se divide legalmente en unidades inmobiliarias independientes, cada una con su propia 
                            partida registral.
                        </p>
                        <p>
                            Se separan los espacios construidos (como departamentos, tiendas o estacionamientos) para que cada uno 
                            pueda venderse, alquilarse o hipotecarse por separado.
                        </p>
                        <p><strong>¿Qué se requiere?</strong></p>
                        <ul>
                            <li>Declaratoria de fábrica (previamente hecha)</li>
                            <li>Minuta y escritura pública ante notario</li>
                            <li>Inscripción en SUNARP</li>
                        </ul>
                        <p><strong>¿Cuándo necesitas hacer esto?</strong></p>
                        <ul>
                            <li>Para vender un departamento dentro de un edificio</li>
                            <li>Para alquilar o hipotecar una parte del inmueble</li>
                            <li>Para formalizar una edificación antigua</li>
                        </ul>                        
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="about__image">
                        <div class="about__image-bottom">
                           <div class="about__image-top-hover">
                                <img src="images/independizacion.jpg" alt="" class="img-fluid">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer  -->
    <footer>
        <div class="wrapper__footer bg-theme-footer">
            <div class="container">
                <div class="row">
                    <!-- ADDRESS -->
                    <div class="col-md-4">
                        <div class="widget__footer">
                            <figure>
                                <img src="images/logo-blue.png" alt="" class="logo-footer">
                            </figure>
                            <p>
                                Rethouse Real Estate is a premium Property template based on Bootstrap 4. Rethouse Real
                                Estate helped thousands of clients to find the right property for their needs.

                            </p>

                            <ul class="list-unstyled mb-0 mt-3">
                                <li> <b> <i class="fa fa-map-marker"></i></b><span>214 West Arnold St. New York, NY
                                        10002</span> </li>
                                <li> <b><i class="fa fa-phone-square"></i></b><span>(123) 345-6789</span> </li>
                                <li> <b><i class="fa fa-phone-square"></i></b><span>(+100) 123 456 7890</span> </li>
                                <li> <b><i class="fa fa-headphones"></i></b><span>support@realvilla.demo</span> </li>
                                <li> <b><i class="fa fa-clock-o"></i></b><span>Mon - Sun / 9:00AM - 8:00PM</span> </li>
                            </ul>
                        </div>

                    </div>
                    <!-- END ADDRESS -->

                    <!-- QUICK LINKS -->
                    <div class="col-md-4">
                        <div class="widget__footer">
                            <h4 class="footer-title">Quick Links</h4>
                            <div class="link__category-two-column">
                                <ul class="list-unstyled ">
                                    <li class="list-inline-item">
                                        <a href="#">Commercial</a>
                                    </li>
                                    <li class="list-inline-item">
                                        <a href="#">business</a>
                                    </li>
                                    <li class="list-inline-item">
                                        <a href="#">House</a>
                                    </li>
                                    <li class="list-inline-item">
                                        <a href="#">Residential</a>
                                    </li>

                                    <li class="list-inline-item">
                                        <a href="#">Residential Tower</a>
                                    </li>
                                    <li class="list-inline-item">
                                        <a href="#">Beverly Hills</a>
                                    </li>
                                    <li class="list-inline-item">
                                        <a href="#">Los angeles</a>
                                    </li>
                                    <li class="list-inline-item">
                                        <a href="#">The beach</a>
                                    </li>
                                    <li class="list-inline-item">
                                        <a href="#">Property Listing</a>
                                    </li>

                                    <li class="list-inline-item">
                                        <a href="#">Clasic</a>
                                    </li>
                                    <li class="list-inline-item">
                                        <a href="#">Modern Home</a>
                                    </li>

                                    <li class="list-inline-item">
                                        <a href="#">Luxury</a>
                                    </li>
                                    <li class="list-inline-item">
                                        <a href="#">Beach Pasadena</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <!-- END QUICK LINKS -->


                    <!-- NEWSLETTERS -->
                    <div class="col-md-4">
                        <div class="widget__footer">
                            <h4 class="footer-title">follow us </h4>
                            <p class="mb-2">
                                Follow us and stay in touch to get the latest news
                            </p>
                            <p>
                                <button class="btn btn-social btn-social-o facebook mr-1">
                                    <i class="fa fa-facebook-f"></i>
                                </button>
                                <button class="btn btn-social btn-social-o twitter mr-1">
                                    <i class="fa fa-twitter"></i>
                                </button>

                                <button class="btn btn-social btn-social-o linkedin mr-1">
                                    <i class="fa fa-linkedin"></i>
                                </button>
                                <button class="btn btn-social btn-social-o instagram mr-1">
                                    <i class="fa fa-instagram"></i>
                                </button>

                                <button class="btn btn-social btn-social-o youtube mr-1">
                                    <i class="fa fa-youtube"></i>
                                </button>
                            </p>
                            <br>
                            <h4 class="footer-title">newsletter</h4>
                            <!-- Form Newsletter -->
                            <div class="widget__form-newsletter ">
                                <p>

                                    Donâ€™t miss to subscribe to our news feeds, kindly fill the form below
                                </p>
                                <div class="mt-3">
                                    <input type="text" class="form-control mb-2" placeholder="Your email address">

                                    <button class="btn btn-primary btn-block text-capitalize" type="button">subscribe

                                    </button>
                                </div>
                            </div>

                        </div>
                    </div>
                    <!-- END NEWSLETTER -->
                </div>
            </div>
        </div>

        <!-- Footer Bottom -->
        <div class="bg__footer-bottom-v1">
            <div class="container">
                <div class="row flex-column-reverse flex-md-row">
                    <div class="col-md-6">
                        <span>
                            Â© 2020 Rethouse Real Estate - Premium real estate & theme &amp; theme by
                            <a href="#">retenvi.com</a>
                        </span>
                    </div>
                    <div class="col-md-6">
                        <ul class="list-inline ">
                            <li class="list-inline-item">
                                <a href="#">
                                    privacy
                                </a>
                            </li>
                            <li class="list-inline-item">
                                <a href="#">
                                    contact
                                </a>
                            </li>
                            <li class="list-inline-item">
                                <a href="#">
                                    about
                                </a>
                            </li>
                            <li class="list-inline-item">
                                <a href="#">
                                    faq
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Footer  -->
    </footer>

    <!-- SCROLL TO TOP -->
    <a href="javascript:" id="return-to-top"><i class="fa fa-chevron-up"></i></a>
    <!-- END SCROLL TO TOP -->
    <script src="./js/index.bundle.js?8918068d71def746395d"></script>
</body>

</html>