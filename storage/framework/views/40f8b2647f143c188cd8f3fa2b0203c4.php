

<?php $__env->startSection('title', 'Revisiones'); ?>

<?php $__env->startSection('content_header'); ?>
    <h1>Revisiones del Revisor</h1>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="container">
        <?php $__currentLoopData = $datosRevisiones; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $dato): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="card mb-3">
                <div class="card-header">
                    <h4>Revisión de: <?php echo e($dato['nombre_usuario']); ?></h4>
                    <p>Curso: <?php echo e($dato['nombre_curso']); ?></p>
                </div>
                <div class="card-body">
                    <p><strong>Comentarios actuales:</strong></p>
                    <p><?php echo e($dato['revision']->comentarios ?? 'Sin comentarios'); ?></p>

                    <form action="<?php echo e(route('revisor.guardar_observacion', $dato['revision']->id)); ?>" method="POST">
                        <?php echo csrf_field(); ?>
                        <div class="form-group">
                            <label for="comentarios">Ingresar Observación:</label>
                            <textarea name="comentarios" id="comentarios" class="form-control" rows="3"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Guardar Observación</button>
                    </form>
                </div>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\portafolio3\resources\views/revisor/revisiones.blade.php ENDPATH**/ ?>