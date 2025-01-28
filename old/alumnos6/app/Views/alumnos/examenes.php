<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid">
            <h2 class="mt-4"><i class="fas fa-history"></i><?php echo ' '. $vTITULO; ?></h2>
            <hr>                    
            <div>
                <p>
                    <a href="<?php echo base_url(); ?>/home" class="btn btn-secondary"><i class="fa fa-undo-alt"></i> Volver</a>
                </p>
            </div>

            <div class="card mb-4">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table table-bordered" id="dataTable" width="100%" cellspacing="0" data-order='[[4,"desc"]]'>
                            <thead class="thead-dark">
                                <tr>
                                    <th>Instituto</th>
                                    <th>Id Examen</th>
                                    <th>Id Mesa</th>
                                    <th>Carrera</th>    
                                    <th>Materia</th>                                                
                                    <th>Fecha</th>
                                    <th>Estado</th>
                                    <th>Nota</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($datos as $dato) { ?>
                                    <tr>
                                        <td><?php echo $dato['numero'] ?></td>
                                        <td><?php echo $dato['id'] ?></td>
                                        <td><?php echo $dato['id_mesa'] ?></td>
                                        <td><?php echo $dato['vCARRERA'] ?></td>
                                        <td><?php echo $dato['nombre'] ?></td>
                                        <td><?php echo $dato['fecha'] ?></td>
                                        <td> <?php
                                            if($dato['estado'] == "APROBADO") {
                                            echo '<span style="color:green">' . $dato['estado'] . '</span>';
                                            } elseif ($dato['estado'] == "DESAPROBADO"){
                                            echo '<span style="color:red">' . $dato['estado'] . '</span>';
                                            } else {
                                            echo '<span style="color:blue">' . $dato['estado'] . '</span>';
                                            }
                                        ?></td>
                                        <td><?php echo $dato['nota'] ?></td>
                                        
                                        <td>
                                        <a href="#" class="btn btn-primary btn-sm"><i class="fas fa-info"></i></a>
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
