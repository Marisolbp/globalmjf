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
                        <h2 class="text-white">Proyectos de arquitectura</h2>
                    </div>
                </div>
            </div>
        </section>
    </div>
    
    <div class="clearfix"></div>

    <!-- END BREADCRUMB -->
    <div class="search__area bg__shadow">
        <div class="container">
            <div class="search__area-inner">
                <div class="row">
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
                </div>

            </div>
        </div>
    </div>

    <!-- LISTING LIST -->
    <section style="padding-top: 25px;">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="tabs__custom-v2 ">
                                <div class="tab-content" id="myTabContent">
                                
                                    <div class="tab-pane fade show active" id="pills-tab-two" role="tabpanel" aria-labelledby="pills-tab-two">
                                        <div class="row" id="listar_proyecto">
                                            
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

    <?php include "footer.php";?>
    
    <a href="javascript:" id="return-to-top"><i class="fa fa-chevron-up"></i></a>

    <script src="./js/index.bundle.js?8918068d71def746395d"></script>

    <script src="proyectos.js"></script>
</body>

</html>