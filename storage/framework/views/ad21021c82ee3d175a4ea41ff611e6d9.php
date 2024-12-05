

<?php $__env->startSection('title', 'Portafolios Pendientes de Revisión'); ?>

<?php $__env->startSection('content_header'); ?>
    <h1>Portafolios Pendientes de Revisión</h1>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="card">
        <div class="card-body">
            <?php if($portafoliosConDatos->isEmpty()): ?>
                <p>No hay portafolios pendientes de revisión.</p>
            <?php else: ?>
                <table>
                    <thead>
                        <tr>
                            <th>Docente</th>
                            <th>Curso</th>
                            <th>Estado</th>
                            <th>Fecha de Actualización</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $portafoliosConDatos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $portafolio): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($portafolio['nombre_usuario']); ?></td>
                                <td><?php echo e($portafolio['id_curso']); ?></td>
                                <td><?php echo e($portafolio['estado']); ?></td>
                                <td><?php echo e($portafolio['updated_at']); ?></td>
                                <td>
                                    <button class="btn btn-primary" onclick="mostrarFormulario('general', <?php echo e($portafolio['id']); ?>, '<?php echo e($portafolio['tipo_curso']); ?>')">Editar Detalles Generales</button>
                                    <button class="btn btn-primary" onclick="mostrarFormulario('items', <?php echo e($portafolio['id']); ?>, '<?php echo e($portafolio['tipo_curso']); ?>')">Editar Ítems</button>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            <?php endif; ?>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="modalFormulario" tabindex="-1" aria-labelledby="modalFormularioLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalFormularioLabel">Formulario</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="modalContent">
                    <!-- Aquí se cargarán los formularios dinámicamente -->
                </div>
                
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<script>
    function mostrarFormulario(tipo, idPortafolio, tipoCurso) {
        console.log(`Tipo: ${tipo}, idPortafolio: ${idPortafolio}, tipoCurso: ${tipoCurso}`);
        
        let url = '';
        let modalContent = document.getElementById('modalContent');
        
        // Si es 'general', redirigimos a la ruta para editar detalles generales
        if (tipo === 'general') {
            url = '<?php echo e(route("revisor.editar.detallesGenerales", ":id")); ?>'.replace(':id', idPortafolio);
            fetch(url)
                .then(response => response.text())
                .then(html => {
                    modalContent.innerHTML = html;
                    $('#modalFormulario').modal('show');
                });
        } 
        // Si es 'items', redirigimos a la ruta para editar los ítems según el tipo de curso
        else if (tipo === 'items') {
            if (parseInt(tipoCurso) === 1) { // Teórico
                url = '<?php echo e(route("revisor.editar.itemsTeorico", ":id")); ?>'.replace(':id', idPortafolio);
            } else if (parseInt(tipoCurso) === 0) { // Práctico
                url = '<?php echo e(route("revisor.editar.itemsPractico", ":id")); ?>'.replace(':id', idPortafolio);
            }

            if (url !== '') {
                fetch(url)
                    .then(response => response.text())
                    .then(html => {
                        modalContent.innerHTML = html;
                        $('#modalFormulario').modal('show');
                    });
            } else {
                console.error("No se pudo determinar el tipo de curso.");
            }
        }
    }
</script>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\portafolio3\resources\views/revisor/pendientes_revision.blade.php ENDPATH**/ ?>