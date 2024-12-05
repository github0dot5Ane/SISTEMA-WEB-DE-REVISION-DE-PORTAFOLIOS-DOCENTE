

<?php $__env->startSection('content'); ?>
<div class="container">
    <div class="card">
        <div class="card-header bg-primary text-white">
            <h3>Detalles del Usuario</h3>
        </div>
        <div class="card-body">
            <p><strong>Nombre:</strong> <?php echo e($user->name); ?></p>
            <p><strong>Correo:</strong> <?php echo e($user->email); ?></p>
            <p><strong>Es Administrador:</strong> <?php echo e($user->es_administrador ? 'Sí' : 'No'); ?></p>
            <p><strong>Es Revisor:</strong> <?php echo e($user->es_revisor ? 'Sí' : 'No'); ?></p>
            <p><strong>Activo:</strong> <?php echo e($user->activo ? 'Sí' : 'No'); ?></p>
        </div>
        <div class="card-footer text-end">
            <a href="<?php echo e(route('admin.usuarios.index')); ?>" class="btn btn-secondary">Volver al listado</a>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\portafolio3\resources\views/admin/usuarios/show.blade.php ENDPATH**/ ?>