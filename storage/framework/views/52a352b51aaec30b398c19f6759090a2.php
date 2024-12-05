

<?php $__env->startSection('title', 'Visualizar Estado'); ?>

<?php $__env->startSection('content_header'); ?>
    <h1>Visualizar Estado de los Portafolios</h1>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="container">
        <!-- Mostrar mensaje de éxito o error -->
        <?php if(session('success')): ?>
            <div class="alert alert-success">
                <?php echo e(session('success')); ?>

            </div>
        <?php elseif(session('error')): ?>
            <div class="alert alert-danger">
                <?php echo e(session('error')); ?>

            </div>
        <?php endif; ?>

        <?php if(isset($mensaje)): ?>
            <div class="alert alert-info">
                <?php echo e($mensaje); ?>

            </div>
        <?php endif; ?>

        <?php $__currentLoopData = $datosPortafolios; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $dato): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="card mb-3">
                <div class="card-header">
                    <h4>Curso: <?php echo e($dato['nombre_curso']); ?></h4>
                </div>
                <div class="card-body">
                    <p><strong>Estado de la Revisión:</strong> <?php echo e($dato['estado_revision']); ?></p>
                    <p><strong>Comentarios:</strong> <?php echo e($dato['comentarios']); ?></p>

                    <?php if($dato['estado_revision'] == 'Corregir'): ?>
                        <!-- Mostrar botón si el estado es 'Corregir' -->
                        <form action="<?php echo e(route('docente.cambiar_estado', $dato['id_portafolio'])); ?>" method="POST">
                            <?php echo csrf_field(); ?>
                            <button type="submit" class="btn btn-success">Corregido</button>
                        </form>
                    <?php endif; ?>
                </div>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\portafolio3\resources\views/docente/estado_portafolios.blade.php ENDPATH**/ ?>