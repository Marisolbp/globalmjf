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
</head>

<body>
    <!-- HEADER -->
    <?php include "menu.php"?>

    <div class="bg-theme-overlay">
        <section class="section__breadcrumb ">
            <div class="container">
                <div class="row d-flex justify-content-center">
                    <div class="col-md-8 text-center">
                        <h2 class="text-white">Inmobiliaria</h2>
                    </div>
                </div>
            </div>
        </section>
    </div>
    
    <div class="clearfix"></div>

    <div class="search__area bg__shadow">
        <div class="container">
            <div class="search__area-inner">
                <div class="row">
                    <div class="col-6 col-lg-3 col-md-3">
                        <div class="form-group">
                            <label>Modalidad</label>
                            <select class="wide select_option">
                                <option data-display="Modalidad">Modalidad</option>
                                <option>For Sale</option>
                                <option>For Rent</option>

                            </select>
                        </div>
                    </div>
                    <div class="col-6 col-lg-3 col-md-3">
                        <div class="form-group">
                            <label>Tipo de propiedad</label>
                            <select class="wide select_option">
                                <option data-display="Tipo de propiedad">Tipo de propiedad</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-6 col-lg-3 col-md-3">
                        <div class="form-group">
                            <label>Ubicación</label>
                            <select class="wide select_option">
                                <option data-display="Locations">Ubicación</option>
                                <option>United Kingdom</option>
                                <option>American Samoa</option>
                                <option>Belgium</option>
                                <option>Canada</option>
                                <option>Delaware</option>
                                <option>Indonesia</option>
                                <option>Malaysia</option>
                                <option>Japan</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-6 col-lg-3 col-md-3">
                        <div class="form-group">
                            <label>Área</label>
                            <select class="wide select_option">
                                <option data-display="Área">Área</option>
                                <option>1500</option>
                                <option>1200</option>
                                <option>900</option>
                                <option>600</option>
                                <option>300</option>
                                <option>100</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-6 col-lg-3 col-md-3">
                        <div class="form-group">
                            <label>Habitaciones</label>
                            <select class="wide select_option">
                                <option data-display="Habitaciones">Habitaciones</option>
                                <option>1</option>
                                <option>2</option>
                                <option>3</option>
                                <option>4</option>
                                <option>5</option>
                                <option>6</option>
                                <option>7</option>
                                <option>8</option>
                                <option>9</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-6 col-lg-3 col-md-3">
                        <div class="form-group">
                            <label>Baños</label>
                            <select class="wide select_option">
                                <option data-display="Baños">Baños</option>
                                <option>1</option>
                                <option>2</option>
                                <option>3</option>
                                <option>4</option>


                            </select>
                        </div>
                    </div>
                    <div class="col-12 col-lg-3 col-md-3">
                        <div class="form-group">
                            <div class="filter__price">
                                <input class="price-range" type="text" name="my_range" value="" />
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-lg-3 col-md-3">
                        <label style="color:#fff;">Buscar</label>
                        <div class="form-group">
                            <button class="btn btn-primary text-uppercase btn-block"> Buscar <i
                                    class="fa fa-search ml-1"></i></button>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <section style="padding-top: 25px;">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="tabs__custom-v2 ">
                                <div class="tab-content" id="myTabContent">
                                
                                    <div class="tab-pane fade show active" id="pills-tab-two" role="tabpanel" aria-labelledby="pills-tab-two">
                                        <div class="row" id="listar_inmobiliaria">

                                        </div>
                                        <div class="cleafix"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>
    <!-- END LISTING LIST -->

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

    <a href="javascript:" id="return-to-top"><i class="fa fa-chevron-up"></i></a>

    <script src="./js/index.bundle.js?8918068d71def746395d"></script>

    <script src="inmobiliaria.js"></script>
</body>

</html>