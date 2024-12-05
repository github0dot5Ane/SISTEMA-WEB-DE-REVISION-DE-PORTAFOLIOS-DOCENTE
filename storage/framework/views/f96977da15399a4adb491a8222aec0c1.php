<form action="<?php echo e(route('revisor.guardar.revision', $portafolio->id)); ?>" method="POST">
    <?php echo csrf_field(); ?>

    <h4>Detalles del Portafolio</h4>
    
    <div>
        <label>Carátula</label>
        <input type="checkbox" name="caratula" value="1" <?php echo e($portafolio->caratula ? 'checked' : ''); ?>>
    </div>

    <div>
        <label>Carga Lectiva</label>
        <input type="checkbox" name="carga_lectiva" value="1" <?php echo e($portafolio->carga_lectiva ? 'checked' : ''); ?>>
    </div>

    <div>
        <label>Filosofía</label>
        <input type="checkbox" name="filosofia" value="1" <?php echo e($portafolio->filosofia ? 'checked' : ''); ?>>
    </div>

    <div>
        <label>CV</label>
        <input type="checkbox" name="cv" value="1" <?php echo e($portafolio->cv ? 'checked' : ''); ?>>
    </div>

    <div>
        <label>Sílabo</label>
        <input type="checkbox" name="silabo" value="1" <?php echo e($portafolio->silabo ? 'checked' : ''); ?>>
    </div>

    <div>
        <label>Tipo de Curso</label>
        <input type="checkbox" name="tipo_curso" value="1" <?php echo e($portafolio->tipo_curso ? 'checked' : ''); ?>>
        <span><?php echo e($portafolio->tipo_curso ? 'Teórico' : 'Práctico'); ?></span>
    </div>

    <h4>Ítems del Curso</h4>
    <table>
        <thead>
            <tr>
                <th>Ítem</th>
                <th>Estado</th>
            </tr>
        </thead>
        <tbody>
            <?php
                $itemsTeorico = [
                    'avance_academico',
                    'registro_entrega_silabo',
                    'informe_examen_entrada',
                    'enunciado_y_solucion_exameN_1P',
                    'enunciado_y_solucion_exameN_2P',
                    'enunciado_y_solucion_exameN_3P',
                    'evidencia_actividades',
                    'registro_asistencia_1P',
                    'registro_asistencia_2P',
                    'registro_asistencia_3P',
                    'registro_notas_1P',
                    'registro_notas_2P',
                    'registro_notas_3P',
                    'cierre_portafolio',
                ];

                $itemsPractico = [
                    'avance_academico',
                    'evidencia_actividades',
                    'registro_asistencia_1P',
                    'registro_asistencia_2P',
                    'registro_asistencia_3P',
                    'registro_notas_1P',
                    'registro_notas_2P',
                    'registro_notas_3P',
                ];

                $items = $portafolio->tipo_curso ? $itemsTeorico : $itemsPractico;
            ?>

            <?php $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td><?php echo e(ucfirst(str_replace('_', ' ', $item))); ?></td>
                    <td>
                        <input 
                            type="checkbox" 
                            name="items[<?php echo e($item); ?>]" 
                            value="1" 
                            <?php echo e($portafolio->$item ? 'checked' : ''); ?>>
                    </td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>

    <button type="submit" class="btn btn-success">Guardar</button>
</form>
<?php /**PATH C:\laragon\www\portafolio3\resources\views/revisor/formulario_revision.blade.php ENDPATH**/ ?>