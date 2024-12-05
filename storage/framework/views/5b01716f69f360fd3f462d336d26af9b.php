<div class="card">
    <div class="card-header">
        <h3 class="card-title">Subir Carga Académica</h3>
    </div>
    <div class="card-body">
        <form id="form-subir-carga" enctype="multipart/form-data">
            <?php echo csrf_field(); ?>
            <div class="form-group">
                <label for="carga_academica">Cargar Archivo Excel</label>
                <input type="file" name="carga_academica" id="carga_academica" class="form-control" required>
            </div>
            <button type="button" class="btn btn-primary" id="btn-subir-carga">
                Subir Carga Académica
            </button>
        </form>
    </div>
</div>
<div id="tabla-carga-academica">
    <?php echo $__env->make('admin.carga-academica.table', ['tabla' => []], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
</div>

<script>
    $(document).ready(function () {
    $('#btn-subir-carga').on('click', function () {
        let formData = new FormData($('#form-subir-carga')[0]);

        $.ajax({
    url: "<?php echo e(route('admin.carga-academica.upload')); ?>",
    method: "POST",
    data: formData,
    contentType: false,
    processData: false,
    success: function(response) {
        if (response.status === "success") {
            $("#contenido-carga-academica").html(response.html);

            if (response.errores.length > 0) {
                let errorHtml = "<ul>";
                response.errores.forEach(function(error) {
                    errorHtml += `<li>${error}</li>`;
                });
                errorHtml += "</ul>";
                $("#errores-carga").html(errorHtml).show();
            } else {
                $("#errores-carga").hide();
            }
        } else {
            alert(response.message);
        }
    },
    error: function(xhr) {
        alert("Ocurrió un error al subir el archivo. Inténtalo de nuevo.");
    }
});

    });
});

</script>
<?php /**PATH C:\laragon\www\portafolio3\resources\views/admin/carga-academica/form.blade.php ENDPATH**/ ?>