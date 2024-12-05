

<?php $__env->startSection('title', 'Asignar Revisores'); ?>

<?php $__env->startSection('content_header'); ?>
    <h1>Asignar Revisores</h1>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Asignar Revisor a la Revisión</h3>
        </div>
        <div class="card-body">
            <!-- Contenedor para mensajes -->
            <div id="response-message" style="display:none;" class="alert"></div>

            <!-- Tabla de revisiones -->
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>ID Portafolio</th>
                        <th>Criterio</th>
                        <th>Resultado</th>
                        <th>Comentarios</th>
                        <th>Fecha de Revisión</th>
                        <th>Semestre</th>
                        <th>Revisor</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $revisiones; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $revision): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><?php echo e($revision->id_portafolio); ?></td>
                            <td><?php echo e($revision->criterio); ?></td>
                            <td><?php echo e($revision->resultado); ?></td>
                            <td><?php echo e($revision->comentarios); ?></td>
                            <td><?php echo e(\Carbon\Carbon::parse($revision->fecha_revision)->format('d/m/Y')); ?></td>
                            <td><?php echo e($revision->id_semestre); ?></td>
                            <td>
                                <!-- Formulario de selección de revisor -->
                                <form class="asignar-revisor-form" data-revision-id="<?php echo e($revision->id); ?>" method="POST">
                                    <?php echo csrf_field(); ?>
                                    <div class="form-group">
                                        <select class="form-control revisor-select" name="id_revisor_usuario" required>
                                            <option value="">Selecciona un revisor</option>
                                            <?php $__currentLoopData = $usuariosRevisores; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $usuario): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($usuario->id); ?>" 
                                                    <?php echo e($usuario->id == $revision->id_usuario_revisor ? 'selected' : ''); ?>>
                                                    <?php echo e($usuario->name); ?> (<?php echo e($usuario->email); ?>)
                                                </option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Asignar</button>
                                </form>

                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function () {
    // Capturar evento de envío del formulario
    $(document).on('submit', '.asignar-revisor-form', function (e) {
        e.preventDefault(); // Evitar recarga de la página

        // Verificar si se captura correctamente el evento
        console.log("Evento submit capturado.");

        // Datos del formulario
        var form = $(this);
        var revisionId = form.data('revision-id');
        var revisorId = form.find('.revisor-select').val();

        // Verificar que se haya seleccionado un revisor
        if (!revisorId) {
            alert("Debe seleccionar un revisor.");
            return;
        }

        // Verificar que los datos se están capturando correctamente
        console.log("Datos capturados: ", {
            revisionId: revisionId,
            revisorId: revisorId
        });

        // Realizar la solicitud Ajax
        $.ajax({
            url: "<?php echo e(route('admin.asignar.revisor')); ?>", // Asegúrate de que esta URL sea correcta
            method: "POST",
            data: {
                revision_id: revisionId,
                id_revisor_usuario: revisorId,
                _token: "<?php echo e(csrf_token()); ?>"  // Incluye el token CSRF
            },
            success: function(response) {
                // Mostrar respuesta en consola para verificar que la solicitud fue exitosa
                console.log("Respuesta de Ajax: ", response);
                alert(response.success);
            },
            error: function(xhr) {
                // Mostrar cualquier error
                console.log("Error en Ajax: ", xhr);
                alert("Hubo un error al asignar el revisor.");
            }
        });
    });

</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\portafolio3\resources\views/admin/asignar_revisores.blade.php ENDPATH**/ ?>