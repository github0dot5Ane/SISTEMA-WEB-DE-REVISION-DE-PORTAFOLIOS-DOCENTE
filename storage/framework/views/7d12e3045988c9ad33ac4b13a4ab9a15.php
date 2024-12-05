

<?php $__env->startSection('content'); ?>
<div class="container mt-4">
    <h1 class="mb-4">Registro de Actividades de Revisión</h1>

    <div class="card">
        <div class="card-body">
            <?php if($revisiones->isEmpty()): ?>
                <p class="alert alert-warning">No hay registros de revisiones.</p>
            <?php else: ?>
                <div class="table-responsive">
                    <table class="table table-striped table-bordered">
                        <thead class="thead-dark">
                            <tr>
                                <th>Docente</th>
                                <th>Nombre del Revisor</th>
                                <th>Fecha de Revisión</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $revisiones; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $revision): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e($revision->usuario_name); ?></td>
                                    <td><?php echo e($revision->revisor_name); ?></td>
                                    <td><?php echo e(\Carbon\Carbon::parse($revision->updated_at)->format('d-m-Y H:i')); ?></td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>

                
            <?php endif; ?>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\portafolio3\resources\views/admin/revisiones/registro_actividades.blade.php ENDPATH**/ ?>