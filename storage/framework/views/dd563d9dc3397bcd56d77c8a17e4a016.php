<!-- resources/views/admin/usuarios/edit.blade.php -->


<?php $__env->startSection('content'); ?>
<div class="container">
    <h1>Editar Usuario</h1>
    <form action="<?php echo e(route('admin.usuarios.update', $user->id)); ?>" method="POST">
        <?php echo csrf_field(); ?>
        <?php echo method_field('PUT'); ?>
        <div class="form-group">
            <label for="name">Nombre</label>
            <input type="text" class="form-control" name="name" value="<?php echo e($user->name); ?>" required>
        </div>
        <div class="form-group">
            <label for="email">Correo Electrónico</label>
            <input type="email" class="form-control" name="email" value="<?php echo e($user->email); ?>" required>
        </div>
        <div class="form-group">
            <label>Rol</label>
            <div>
                <input type="radio" name="role" value="admin" <?php echo e($user->es_administrador ? 'checked' : ''); ?>> Administrador
            </div>
            <div>
                <input type="radio" name="role" value="revisor" <?php echo e($user->es_revisor ? 'checked' : ''); ?>> Revisor
            </div>
        </div>
        <div class="form-group">
            <label for="active">Activo</label>
            <input type="checkbox" name="active" <?php echo e($user->active ? 'checked' : ''); ?>> Sí
        </div>
        <button type="submit" class="btn btn-success">Guardar</button>
    </form>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\portafolio3\resources\views/admin/usuarios/edit.blade.php ENDPATH**/ ?>