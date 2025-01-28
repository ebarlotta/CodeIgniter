<?php $sistema="Sistema de Alumnos v1.0.1"; ?>

<!DOCTYPE html>
<html lang="es">

    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title><?php echo $sistema; ?></title>
        <link rel="icon" href="https://dti.mendoza.edu.ar/superior/sitio/favicon.ico" type="image/x-icon">
        <link href="https://dti.mendoza.edu.ar/superior/sitio/assets/css/styles.css" rel="stylesheet" />
        <link href="https://dti.mendoza.edu.ar/superior/sitio/assets/css/dataTables.bootstrap4.min.css" rel="stylesheet" />
        <script src="https://dti.mendoza.edu.ar/superior/sitio/assets/js/all.min.js"></script>
    </head>

    <body class="bg-primary">
        <div id="layoutAuthentication">
            <div id="layoutAuthentication_content">
                <main>
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-5">
                            <div class="card shadow-lg border-0 rounded-lg mt-5">
                                    <div align="center">
                                        <br>
                                        <img src="https://dti.mendoza.edu.ar/superior/sitio/img/DES.png" width="350" />
                                        <br>
                                        <br>
                                    </div>
                                    <div class="card-header">
                                        <h3 class="text-center font-weight-light my-1"><?php echo $sistema; ?></h3>
                                        <h6 class="text-center">Dirección de Educación Superior</h6>
                                    </div>
                                    <div class="card-body">

                                        <form method="POST" action="<?php echo base_url(); ?>/personas/valida">

                                            <div class="form-group">
                                                <label class="small mb-1" for="inputEmailAddress">Usuario</label>
                                                <input class="form-control py-4" id="user" name="user" type="text" placeholder="Ingrese su e-mail" required/>
                                            </div>
                                            <div class="form-group">
                                                <label class="small mb-1" for="inputPassword">Contraseña</label>
                                                <input class="form-control py-4" id="pass" name="pass" type="password" placeholder="Ingresa tu contraseña" required/>
                                            </div>
                                            <div class="form-group d-flex align-items-center justify-content-between mt-4 mb-0">
                                                <button class="btn btn-primary btn-block" type="submit">Ingresar</button>
                                            </div>
                                            
                                            <?php if(isset($validation)){ ?>
                                                <div class="alert alert-danger">
                                                <br>
                                                <?php echo $validation()->listErrors(); ?>
                                                </div>
                                            <?php } ?>

                                            <?php if(isset($error)){ ?>
                                                <br>
                                                <div class="alert alert-danger" align="center">
                                                <?php echo $error; ?>
                                                </div>
                                            <?php } ?>
                                            <br>

                                            <div style="text-align:center">
                                                <a href="<?php echo base_url(); ?>/personas/recuperar" class="text-reset">¿Olvidaste tu contraseña?</a>
                                                <br>
                                                <a href="<?php echo base_url(); ?>/personas/registro" class="text-reset">¿No tienes cuenta? Regístrate</a>
                                            </div>
                                            <hr>
                                            <div style="text-align:center">
                                                <a href="https://dti.mendoza.edu.ar/superior" class="text-reset">Acceder a Sitio Web - Sistemas DES</a>
                                            </div>
                                            
                                        </form>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
            <div id="layoutAuthentication_footer">
                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted"><?php echo $sistema; ?> | Dirección de Educación Superior | 2025</div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>

    </body>

</html>
