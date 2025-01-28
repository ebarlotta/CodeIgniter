
<div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid">
                        <h1 class="mt-4"><i class="fas fa-edit"></i><?php echo ' '. $vTITULO; ?></h1>
                        <hr>
                            <h4>Nombre: <?php echo " ".$vDATOS['C']; ?></h4>
                        <hr>

                        <form method="POST" action="<?php echo base_url(); ?>/alumnos/actualizar_lectivo" autocomplete="off">
                        <input type="hidden" id="id" name="id" value="<?php echo $vDATOS['id']; ?>" />
                        <input type="hidden" id="id_alumno" name="id_alumno" value="<?php echo $vDATOS['B']; ?>" />

                        <div clases="form-group">
                            <div class="row">
                                <div class="col-12 col-sm-7">
                                    <label>Carrera</label>
                                    <input class="form-control" id="carrera" name="carrera" type="text" value="<?php echo $vDATOS['A']; ?>" readonly />
                                </div>
                                <div class="col-12 col-sm-3">
                                    <label>Resolución</label>
                                    <input class="form-control" id="resolucion" name="resolucion" type="number" value="<?php echo $vDATOS['anolectivo']; ?>" readonly />
                                </div>
                                <div class="col-12 col-sm-2">
                                    <label>Año de Ingreso</label>
                                    <input class="form-control" id="anolectivo" name="anolectivo" type="number" value="<?php echo $vDATOS['anolectivo']; ?>" />
                                </div>
                            </div>
                            <div class="row" style="margin-top: 15px">
                                <div class="col-12 col-sm-1">
                                    <label>Curso</label>
                                    <input class="form-control" id="curso" name="curso" type="text" value="<?php echo $vDATOS['curso']; ?>" />
                                </div>
                                <div class="col-12 col-sm-3">
                                    <label>Estado</label>
                                    <select class="form-control" id="estado" name="estado">
                                        <option value="<?php echo $vDATOS['estado']?>" selected><?php echo $vDATOS['estado']?></option>
                                        <option value="ACTIVO">ACTIVO</option>
                                        <option value="INACTIVO">INACTIVO</option>
                                        <option value="EGRESADO">EGRESADO</option>
                                    </select>
                                </div>
                                <div class="col-12 col-sm-2">
                                    <label>Último Examen</label>       
                                    <input class="form-control" id="egreso" name="egreso" type="date" value="<?php echo $vDATOS['egreso']; ?>" />
                                </div>
                            </div>
                        </div>
                        <hr>
                        <button type="submit" class="btn btn-success"><i class="fa fa-check"></i> Guardar</button>
                        <button onclick="history.back()" class="btn btn-primary"><i class="fa fa-undo-alt"></i> Volver</button>
                        <hr>
                    
                    </form>

                    </div>
                </main>