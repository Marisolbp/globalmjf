
<!-- 
    Contenedor de chatbot donde se gestionaran 
-->
<div class='super_content_btn_chats'>
    <div class='super_bot' id="btn_bot">
        <a class='conten_bot'>
            <div class='conten_img_bot'>
                <img class='img_bot' src='images/bot.svg'>
            </div>
        </a>
    </div>

    <div class='super_wsp'>
        <a class='conten_wsp' href="https://wa.me/51926636364?text=Solicito%20información%20general" target="_blank">
            <div class='conten_img_wsp'>
                <img class='img_wsp' src='images/wsp.svg'>
            </div>
        </a>
    </div>
</div>

<div class='content_chat_bot close' id='element_chat_bot'>
    <div class="header_chat_bot">
        <span>Khalibot</span>
    </div>
    <div class="body_chat_bot" id='body_chat_bot'>

        <div class='row_chat chat_me' >
            <div class='avatar_chat'>
                <img class='img_avatar' src='images/bot.svg'>
            </div>
            <div class='bubble_chat'>
                ¡Hola! Soy Khalibot, tu asistente virtual. Estoy aquí para ayudarte a encontrar propiedades, proyectos arquitectónicos y mucho más. ¿En qué te puedo ayudar hoy?"
            </div>
        </div>

    </div>
    <div class="input_chat_bot">
        <div class='ipb_content_input'>
            <textarea name="text" id="chat_input" rows="1" ></textarea>
        </div>
        <div class='ipb_content_button'>
            <div class='button_send_chat' id='btn_send_chat'>
                <img class='img_send_chat'  src='images/send.svg'>
            </div>
        </div>
    </div>
</div>


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