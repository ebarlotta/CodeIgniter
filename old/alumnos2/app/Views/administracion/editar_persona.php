
<div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid">
                        <h1 class="mt-4"><i class="fas fa-user-cog"></i><?php echo ' ' . $vTITULO; ?></h1>
                        <hr>
                        
                        <form method="POST" action="<?php echo base_url(); ?>/Administracion/actualizar_persona" autocomplete="off" enctype="multipart/form-data">
                        <input type="hidden" id="id" name="id" value="<?php echo $vPERSONA['id']; ?>" />

                        <div class="form-group">

                            <fieldset class="form-group border p-3" style="background-color: #f2f2f2">
                                <div class="row">
                                    <div class="col-12 col-sm-4" style="margin-bottom: 15px">
                                        <label>Apellido</label>
                                        <input class="form-control" id="apellido" name="apellido" type="text" value="<?php echo $vPERSONA['user_apellido']; ?>" required />
                                    </div>
                                    <div class="col-12 col-sm-4" style="margin-bottom: 15px">
                                        <label>Nombres</label>
                                        <input class="form-control" id="nombres" name="nombres" type="text" value="<?php echo $vPERSONA['user_nombres']; ?>" required />
                                    </div>
                                    <div class="col-12 col-sm-4" style="margin-bottom: 15px">
                                        <label>E-Mail</label>
                                        <input class="form-control" id="email" name="email" type="text" value="<?php echo $vPERSONA['user_email']; ?>" required />
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12 col-sm-3" style="margin-bottom: 15px">
                                        <label>DNI</label>
                                        <input class="form-control" id="dni" name="dni" type="text" value="<?php echo $vPERSONA['user_dni']; ?>" />
                                    </div>
                                    <div class="col-12 col-sm-3" style="margin-bottom: 15px">
                                        <label>CUIL</label>
                                        <input class="form-control" id="cuil" name="cuil" type="text" value="<?php echo $vPERSONA['user_cuil']; ?>" />
                                    </div>
                                    <div class="col-12 col-sm-3">
                                        <label>Teléfono</label>
                                        <input class="form-control" id="telefono" name="telefono" type="text" value="<?php echo $vPERSONA['user_telefono']; ?>" />
                                    </div>
                                    <div class="col-12 col-sm-3">
                                        <label>Estado Civil</label>
                                        <select class="form-control" id="civil" name="civil">
                                            <option value="<?php echo $vPERSONA['user_civil']; ?>"><?php echo $vPERSONA['user_civil']; ?></option>
                                            <option value="SOLTERO">SOLTERO</option>
                                            <option value="CASADO">CASADO</option>
                                            <option value="VIUDO">VIUDO</option>
                                            <option value="DIVORCIADO">DIVORCIADO</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12 col-sm-5">
                                        <label>Domicilio Real</label>
                                        <input class="form-control" id="domicilio" name="domicilio" type="text" value="<?php echo $vPERSONA['user_domicilio']; ?>" />
                                    </div>
                                    <div class="col-12 col-sm-5">
                                        <label>Domicilio Legal</label>
                                        <input class="form-control" id="domiciliolegal" name="domiciliolegal" type="text" value="<?php echo $vPERSONA['user_domiciliolegal']; ?>" />
                                    </div>
                                    <div class="col-12 col-sm-2">
                                        <label>Fecha de Nacimiento</label>
                                        <input class="form-control" id="nacimiento" name="nacimiento" type="date" value="<?php echo $vPERSONA['user_nacimiento']; ?>" />
                                    </div>
                                </div>
                            </fieldset>

                            <fieldset class="form-group border p-3" style="background-color: #f2f2f2">
                                <div class="row">
                                    <div class="col-12 col-sm-4" style="margin-bottom: 15px">
                                        <label>Rol Otorgado</label>
                                        <select class="form-control" id="rol" name="rol">
                                            <?php if ($vPERSONA['user_rol'] == '1') { ?>
                                                <option value="<?php echo $vPERSONA['user_rol']; ?>" selected>ROOT</option>
                                                <option value="2">ADMINISTRADOR</option>
                                                <option value="3">USUARIO</option>
                                            <?php } elseif ($vPERSONA['user_rol'] == '2') { ?>
                                                <option value="<?php echo $vPERSONA['user_rol']; ?>" selected>ADMINISTRADOR</option>
                                                <option value="1">ROOT</option>
                                                <option value="3">USUARIO</option>                                                
                                            <?php } elseif ($vPERSONA['user_rol'] == '3') { ?>
                                                <option value="<?php echo $vPERSONA['user_rol']; ?>" selected>USUARIO</option>
                                                <option value="1">ROOT</option>
                                                <option value="2">ADMINISTRADOR</option>                                                   
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                            </fieldset>                            

                        <fieldset class="form-group border p-3" style="background-color: #e9ecef">
                            <button type="submit" class="btn btn-primary"><i class="fa fa-check"></i> Guardar</button>
                            <a href="<?php echo base_url(); ?>/home" class="btn btn-secondary"><i class="fa fa-undo-alt"></i> Volver</a>
                        </fieldset>
                    
                    </form>

                    </div>
                </main>