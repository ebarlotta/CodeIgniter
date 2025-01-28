<?php
$session=session();
$sistema="Alumnos DES v1.0.2";
?>

<!DOCTYPE html><html lang="es">

    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <!-- Titulo - Favicon -->
        <title><?php echo $sistema; ?></title>
        <link rel="icon" href="https://dti.mendoza.edu.ar/superior/sitio/favicon.ico" type="image/x-icon">
        <!-- CSS -->
        <link href="https://dti.mendoza.edu.ar/superior/sitio/assets/css/styles.css" rel="stylesheet" />
        <link href="https://dti.mendoza.edu.ar/superior/sitio/assets/css/jquery-ui.css" rel="stylesheet" />
        <link href="https://dti.mendoza.edu.ar/superior/sitio/assets/css/dataTables.bootstrap4.min.css" rel="stylesheet" />
        <!-- JS -->
        <script src="https://dti.mendoza.edu.ar/superior/sitio/assets/js/funciones-DES.js"></script>
        <script src="https://dti.mendoza.edu.ar/superior/sitio/assets/js/all.min.js"></script>
        <script src="https://dti.mendoza.edu.ar/superior/sitio/assets/js/jquery-3.5.1.js"></script>
        <script src="https://dti.mendoza.edu.ar/superior/sitio/assets/js/jquery-ui.min.js"></script>
        <script src="https://dti.mendoza.edu.ar/superior/sitio/assets/js/bootstrap.bundle.min.js"></script>
        <script src="https://dti.mendoza.edu.ar/superior/sitio/assets/js/Chart.min.js"></script>
        <script src="https://dti.mendoza.edu.ar/superior/sitio/assets/js/jquery.dataTables.min.js"></script>
        <script src="https://dti.mendoza.edu.ar/superior/sitio/assets/js/dataTables.buttons.min.js"></script>
        <script src="https://dti.mendoza.edu.ar/superior/sitio/assets/js/buttons.html5.min.js"></script>
        <script src="https://dti.mendoza.edu.ar/superior/sitio/assets/js/dataTables.bootstrap4.min.js"></script>
        <script src="https://dti.mendoza.edu.ar/superior/sitio/assets/js/datatables.min.js"></script>
    </head>
    
    <body class="skin-blue sidebar-mini">
        <!-- Superior -->
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-primary">
            <a class="navbar-brand" href="<?php echo base_url(); ?>/home"><?php echo $sistema; ?></a>
            <button class="btn btn-link btn-sm order-1 order-lg-0" id="sidebarToggle" href="#"><i class="fas fa-bars"></i></button>
            <!-- Botonera Sidebar -->

            <ul class="navbar-nav ml-auto mr-md-3 my-2 my-md-0">
                <li class="nav-item dropdown">
                    <font color="#FFFFFFF"><?php echo $session->user_email; ?></font>
                </li>
            </ul>
        </nav>

        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                        
                            <!-- LOGO -->
                            <div class="user-panel" align="center">
                                <br>
                                <img src="https://dti.mendoza.edu.ar/superior/sitio/img/DES.png" width="180">
                                <hr style="height:4px;border-width:0;background-color:#343a40">
                            </div>
                            <!-- HOME -->
                            <a class="nav-link" href="<?php echo base_url(); ?>/home">
                                <div class="sb-nav-link-icon"><i class="fa fa-home" style="font-size: 20px"></i></div>
                                Inicio
                            </a>
                            <!-- PERFIL -->
                            <a class="nav-link collapsed" href="<?php echo base_url(); ?>personas/perfil" data-toggle="collapse" data-target="#submenu_perfil" aria-expanded="false" aria-controls="submenu_perfil">
                                <div class="sb-nav-link-icon"><i class="fas fa-address-card" style="font-size: 20px"></i></div>
                                Perfil de Usuario
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="submenu_perfil" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="<?php echo base_url(); ?>personas/perfil">Datos Personales</a>
                                    <a class="nav-link" href="<?php echo base_url(); ?>personas/password">Cambiar Contraseña</a>
                                </nav>
                            </div>
                            <!-- AYUDA -->
                            <div>
                                <a class="nav-link" href="<?php echo base_url(); ?>/home/ayuda">
                                    <div class="sb-nav-link-icon"><i class="fa fa-info-circle" style="font-size: 20px"></i></div>
                                    Ayuda
                                </a>                                
                                <hr style="height:2px;border-width:0;background-color:#343a40">                       
                            </div>                            
                            <!-- CERRAR SESION -->
                            <a class="nav-link collapsed" href="<?php echo base_url(); ?>/personas/logout" >
                                <div class="sb-nav-link-icon"><i class="fas fa-sign-out-alt" style="font-size: 20px"></i></div>
                                Salir
                            </a>

                        </div>
                    </div>

                    <div class="sb-sidenav-footer">
                        Sistemas DES
                        <div class="small">Sitio Web Sistemas</div>
                    </div>
                </nav>
            </div>