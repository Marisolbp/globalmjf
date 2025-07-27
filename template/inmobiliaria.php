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
        @media (max-width: 768px) {
            .lbl_boton {
                display: none;
            }
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
                <form id="filtro_form">
                    <div class="row">
                        <div class="col-6 col-lg-3 col-md-3">
                            <div class="form-group">
                                <label>Tipo de propiedad</label>
                                <select class="wide form-control" id="id_t_prop" name="id_t_prop">

                                </select>
                            </div>
                        </div>
                        <div class="col-6 col-lg-3 col-md-2">
                            <div class="form-group">
                                <label>Modalidad</label>
                                <select class="wide form-control" id="modalidad" name="modalidad">
                                    <option value="" data-display="Modalidad">Modalidad</option>
                                    <option value="V">Venta</option>
                                    <option value="A">Alquiler</option>

                                </select>
                            </div>
                        </div>
                        <div class="col-6 col-lg-6 col-md-4">
                            <div class="form-group">
                                <label>Ubicación</label>
                                <select class="wide form-control" id="id_distri" name="id_distri">

                                </select>
                            </div>
                        </div>
                        <div class="col-6 col-lg-3 col-md-3">
                            <div class="form-group">
                                <label>Área</label>
                                <select class="wide form-control" id="atotal" name="atotal">
                                    <option value='' data-display="Área">Área</option>
                                    <option value="0-200">Hasta 200 m²</option>
                                    <option value="201-400">201 - 400 m²</option>
                                    <option value="401-600">401 - 600 m²</option>
                                    <option value="601-800">601 - 800 m²</option>
                                    <option value="801-">Más de 801 m²</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-6 col-lg-2 col-md-2">
                            <div class="form-group">
                                <label>Pisos</label>
                                <select class="wide form-control" id="npisos" name="npisos">
                                    
                                </select>
                            </div>
                        </div>
                        <div class="col-6 col-lg-2 col-md-2">
                            <div class="form-group">
                                <label>Dormitorios</label>
                                <select class="wide form-control" id="ndormit" name="ndormit">

                                </select>
                            </div>
                        </div>
                        <div class="col-12 col-lg-3 col-md-3">
                            <div class="form-group">
                                <label>Precio</label>
                                <div class="filter__price">
                                    <input class="form-control" type="text" id="price_range" name="my_range" value="" />
                                    
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-lg-2 col-md-2">
                            <div class="form-group">
                                <label style="color: #FFF" class="lbl_boton">Botón</label>
                                <button type="button" id="limpiar_filtros" class="btn btn-secondary form-control">Limpiar</button>
                            </div>
                        </div>
                    </div>
                </form>
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

                                        <div id="paginacion_inmobiliaria"></div>
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
                    <a href="solicitud.php" class="btn btn-light text-uppercase ">solicitar cotización</a>
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