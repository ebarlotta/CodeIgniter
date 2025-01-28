
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid">
                        <h1 class="mt-4"><i class="fas fa-address-card"></i> <?php echo $vTITULO; ?></h1>
                        <hr>
                        <div>
                            <p>
                             <!--    <a href="<?php echo base_url(); ?>/tabulacion/inscripcion" class="btn btn-primary"><i class="fas fa-plus"></i> Nueva Inscripción</a> -->
                            </p>
                        </div>

                        <div class="card mb-4">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-striped table table-bordered" id="dataTable" width="100%" cellspacing="1" data-order='[[0,"asc"]]'>
                                        <thead class="thead-dark">
                                            <tr>
                                                <th>ID</th>
                                                <th>Apellido y Nombres</th>
                                                <th>DNI</th>
                                                <th>E-mail</th>
                                                <th>Acciones</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach($vDATOS as $dato) { ?>
                                                <tr>
                                                    <td><?php echo $dato['id'] ?></td>
                                                    <td><?php echo $dato['user_apellido'] .' '. $dato['user_nombres'] ?></td>
                                                    <td><?php echo $dato['user_dni'] ?></td>
                                                    <td><?php echo $dato['user_email'] ?></td>

                                                    <td>
                                                    <a href="<?php echo base_url(). '/administracion/editar_persona/'. $dato['id']; ?>" class="btn btn-success btn-sm"><i class="fas fa-pencil-alt"></i></a>
                                                    <a href="<?php echo base_url(). '/personas/ver_antecedentes/'. $dato['id']; ?>" class="btn btn-primary btn-sm"><i class="far fa-address-book"></i></a>
                                                    <a href="<?php echo base_url(). '/antiguedad/ver_antiguedad/'. $dato['id']; ?>" class="btn btn-secondary btn-sm"><i class="far fa-clock"></i></a>
                                                    <a href="<?php echo base_url(). '/administracion/password/'. $dato['id']; ?>" class="btn btn-danger btn-sm"><i class="fas fa-key"></i></a>
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
                