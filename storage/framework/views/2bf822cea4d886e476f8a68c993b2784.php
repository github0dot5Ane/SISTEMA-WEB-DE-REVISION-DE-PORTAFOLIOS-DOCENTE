<table class="table table-bordered">
    <thead>
        <tr>
            <th>ID Curso</th>
            <th>Usuario</th>
            <th>Nro Créditos</th>
            <th>Teórico</th>
        </tr>
    </thead>
    <tbody>
        <?php $__empty_1 = true; $__currentLoopData = $tabla; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $fila): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <tr>
                <td><?php echo e($fila->id_curso); ?></td>
                <td><?php echo e($fila->usuario->name); ?></td>
                <td><?php echo e($fila->nro_creditos); ?></td>
                <td><?php echo e($fila->es_teorico ? 'Sí' : 'No'); ?></td>
            </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <tr>
                <td colspan="4">No hay datos disponibles.</td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>
<?php /**PATH C:\laragon\www\portafolio3\resources\views/admin/carga-academica/table.blade.php ENDPATH**/ ?>