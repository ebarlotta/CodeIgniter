                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid">
                        <div class="align-items-center justify-content-between small">
                            <div class="text-muted">Copyright &copy; <a href="https://superior-infd.mendoza.edu.ar/sitio/" target="_blank">Dirección de Educación Superior</a> | 2024</div>
                        </div>
                    </div>
                </footer>

            </div>
        </div>
        
        <!-- JS -->
        <script src="https://dti.mendoza.edu.ar/superior/sitio/assets/js/scripts.js"></script>

        <!-- Modal Confirma -->
        <div class="modal fade" id="modal-confirma" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="examplemodal">Eliminar Registro</h5>
                    </div>
                    <div class="modal-body">
                        El siguiente proceso eliminará el Registro!
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                        <a class="btn btn-danger btn-ok">Aceptar</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal Confirma -->
        <script>
            $('#modal-confirma').on('show.bs.modal', function(e){
                $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
            });
        </script>       

        <!-- Modal Enviar -->
        <div class="modal fade" id="modal-enviar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="examplemodal">Enviar Proyecto</h5>
                    </div>
                    <div class="modal-body">
                        Por favor verifique haber cargado y guardado toda la Información.
                        El siguiente proceso cerrará el proyecto y ya no podrá editarlo!
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                        <a class="btn btn-danger btn-ok">Aceptar</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal Enviar -->
        <script>
            $('#modal-enviar').on('show.bs.modal', function(e){
                $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
            });
        </script>

        <!-- Modal Cerrar -->
        <div class="modal fade" id="modal-cerrar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="examplemodal">Enviar Evaluación</h5>
                    </div>
                    <div class="modal-body">
                        Por favor verifique haber cargado los detalles de la Evaluación, seleccionado la Calificación y luego haber guardado.
                        El siguiente proceso cerrará la evaluación y ya no podrá editarla!
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                        <a class="btn btn-danger btn-ok">Aceptar</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal Cerrar -->
        <script>
            $('#modal-cerrar').on('show.bs.modal', function(e){
                $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
            });
        </script>

        <!-- Datatable General -->
        <script>
            $('#dataTable').DataTable({
                //Traducciones
                language: {
                    "sProcessing":    "Procesando...",
                    "sLengthMenu":    "Mostrar _MENU_ registros",
                    "sZeroRecords":   "No se encontraron resultados",
                    "sEmptyTable":    "Ningún dato disponible en esta tabla",
                    "sInfo":          "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                    "sInfoEmpty":     "Mostrando registros del 0 al 0 de un total de 0 registros",
                    "sInfoFiltered":  "(filtrado de un total de _MAX_ registros)",
                    "sInfoPostFix":   "",
                    "sSearch":        "Buscar:",
                    "sUrl":           "",
                    "sInfoThousands":  ",",
                    "sLoadingRecords": "Cargando...",
                    "oPaginate": {
                        "sFirst":    "Primero",
                        "sLast":    "Último",
                        "sNext":    "Siguiente",
                        "sPrevious": "Anterior"
                    },
                    "oAria": {
                        "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
                        "sSortDescending": ": Activar para ordenar la columna de manera descendente"
                    }
                },
                dom: 'Bfrtipl',
                //Botones
                buttons: [
                    {
                        extend: 'excelHtml5',
                        text: '<i class="fas fa-file-excel"></i> Excel',
                    },
                    {
                        extend: 'pdfHtml5',
                        text: '<i class="fas fa-file-pdf"></i> PDF',
                    }
                ]
            });
        </script>

        <!-- Datatable Mensajes Titulos -->
        <script>
            $('#dataTable_mensajes').DataTable({
                //Traducciones
                dom: 'Bfrtipl',
            });
        </script>

    </body>
</html>
