    <!-- BEGIN: Main Menu-->
    <div class="main-menu menu-fixed menu-dark menu-accordion menu-shadow" data-scroll-to-active="true">
        <div class="navbar-header">
            <ul class="nav navbar-nav flex-row">
                
                <li class="nav-item mr-auto"><a class="navbar-brand" href="../../../html/ltr/vertical-menu-template-semi-dark/index.html">
                        <div class="brand-logo"><img class="logo" src="../../../archivos/LOGO GOLD.png" /></div>
                    </a>
                </li>
            </ul>
        </div>
        <div class="shadow-bottom"></div>
        <div class="main-menu-content">
            <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation" data-icon-style="lines">
                <li class=" navigation-header"><span>Inicio</span>
                <li id="liDashboard" class="<?php if (isset($active1)) { echo $active1; } ?> nav-item"><a href="../Home/"><i class="menu-livicon" data-icon="line-chart"></i><span class="menu-title" data-i18n="Dashboard">Dashboard</span></a></li>
                <li class=" navigation-header"><span>Configuración</span>
                </li>
                <li id="liSolicitud" class="<?php if (isset($active2)) { echo $active2; } ?> nav-item"><a href="../Solicitud/"><i class="menu-livicon" data-icon="file-import"></i><span class="menu-title" data-i18n="Chat">Solicitudes</span></a>
                </li>

                <li id="liMiembro" class="<?php if (isset($active3)) { echo $active3; } ?> nav-item"><a href="../Miembro/"><i class="menu-livicon" data-icon="users"></i><span class="menu-title" data-i18n="Todo">Miembros</span></a>
                </li>

                <li id="liIndependizacion" class="<?php if (isset($active4)) { echo $active4; } ?> nav-item"><a href="../Independizacion/"><i class="menu-livicon" data-icon="flag"></i><span class="menu-title" data-i18n="Kanban">Independización</span></a>
                </li>

                <li id="liPropiedad" class="<?php if (isset($active5)) { echo $active5; } ?> nav-item"><a href="../Inmobiliaria/"><i class="menu-livicon" data-icon="home"></i><span class="menu-title" data-i18n="Kanban">Inmobiliaria</span></a>
                </li>

                <li id="liProyecto" class="<?php if (isset($active6)) { echo $active6; } ?> nav-item"><a href="../Proyecto/"><i class="menu-livicon" data-icon="home"></i><span class="menu-title" data-i18n="Kanban">Proyectos</span></a>
                </li>


                <li class=" nav-item"><a href="#"><i class="menu-livicon" data-icon="gears"></i><span class="menu-title" data-i18n="Invoice">Configuración</span></a>
                    <ul class="menu-content">
                        <li class="<?php if (isset($active7)) { echo $active7; } ?> nav-item"><a href="../General/"><i class="bx bx-right-arrow-alt"></i><span class="menu-item" data-i18n="Invoice List">General</span></a>
                        </li>
                        <li class="<?php if (isset($active8)) { echo $active8; } ?> nav-item"><a href="../Slider/"><i class="bx bx-right-arrow-alt"></i><span class="menu-item" data-i18n="Invoice">Slider</span></a>
                        </li>
                        <li class="<?php if (isset($active9)) { echo $active9; } ?> nav-item"><a href="../Tipo_Propiedad/"><i class="bx bx-right-arrow-alt"></i><span class="menu-item" data-i18n="Invoice">Tipo de propiedad</span></a>
                        </li>
                        <li class="<?php if (isset($active10)) { echo $active10; } ?> nav-item"><a href="../Usuario/"><i class="bx bx-right-arrow-alt"></i><span class="menu-item" data-i18n="Invoice List">Usuarios</span></a>
                        </li>
                    </ul>
                </li>
                
 
            </ul>
        </div>
    </div>
    <!-- END: Main Menu-->