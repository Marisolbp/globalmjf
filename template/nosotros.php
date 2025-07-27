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
        body {
            background-color: #f8f9fa;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
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
        
        .agent-card {
            background: white;
            padding: 30px;
            border-right: 1px solid #e8ecef;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            min-height: 100%;
        }
        
        .agent-photo {
            width: 100%;
            max-width: 280px;
            height: 280px;  
            object-position: center top;
            border-radius: 12px;
            box-shadow: 0 8px 25px rgba(0,0,0,0.1);
            transition: transform 0.3s ease;
        }
        
        .agent-photo:hover {
            transform: translateY(-5px);
        }
        
        .listing-badge {
            position: absolute;
            top: 15px;
            left: 15px;
            background: #2c5aa0;
            color: white;
            padding: 8px 16px;
            border-radius: 6px;
            font-weight: 600;
            font-size: 12px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            z-index: 2;
        }
        
        .photo-container {
            position: relative;
            display: inline-block;
            width: 100%;
            margin-bottom: 20px;
        }
        
        .agent-info {
            flex-grow: 1;
            display: flex;
            flex-direction: column;
        }
        
        .agent-name {
            font-size: 1.4rem;
            font-weight: 700;
            color: #2c3e50;
            margin-bottom: 8px;
            line-height: 1.3;
            text-align: center;
            word-wrap: break-word;
            hyphens: auto;
        }
        
        .agent-title {
            color: #6c757d;
            font-size: 0.95rem;
            margin-bottom: 25px;
            line-height: 1.4;
            text-align: center;
            flex-grow: 1;
            word-wrap: break-word;
            hyphens: auto;
        }

        /* ESTILOS PARA INFORMACIÓN DE CONTACTO */
        .contact-list {
            list-style: none;
            padding: 0;
            margin: 0 0 25px 0;
            background: #f8f9ff;
            border-radius: 10px;
            border: 1px solid #e3e7f3;
        }

        .contact-item {
            display: flex;
            align-items: center;
            padding: 12px;
        }

        .contact-item:not(:last-child) {
            border-bottom: 1px solid #e8ecf0;
        }

        .contact-icon {
            width: 24px;
            height: 24px;
            background: #2c5aa0;
            border-radius: 6px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 11px;
            margin-right: 12px;
            flex-shrink: 0;
            transition: all 0.3s ease;
        }

        .contact-item:hover .contact-icon {
            background: #1e3f73;
            transform: scale(1.1);
        }

        .contact-text {
            font-size: 14px;
            color: #2c3e50;
            line-height: 1.4;
            font-weight: 500;
        }

        .contact-text a {
            color: #2c3e50;
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .contact-text a:hover {
            color: #2c5aa0;
        }
        
        .social-buttons {
            margin-top: auto;
            padding-top: 25px;
            border-top: 1px solid #e9ecef;
            text-align: center;
        }
        
        .social-btn {
            width: 45px;
            height: 45px;
            border-radius: 10px;
            border: none;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            margin-right: 8px;
            font-size: 18px;
            color: white;
            transition: all 0.3s ease;
            text-decoration: none;
        }
        
        .social-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 6px 20px rgba(0,0,0,0.15);
            text-decoration: none;
            color: white;
        }
        
        .social-btn.linkedin { background-color: #0077b5; }
        .social-btn.instagram { background-color: #e4405f; }
        
        .description-section {
            background: white;
            padding: 35px;
            display: flex;
            flex-direction: column;
            justify-content: flex-start;
            min-height: 100%;
            overflow-y: auto;
        }
        
        .section-title {
            font-size: 1.6rem;
            font-weight: 700;
            color: #2c3e50;
            margin-bottom: 25px;
            padding-bottom: 15px;
            border-bottom: 3px solid #2c5aa0;
            display: inline-block;
        }
        
        .description-text {
            font-size: 15px;
            line-height: 1.7;
            color: #495057;
            margin-bottom: 20px;
            text-align: justify;
            word-wrap: break-word;
            hyphens: auto;
        }
        
        .specialties-title {
            font-size: 1.1rem;
            font-weight: 600;
            color: #2c3e50;
            margin: 25px 0 15px 0;
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
        
        /* Responsive Design */
        @media (max-width: 991px) {
            .agent-container {
                flex-direction: column;
                min-height: auto;
            }
            
            .agent-card {
                border-right: none;
                border-bottom: 1px solid #e8ecef;
                text-align: center;
            }
            
            .agent-name {
                font-size: 1.3rem;
            }
            
            .agent-title {
                font-size: 0.9rem;
                text-align: center;
            }
            
            .description-section {
                padding: 25px;
            }
            
            .section-title {
                font-size: 1.4rem;
            }
        }
        
        @media (max-width: 768px) {
            .agent-container {
                margin: 10px;
                border-radius: 12px;
            }
            
            .agent-card {
                padding: 20px;
            }
            
            .description-section {
                padding: 20px;
            }
            
            .agent-photo {
                max-width: 200px;
                height: 200px;
            }
            
            .agent-name {
                font-size: 1.2rem;
            }
            
            .agent-title {
                font-size: 0.85rem;
            }

            .contact-list {
                padding: 15px;
                margin-bottom: 20px;
            }

            .contact-item {
                padding: 10px 0;
            }

            .contact-icon {
                width: 22px;
                height: 22px;
                font-size: 10px;
                margin-right: 10px;
            }

            .contact-text {
                font-size: 13px;
            }
        }
        
        .projects__partner {
            padding: 40px 0;
        }
        
        .title__head h2 {
            font-size: 2rem;
            font-weight: 700;
            color: #2c3e50;
            margin-bottom: 40px;
        }
        
        .description-section {
            max-height: calc(100vh - 200px);
        }
        
        .description-section::-webkit-scrollbar {
            width: 6px;
        }
        
        .description-section::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 10px;
        }
        
        .description-section::-webkit-scrollbar-thumb {
            background: #c1c1c1;
            border-radius: 10px;
        }
        
        .description-section::-webkit-scrollbar-thumb:hover {
            background: #a8a8a8;
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
                        <h2 class="text-white ">Comprometidos contigo</h2>
                    </div>
                </div>
            </div>
        </section>
    </div>
    
    <div class="clearfix"></div>
    
    <section class="projects__partner">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8 col-lg-6">
                    <div class="title__head">
                        <h2 class="text-center">¿Quiénes somos?</h2>
                        <p style="text-align: justify;" id="quienes-somos"> </p>
                    </div>
                </div>
            </div>
            <div class="clearfix"></div>
            <div class="row justify-content-center">
                <div class="col-md-8 col-lg-6">
                    <div class="title__head">
                        <h2 class="text-center">Misión</h2>
                        <p style="text-align: justify;" id="mision"> </p>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-md-8 col-lg-6">
                    <div class="title__head">
                        <h2 class="text-center">Visión</h2>
                        <p style="text-align: justify;" id="vision"> </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="projects__partner">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8 col-lg-6">
                    <div class="title__head">
                        <h2 class="text-center">Nuestro equipo de trabajo</h2>
                    </div>
                </div>
            </div>
            <div class="row" id="nuestro-equipo">
                
            </div>
        </div>
    </section>

    <!-- OUR TEAM -->
    <section class="our__team">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-7">
                    <div class="title__head">
                        <h2 class="text-center">Apoyo emocional</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 col-lg-4" style="margin: auto;">
                    <div class="wrap-agent">
                        <div class="team-member">
                            <div class="team-img">
                                <img alt="team member" class="img-fluid" src="images/apoyo.jpg">
                            </div>
                            <div class="team-title">
                                <h6>
                                    Khalil Munir
                                </h6>
                                <p>
                                    Especialista Emocional
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- END TEAM -->

    <?php include "footer.php";?>

    <!-- SCROLL TO TOP -->
    <a href="javascript:" id="return-to-top"><i class="fa fa-chevron-up"></i></a>
    <!-- END SCROLL TO TOP -->
    <script src="./js/index.bundle.js?8918068d71def746395d"></script>

    <script src="nosotros.js"></script>
</body>

</html>