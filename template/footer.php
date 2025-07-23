<footer>
    <div class="wrapper__footer bg-theme-footer">
        <div class="container">
            <div class="row">
                <!-- ADDRESS -->
                <div class="col-md-4">
                    <div class="widget__footer">
                        <figure>
                            <img src="images/logo-gold.png" alt="" class="logo-footer">
                        </figure>
                        <p>
                            En Global MJF Arquitectos creamos espacios que inspiran y generan valor. 
                            Brindamos servicios en diseño de planos, venta de propiedades y gestión 
                            legal con declaratoria de fábrica e independizaciones, acompañándote en 
                            todo el proceso con profesionalismo y confianza.
                        </p>
                        <ul class="list-unstyled mb-0 mt-3">
                            <li> <b> <i class="fa fa-map-marker"></i></b><span id="location">214 West Arnold St. New York, NY
                                    10002</span> </li>
                            <li> <b><i class="fa fa-phone-square"></i></b><span id="contact">(123) 345-6789</span> </li>
                            <li> <b><i class="fa fa-envelope"></i></b><span id="email">support@realvilla.demo</span> </li>
                        </ul>
                    </div>
                </div>
                <!-- END ADDRESS -->
                <!-- QUICK LINKS -->
                <div class="col-md-4">
                    <div class="widget__footer">
                        <h4 class="footer-title">Acceso Rápido</h4>
                        <div class="link__category-two-column">
                            <ul class="list-unstyled ">
                                <li class="list-inline-item">
                                    <a href="nosotros.php">Nosotros</a>
                                </li>
                                <li class="list-inline-item">
                                    <a href="proyectos.php">Proyectos</a>
                                </li>
                                <li class="list-inline-item">
                                    <a href="inmobiliaria.php">Inmobiliaria</a>
                                </li>
                                <li class="list-inline-item">
                                    <a href="declaratoria.php">Declaratoria Fábrica</a>
                                </li>
                                <li class="list-inline-item">
                                    <a href="solicitud.php">Solicitud</a>
                                </li>
                                <li class="list-inline-item">
                                    <a href="contacto.php">Contacto</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- END QUICK LINKS -->
                <!-- NEWSLETTERS -->
                <div class="col-md-4">
                    <div class="widget__footer">
                        <h4 class="footer-title">Síguenos </h4>
                        <p class="mb-2">
                            Síguenos y mantente en contacto para recibir las últimas novedades.
                        </p>
                        <p>
                            <a id="btn-facebook" target="_blank" class="btn btn-social btn-social-o facebook mr-1">
                                <i class="fab fa-facebook-f"></i>
                            </a>
                            <a id="btn-linkedin" target="_blank" class="btn btn-social btn-social-o linkedin mr-1">
                                <i class="fab fa-linkedin-in"></i>
                            </a>
                            <a id="btn-instagram" target="_blank" class="btn btn-social btn-social-o instagram mr-1">
                                <i class="fab fa-instagram"></i>
                            </a>
                        </p>
                        <br>
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

<script>
    function obtenerFooter(){
        $.post("./controller/principal.php?op=informacion_principal", function(data) {
            data = JSON.parse(data);
        
            $("#location").html(data.direccion);
            $("#contact").html(data.numero);
            $("#email").html(data.correo);

            // Si solo tienes el usuario, arma la URL completa
            if (data.facebook) {
                $("#btn-facebook").attr("href", `https://www.facebook.com/${data.facebook}`);
            }
            if (data.linkedin) {
                $("#btn-linkedin").attr("href", `https://www.linkedin.com/in/${data.linkedin}`);
            }
            if (data.instagram) {
                $("#btn-instagram").attr("href", `https://www.instagram.com/${data.instagram}`);
            }
        });
    }
</script>