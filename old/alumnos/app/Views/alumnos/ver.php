
<div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid">
                        <h1 class="mt-4"><i class="fas fa-user"></i><?php echo ' ' . $vTITULO; ?></h1>
                        <hr>
                        
                        <div class="form-group">

                            <fieldset class="form-group border p-3" style="background-color: #f2f2f2">
                                <div class="row">
                                    <div class="col-12 col-sm-4" style="margin-bottom: 15px">
                                        <label>Apellido</label>
                                        <input class="form-control" id="apellido" name="apellido" type="text" value="<?php echo $vPERSONA['user_apellido']; ?>" readonly />
                                    </div>
                                    <div class="col-12 col-sm-4" style="margin-bottom: 15px">
                                        <label>Nombres</label>
                                        <input class="form-control" id="nombres" name="nombres" type="text" value="<?php echo $vPERSONA['user_nombres']; ?>" readonly />
                                    </div>
                                    <div class="col-12 col-sm-4" style="margin-bottom: 15px">
                                        <label>E-Mail</label>
                                        <input class="form-control" id="email" name="email" type="text" value="<?php echo $vPERSONA['user_email']; ?>" readonly />
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12 col-sm-2" style="margin-bottom: 15px">
                                        <label>DNI</label>
                                        <input class="form-control" id="dni" name="dni" type="text" value="<?php echo $vPERSONA['user_dni']; ?>" readonly/>
                                    </div>
                                    <div class="col-12 col-sm-2" style="margin-bottom: 15px">
                                        <label>CUIL</label>
                                        <input class="form-control" id="cuil" name="cuil" type="text" value="<?php echo $vPERSONA['user_cuil']; ?>" readonly/>
                                    </div>
                                    <div class="col-12 col-sm-3">
                                        <label>Teléfono</label>
                                        <input class="form-control" id="telefono" name="telefono" type="text" value="<?php echo $vPERSONA['user_telefono']; ?>" readonly/>
                                    </div>
                                    <div class="col-12 col-sm-3">
                                        <label>Estado Civil</label>
                                        <input class="form-control" id="civil" name="civil" type="text" value="<?php echo $vPERSONA['user_civil']; ?>" readonly/>
                                    </div>
                                    <div class="col-12 col-sm-2">
                                        <label>Fecha de Nacimiento</label>
                                        <input class="form-control" id="nacimiento" name="nacimiento" type="date" value="<?php echo $vPERSONA['user_nacimiento']; ?>" readonly/>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12 col-sm-5">
                                        <label>Domicilio Real</label>
                                        <input class="form-control" id="domicilio" name="domicilio" type="text" value="<?php echo $vPERSONA['user_domicilio']; ?>" readonly/>
                                    </div>
                                    <div class="col-12 col-sm-4">
                                        <label>Domicilio Legal</label>
                                        <input class="form-control" id="domiciliolegal" name="domiciliolegal" type="text" value="<?php echo $vPERSONA['user_domiciliolegal']; ?>" readonly/>
                                    </div>
                                    <div class="col-12 col-sm-3">
                                        <label>Departamento</label>
                                        <select class="form-control" id="user_departamento_id" name="user_departamento_id" disabled>
                                            <?php foreach($vDEPARTAMENTOS as $dato){ ?>
                                                    <option value="<?php echo $dato['id']; ?>" <?php if($vPERSONA['user_departamento_id']==$dato['id']){echo 'selected'; } ?>><?php echo $dato['descripcion']; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                            </fieldset>

                        <fieldset class="form-group border p-3" style="background-color: #e9ecef">
                            <button onclick="history.back()" class="btn btn-primary"><i class="fa fa-undo-alt"></i> Volver</button>
                        </fieldset>

                    </div>
                </main>