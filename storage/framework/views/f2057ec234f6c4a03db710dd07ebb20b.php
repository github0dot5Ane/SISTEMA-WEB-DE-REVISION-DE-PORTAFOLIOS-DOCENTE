

<?php $__env->startSection('content'); ?>
<div class="container">
    <h2>Lista de Revisiones</h2>

    <!-- Mostrar mensaje de éxito si existe -->
    <div id="message" style="display: none;" class="alert"></div>

    <table class="table">
        <thead>
            <tr>
                <th>Docente</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php $__currentLoopData = $revisiones; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $revision): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td><?php echo e($revision->usuario_name); ?></td>
                <td>
                    <form action="<?php echo e(route('admin.revisiones.asignar', $revision->id)); ?>" method="POST" class="assign-revisor-form" data-id="<?php echo e($revision->id); ?>">
                        <?php echo csrf_field(); ?>
                        <select name="revisor_id" class="form-control">
                            <option value="">Seleccione un revisor</option>
                            <?php $__currentLoopData = $usuarios; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $usuario): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($usuario->id); ?>"><?php echo e($usuario->name); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                        <button type="submit" class="btn btn-primary mt-2">Asignar Revisor</button>
                    </form>
                </td>
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>
</div>

<!-- Incluir jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    $(document).ready(function() {
        $('.assign-revisor-form').on('submit', function(event) {
            event.preventDefault(); // Evitar el envío del formulario

            var form = $(this);
            var revisor_id = form.find('select[name="revisor_id"]').val();
            var revision_id = form.data('id');

            $.ajax({
                url: "<?php echo e(route('admin.revisiones.asignar', ':id')); ?>".replace(':id', revision_id),
                type: 'POST',
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content'),
                    revisor_id: revisor_id
                },
                success: function(response) {
                    // Si la asignación es exitosa, mostrar mensaje
                    $('#message').removeClass('alert-danger').addClass('alert-success').text(response.success).show();
                },
                error: function(xhr) {
                    // Si ocurre un error, mostrar el mensaje de error
                    var errorMessage = xhr.responseJSON.error || 'Error desconocido';
                    $('#message').removeClass('alert-success').addClass('alert-danger').text(errorMessage).show();
                }
            });
        });
    });
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\portafolio3\resources\views/admin/revisiones/index.blade.php ENDPATH**/ ?>