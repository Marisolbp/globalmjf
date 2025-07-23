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
                        <h2 class="text-white ">Contacta un asesor</h2>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <div class="clearfix"></div>

    <!-- Form contact -->
    <section class="wrap__contact-form bg-light">
        <div class="container">
            <div class="row container-form">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group form-group-name">
                                <label>Documento <span class="required"></span></label>
                                <select class="form-control input-light" id="tip_doc" name="tip_doc" required="">
                                    <option value="DNI">DNI</option>
                                    <option value="Pasaporte">Pasaporte</option>
                                    <option value="RUC">RUC</option>
                                </select>

                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group form-group-name">
                                <label>N° Documento <span class="required"></span></label>
                                <input type="text" class="form-control input-light" id="dni" name="dni" required="">

                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group form-group-name">
                                <label>Nombre <span class="required"></span></label>
                                <input type="text" class="form-control input-light" id="nombre" name="nombre" required="">

                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group form-group-name">
                                <label>Apellido <span class="required"></span></label>
                                <input type="text" class="form-control input-light" id="apellido" name="apellido" required="">

                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group form-group-name">
                                <label>Email <span class="required"></span></label>
                                <input type="email" class="form-control input-light" id="email" name="email" required="">

                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group form-group-name">
                                <label>Teléfono <span class="required"></span></label>
                                <input type="text" class="form-control input-light" id="telefono" name="telefono" required="">

                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group form-group-name">
                                <label>¿Qué desea realizar? <span class="required"></span></label>
                                <select class="form-control input-light" id="modalidad" name="modalidad" required="">
                                    <option value="">Seleccione un opción</option>
                                    <option value="V">Vender</option>
                                    <option value="A">Alquilar</option>
                                </select>

                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group form-group-name">
                                <label>Tipo de propiedad <span class="required"></span></label>
                                <select class="form-control input-light" id="id_t_prop" name="id_t_prop" required="">
                                    
                                </select>

                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group form-group-name">
                                <label>Departamento <span class="required"></span></label>
                                <select class="form-control input-light" id="id_depart" name="id_depart" required="">
                                    
                                </select>

                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group form-group-name">
                                <label>Provincia <span class="required"></span></label>
                                <select class="form-control input-light" id="id_provin" name="id_provin" required="">
                                    
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group form-group-name">
                                <label>Distrito <span class="required"></span></label>
                                <select class="form-control input-light" id="id_distri" name="id_distri" required="">
                                    
                                </select>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Observaciones </label>
                                <textarea class="form-control input-light" rows="9" id="detalle" name="detalle"></textarea>
                            </div>

                        </div>

                        <div class="col-md-12 d-flex justify-content-center">
                            <button type="submit" class="btn btn-primary btn-contact px-25 py-3">Enviar datos</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- End Form contact  -->

    <?php include "footer.php";?>


    <!-- SCROLL TO TOP -->
    <a href="javascript:" id="return-to-top"><i class="fa fa-chevron-up"></i></a>
    <!-- END SCROLL TO TOP -->
    <script src="./js/index.bundle.js?8918068d71def746395d"></script>

    <script type="text/javascript" src="solicitud.js"></script>
</body>

</html>