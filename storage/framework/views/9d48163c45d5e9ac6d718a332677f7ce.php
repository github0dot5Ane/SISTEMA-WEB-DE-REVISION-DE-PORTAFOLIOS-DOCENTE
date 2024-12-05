

<?php $__env->startSection('content'); ?>
<div class="container">
    <h1>Generar Copia de Seguridad</h1>

    <div class="card">
        <div class="card-body">
            <?php if(session('error')): ?>
                <div class="alert alert-danger"><?php echo e(session('error')); ?></div>
            <?php endif; ?>

            <form action="<?php echo e(route('admin.generar-copia')); ?>" method="POST">
                <?php echo csrf_field(); ?>
                <button type="submit" class="btn btn-primary">Generar Copia de Seguridad</button>
            </form>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\portafolio3\resources\views/admin/copia_seguridad.blade.php ENDPATH**/ ?>