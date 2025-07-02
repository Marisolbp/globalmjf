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

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    
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
                        <p style="text-align: justify;"> En Global MJF Arquitectos nos dedicamos a diseñar espacios que inspiran
                            y generan valor. Ofrecemos servicios especializados en diseño de planos, 
                            venta de propiedades, y gestión legal mediante declaratoria de fábrica e 
                            independizaciones. Nuestro compromiso es acompañarte en cada etapa de tu 
                            proyecto con profesionalismo, confianza y soluciones integrales.
                        </p>
                    </div>
                </div>
            </div>
            <div class="clearfix"></div>
            <div class="row justify-content-center">
                <div class="col-md-8 col-lg-6">
                    <div class="title__head">
                        <h2 class="text-center">Misión</h2>
                        <p style="text-align: justify;"> Creamos oportunidades, edificamos futuro y diseñamos sueños, brindando un 
                            excelente servicio a nuestros clientes con una visión estratégica y pasión 
                            por el detalle, porque entendemos que cada metro cuadrado es una inversión 
                            que transforma vidas
                        </p>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-md-8 col-lg-6">
                    <div class="title__head">
                        <h2 class="text-center">Visión</h2>
                        <p style="text-align: justify;"> Ser la constructora e inmobiliaria más influyente y confiable a nivel 
                            nacional e internacional, siendo sinónimo de calidad, innovación y sostenibilidad.
                        </p>
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
            <div class="row">
                <div class="col-12 col-xl-12">
                    <div class="agent-container">
                        <!-- Información del agente y contacto -->
                        <div class="col-lg-4 d-flex">
                            <div class="agent-card">
                                <!-- Foto del agente -->
                                <div class="photo-container text-center">
                                    <div class="listing-badge">CAP 24160</div>
                                    <img src="images/milser1.png" class="agent-photo">
                                </div>
                                
                                <!-- Información básica -->
                                <div class="agent-info">
                                    <h2 class="agent-name">MILSER LLANOS CADENILLAS</h2>
                                    <p class="agent-title">Arquitecto, broker inmobiliario y especialista en saneamiento físico-legal de inmuebles.</p>

                                    <ul class="contact-list">
                                        <li class="contact-item">
                                            <div class="contact-icon">
                                                <i class="fas fa-phone"></i>
                                            </div>
                                            <div class="contact-text">
                                                <a href="tel:+51987654321">+51 907 877 361</a>
                                            </div>
                                        </li>
                                        <li class="contact-item">
                                            <div class="contact-icon">
                                                <i class="fas fa-envelope"></i>
                                            </div>
                                            <div class="contact-text">
                                                <a href="mailto:milser@globalmjf.com">arq.mllanos@gmail.com</a>
                                            </div>
                                        </li>
                                    </ul>
                                    
                                    <!-- Botones sociales -->
                                    <div class="social-buttons">                                        
                                        <a href="#" class="social-btn linkedin">
                                            <i class="fab fa-linkedin-in"></i>
                                        </a>
                                        <a href="#" class="social-btn instagram">
                                            <i class="fab fa-instagram"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Sección de descripción -->
                        <div class="col-lg-8 d-flex">
                            <div class="description-section">
                                <h3 class="section-title">Descripción</h3>
                                
                                <p class="description-text">
                                    Es CEO de <strong>Global MJF Arquitectos</strong>. Se graduó de la carrera de Arquitectura y Urbanismo Ambiental en la Universidad Científica del Sur. Ha ganado 4 premios por concursos dirigidos por la Universidad y el Colegio de Arquitectos del Perú.
                                </p>
                                
                                <p class="description-text">
                                    Ha diseñado más de un millón de m² en sectores residenciales, hoteles, centros comerciales, culturales y educativos.
                                </p>
                                
                                <h4 class="specialties-title">Especialidades y Certificaciones:</h4>
                                
                                <ul class="specialties-list">
                                    <li class="specialty-item">
                                        <div class="specialty-bullet"></div>
                                        <div class="specialty-text">Especialista en Saneamiento físico legal</div>
                                    </li>
                                    <li class="specialty-item">
                                        <div class="specialty-bullet"></div>
                                        <div class="specialty-text">Especialista en Valorización y Liquidación de Obras</div>
                                    </li>
                                    <li class="specialty-item">
                                        <div class="specialty-bullet"></div>
                                        <div class="specialty-text">Especialista en Supervisión de Obras</div>
                                    </li>
                                    <li class="specialty-item">
                                        <div class="specialty-bullet"></div>
                                        <div class="specialty-text">Agente Inmobiliario 19592-PJ-MVCS</div>
                                    </li>
                                    <li class="specialty-item">
                                        <div class="specialty-bullet"></div>
                                        <div class="specialty-text">Especialista en Asesoría y Gestión Inmobiliaria</div>
                                    </li>
                                    <li class="specialty-item">
                                        <div class="specialty-bullet"></div>
                                        <div class="specialty-text">Arquitecto Verificador SUNARP CIV N°017267VCZRIX</div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12 col-xl-12">
                    <div class="agent-container">
                        <!-- Información del agente y contacto -->
                        <div class="col-lg-4 d-flex">
                            <div class="agent-card">
                                <!-- Foto del agente -->
                                <div class="photo-container text-center">
                                    <div class="listing-badge">CAP 24178</div>
                                    <img src="images/angel2.png" class="agent-photo" alt="Ángel Jiménez">
                                </div>

                                <!-- Información básica -->
                                <div class="agent-info">
                                    <h2 class="agent-name">ANGEL JIMÉNEZ PALMA</h2>
                                    <p class="agent-title">Arquitecto especialista en diseño de interiores.</p>

                                    <ul class="contact-list">
                                        <li class="contact-item">
                                            <div class="contact-icon">
                                                <i class="fas fa-phone"></i>
                                            </div>
                                            <div class="contact-text">
                                                <a href="tel:+51987654321">+51 966 324 455</a>
                                            </div>
                                        </li>
                                        <li class="contact-item">
                                            <div class="contact-icon">
                                                <i class="fas fa-envelope"></i>
                                            </div>
                                            <div class="contact-text">
                                                <a href="mailto:milser@globalmjf.com">arq.angeljimenez@gmail.com</a>
                                            </div>
                                        </li>
                                    </ul>                               

                                    <!-- Botones sociales -->
                                    <div class="social-buttons">                                        
                                        <a href="#" class="social-btn linkedin">
                                            <i class="fab fa-linkedin-in"></i>
                                        </a>
                                        <a href="#" class="social-btn instagram">
                                            <i class="fab fa-instagram"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Sección de descripción -->
                        <div class="col-lg-8 d-flex">
                            <div class="description-section">
                                <h3 class="section-title">Descripción</h3>

                                <p class="description-text">
                                    Es subgerente y socio cofundador de <strong>Global MJF Arquitectos</strong>. Arquitecto colegiado y habilitado con el CAP 24178. Ganador del fondo Investiga Lima, graduado en el tercio superior. Ganador de expo talleres y concursos dirigidos por la Universidad Científica del Sur.
                                </p>
                                <p class="description-text">
                                    Ha diseñado más de 100 mil m² en sectores residenciales, centros comerciales y educativos. Ha realizado saneamiento físico legal de más de 120 propiedades en Lima Metropolitana.
                                </p>

                                <h4 class="specialties-title">Especialidades y Certificaciones:</h4>
                                <ul class="specialties-list">
                                    <li class="specialty-item"><div class="specialty-bullet"></div><div class="specialty-text">Especialista en Saneamiento físico legal</div></li>
                                    <li class="specialty-item"><div class="specialty-bullet"></div><div class="specialty-text">Especialista en Diseño de Interiores</div></li>
                                    <li class="specialty-item"><div class="specialty-bullet"></div><div class="specialty-text">Especialista en Visualización Arquitectónica</div></li>
                                    <li class="specialty-item"><div class="specialty-bullet"></div><div class="specialty-text">Especialista en Asesoría Universitaria</div></li>
                                    <li class="specialty-item"><div class="specialty-bullet"></div><div class="specialty-text">Especialista en Ejecución de Obras Urbanas</div></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12 col-xl-12">
                        <div class="agent-container">
                            <!-- Información del agente y contacto -->
                            <div class="col-lg-4 d-flex">
                                <div class="agent-card">
                                    <!-- Foto del agente -->
                                    <div class="photo-container text-center">
                                        <div class="listing-badge">CAP 32029</div>
                                        <img src="images/francisco3.png" class="agent-photo" alt="Francisco Milla">
                                    </div>

                                    <!-- Información básica -->
                                    <div class="agent-info">
                                        <h2 class="agent-name">FRANCISCO MILLA AGAPE</h2>
                                        <p class="agent-title">Arquitecto especialista en construcción.</p>

                                        <ul class="contact-list">
                                            <li class="contact-item">
                                                <div class="contact-icon">
                                                    <i class="fas fa-phone"></i>
                                                </div>
                                                <div class="contact-text">
                                                    <a href="tel:+51987654321">+51 966 324 455</a>
                                                </div>
                                            </li>
                                            <li class="contact-item">
                                                <div class="contact-icon">
                                                    <i class="fas fa-envelope"></i>
                                                </div>
                                                <div class="contact-text">
                                                    <a href="mailto:milser@globalmjf.com">arq.franciscomilla@gmail.com</a>
                                                </div>
                                            </li>
                                        </ul>  

                                        <!-- Botones sociales -->
                                        <div class="social-buttons">                                        
                                            <a href="#" class="social-btn linkedin">
                                                <i class="fab fa-linkedin-in"></i>
                                            </a>
                                            <a href="#" class="social-btn instagram">
                                                <i class="fab fa-instagram"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Sección de descripción -->
                            <div class="col-lg-8 d-flex">
                                <div class="description-section">
                                    <h3 class="section-title">Descripción</h3>

                                    <p class="description-text">
                                        Es subgerente y socio cofundador de <strong>Global MJF Arquitectos</strong>. Se graduó de Arquitectura y Urbanismo Ambiental en la Universidad Científica del Sur. Ha participado en expotalleres y concursos de la universidad.
                                    </p>
                                    <p class="description-text">
                                        Ha diseñado y construido más de 100 proyectos en sectores residenciales, comerciales y educativos. Ha realizado habilitaciones urbanas residenciales y comerciales, además del saneamiento físico legal de más de 100 propiedades en Lima Metropolitana.
                                    </p>

                                    <h4 class="specialties-title">Especialidades y Certificaciones:</h4>
                                    <ul class="specialties-list">
                                        <li class="specialty-item"><div class="specialty-bullet"></div><div class="specialty-text">Especialista en Construcción y Edificaciones</div></li>
                                        <li class="specialty-item"><div class="specialty-bullet"></div><div class="specialty-text">Especialista en Habilitaciones Urbanas</div></li>
                                        <li class="specialty-item"><div class="specialty-bullet"></div><div class="specialty-text">Especialista en Saneamiento físico legal</div></li>
                                    </ul>
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

                                    Don’t miss to subscribe to our news feeds, kindly fill the form below
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
                            © 2025 MainCode
                        </span>
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