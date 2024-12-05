<table class="table table-bordered">
    <thead>
        <tr>
            <th>ID</th>
            <th>Usuario</th>
            <th>Carga Académica</th>
            <th>Fecha de Subida</th>
            <th>Estado</th>
            <th>Semestre</th>
            <th>Carátula</th>
            <th>Carga Lectiva</th>
            <th>Filosofía</th>
            <th>CV</th>
            <th>Sílabo</th>
            <th>Tipo de Curso</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        <?php $__empty_1 = true; $__currentLoopData = $portafolios; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $portafolio): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <tr>
                <td><?php echo e($portafolio->id); ?></td>
                <td><?php echo e($portafolio->usuario->name ?? 'No asignado'); ?></td>
                <td><?php echo e($portafolio->carga->nombre ?? 'No asignado'); ?></td>
                <td><?php echo e($portafolio->fecha_subida); ?></td>
                <td>
                    <span class="badge 
                        <?php if($portafolio->estado == 'Pendiente'): ?> badge-warning 
                        <?php elseif($portafolio->estado == 'Revisado'): ?> badge-success 
                        <?php else: ?> badge-danger 
                        <?php endif; ?>">
                        <?php echo e($portafolio->estado); ?>

                    </span>
                </td>
                <td><?php echo e($portafolio->semestre->nombre ?? 'No asignado'); ?></td>
                <td><?php echo e($portafolio->caratula ? 'Sí' : 'No'); ?></td>
                <td><?php echo e($portafolio->carga_lectiva ? 'Sí' : 'No'); ?></td>
                <td><?php echo e($portafolio->filosofia ? 'Sí' : 'No'); ?></td>
                <td><?php echo e($portafolio->cv ? 'Sí' : 'No'); ?></td>
                <td><?php echo e($portafolio->silabo ? 'Sí' : 'No'); ?></td>
                <td><?php echo e($portafolio->tipo_curso ? 'Teórico' : 'Práctico'); ?></td>
                
            </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <tr>
                <td colspan="13" class="text-center">No hay portafolios registrados.</td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>
<?php /**PATH C:\laragon\www\portafolio3\resources\views/admin/portafolios/table.blade.php ENDPATH**/ ?>