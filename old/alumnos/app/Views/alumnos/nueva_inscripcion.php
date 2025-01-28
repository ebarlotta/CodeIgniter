<script>
  // Activamos boton submit Guardar
  $(document).ready(function(){
    $("#carreras").change(function(){
      document.getElementById('boton').disabled = false; 
    });
  });
</script>

<script>
    var clicks=0;
</script>

    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid">
            <h2 class="mt-4"><i class="fas fa-list-alt"></i> <?php echo $vTITULO;?></h2>
                <hr>
                <form method="POST" action="<?php echo base_url(); ?>/alumnos/inscribir" autocomplete="off">
                    
                <p>
                    <a href="<?php echo base_url(); ?>/home" class="btn btn-secondary"><i class="fa fa-undo-alt"></i> Cancelar</a>
                    <button type="submit" onclick="clicks++;if(clicks>1){return false};" id="boton" class="btn btn-success" disabled><i class="fas fa-save"></i> Guardar</button>
                </p>

                <div class="form-group">

                    <fieldset class="form-group border p-3" style="background-color: #f2f2f2">
                        <div class="row">
                            <div class="col-sm-12">
                                <h5><b>Leer con Atención</b></h5>
                                Paso 1: Seleccione el Instituto y la carrera.</a>
                                <br>
                                Paso 2: Guarde la Inscripción.
                            </div>
                        </div>
                    </fieldset>

                    <fieldset class="form-group border p-3" style="background-color: #f2f2f2">
                        <div class="row">
                            <div class="col-sm-12">
                                <label><b>Seleccione el Instituto y la Carrera</b></label>
                                <select class="form-control" id="carreras" name="carreras">
                                    <?php foreach($vCARRERAS as $dato): ?>
                                        <option value="<?php echo $dato['id'] ?>"><?php echo 'IES ' . $dato['numero'] . ' - ' . $dato['nombre'] . ' - Res. ' . $dato['resolucion']?></option>
                                    <?php endforeach ?>
                                </select>
                            </div>
                        </div>
                    </fieldset>
                
                </form>

            </div>

        </main>