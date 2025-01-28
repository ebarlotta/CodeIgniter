
<div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid">
                        <h1 class="mt-4"><i class="fas fa-user-cog"></i><?php echo ' ' . $vTITULO; ?></h1>
                        <hr>

                        <form method="POST" action="<?php echo base_url(); ?>/personas/actualizar_password" autocomplete="off" enctype="multipart/form-data">

                        <div class="form-group">

                            <fieldset class="form-group border p-3" style="background-color: #f2f2f2">
                                <div class="row">
                                    <div class="col-12 col-sm-4" style="margin-bottom: 15px">
                                        <label>Nueva Contraseña</label>
                                        <input class="form-control py-4" id="pass" name="pass" type="text" placeholder="Seleccione una contraseña" required />
                                    </div>
                                </div>
                            </fieldset>

                        <fieldset class="form-group border p-3" style="background-color: #e9ecef">
                        <button type="submit" class="btn btn-primary"><i class="fa fa-check"></i> Guardar</button>
                        <a href="<?php echo base_url(); ?>/home" class="btn btn-secondary"><i class="fa fa-undo-alt"></i> Cancelar</a>
                        </fieldset>
                    
                    </form>

                    </div>
                </main>