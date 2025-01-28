
<div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid">
                        <h2 class="mt-4"><i class="fas fa-graduation-cap"></i><?php echo ' '. $vTITULO; ?></h2>
                        <hr>
                        <div>
                            <p>
                                <a href="<?php echo base_url(); ?>/home" class="btn btn-secondary"><i class="fa fa-undo-alt"></i> Volver</a>
                                <a href="<?php echo base_url(). 'alumnos/nueva_inscripcion'; ?>" class="btn btn-info"><i class="fa fa-plus"></i> Nueva Inscripción</a>
                            </p>
                        </div>

                        <div class="card mb-4">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-striped table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <thead class="thead-dark">
                                            <tr>
                                                <th>Id</th>
                                                <th>Instituto</th>
                                                <th>Carrera</th>
                                                <th>Resolución</th>
                                                <th>Año Inicio</th>
                                                <th>Curso Actual</th>
                                                <th>Estado</th>
                                                <th>Fecha de Egreso</th>
                                                <th>Acciones</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach($vDATOS as $dato) { ?>
                                                <tr>
                                                    <td><?php echo $dato['id'] ?></td>
                                                    <td><?php echo $dato['numero'] ?></td>
                                                    <td><?php echo $dato['nombre'] ?></td>
                                                    <td><?php echo $dato['resolucion'] ?></td>
                                                    <td><?php echo $dato['anolectivo'] ?></td>
                                                    <td><?php echo $dato['curso'] ?></td>
                                                    <td> <?php
                                                        if($dato['estado'] == "ACTIVO") {
                                                        echo '<span style="color:green">' . $dato['estado'] . '</span>';
                                                        } elseif ($dato['estado'] == "INACTIVO"){
                                                        echo '<span style="color:red">' . $dato['estado'] . '</span>';
                                                        } else {
                                                        echo '<span style="color:blue">' . $dato['estado'] . '</span>';
                                                        }
                                                    ?></td>
                                                    <td><?php echo $dato['egreso'] ?></td> 
                                                    
                                                    <td>
                                                    <a href="<?php echo base_url(). '/alumnos/examenes_carrera/'. $dato['id_carrera'];?>" class="btn btn-warning btn-sm"><i class="fas fa-list"></i></a>
                                                    </td>
                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
