

<?php $__env->startSection('title', 'Generar Informes'); ?>

<?php $__env->startSection('content_header'); ?>
    <h1>Informes de Portafolios</h1>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="mt-3">
        <a href="<?php echo e(route('admin.generar-informes-pdf')); ?>" class="btn btn-primary">Descargar Excel</a>
    </div>
    <div class="table-responsive">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Nombre del Docente</th>
                    <th>Curso</th>
                    <th>Nombre del Revisor</th>
                    <th>Resultado</th>
                    <th>Comentarios</th>
                    <th>Última Actualización</th>
                </tr>
            </thead>
            <tbody>
                <?php $__currentLoopData = $portafoliosConDatos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $portafolio): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td><?php echo e($portafolio['nombre_docente']); ?></td>
                        <td><?php echo e($portafolio['curso']); ?></td>
                        <td><?php echo e($portafolio['nombre_revisor']); ?></td>
                        <td><?php echo e($portafolio['resultado']); ?></td>
                        <td><?php echo e($portafolio['comentarios'] ?? 'No Comments'); ?></td>
                        <td>
                            <?php
                                $date = \Carbon\Carbon::createFromFormat('d-m-Y H:i', $portafolio['updated_at'] ?? null);
                            ?>
                            <?php echo e($date ? $date->format('d/m/Y H:i') : 'No Date Available'); ?>

                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
    </div>

    
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\portafolio3\resources\views/admin/portafolios/informes.blade.php ENDPATH**/ ?>