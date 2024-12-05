<div class="card">
    <div class="card-header">
        <h3 class="card-title">Crear Portafolios</h3>
    </div>
    <div class="card-body">
        <form id="form-crear-portafolios">
            <?php echo csrf_field(); ?>
            <button type="button" class="btn btn-primary" id="btn-crear-portafolios">
                Crear Portafolios
            </button>
        </form>
    </div>
</div>

<div id="contenido-portafolios">
    <?php echo $__env->make('admin.portafolios.table', ['portafolios' => []], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?> <!-- Incluye la tabla inicial -->
</div>

<div id="errores-portafolios" style="display:none;" class="alert alert-danger"></div>

<script>
    $(document).ready(function () {
        $('#btn-crear-portafolios').on('click', function () {
            let formData = new FormData($('#form-crear-portafolios')[0]);

            $.ajax({
                url: '/admin/crear-portafolios',
                method: 'POST',
                data: {
                    id_usuario: $('#id_usuario').val(),
                    id_carga: $('#id_carga').val(),
                    fecha_subida: $('#fecha_subida').val(),
                    estado: $('#estado').val(),
                    id_semestre: $('#id_semestre').val(),
                    caratula: $('#caratula').is(':checked'),
                    carga_lectiva: $('#carga_lectiva').is(':checked'),
                    filosofia: $('#filosofia').is(':checked'),
                    cv: $('#cv').is(':checked'),
                    silabo: $('#silabo').is(':checked'),
                    tipo_curso: $('#tipo_curso').val(),
                    _token: $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    if(response.success) {
                        alert(response.message);
                        // Realiza alguna acción adicional si es necesario
                    } else {
                        alert('Error: ' + response.message);
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Error:', error);
                    alert('Hubo un error al crear el portafolio');
                }
            });

        });
    });
</script>
<?php /**PATH C:\laragon\www\portafolio3\resources\views/admin/crear_portafolios.blade.php ENDPATH**/ ?>