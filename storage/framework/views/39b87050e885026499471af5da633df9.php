

<?php $__env->startSection('title', 'Dashboard Revisor'); ?>

<?php $__env->startSection('content_header'); ?>
    <h1>Panel del Revisor</h1>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="row">
        <!-- Menú lateral -->
        <div class="col-md-3">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Opciones del Revisor</h3>
                </div>
                <div class="card-body">
                    <ul class="nav nav-pills flex-column">
                        <li class="nav-item">
                            <a href="javascript:void(0)" class="nav-link" id="visualizar-pendientes">
                                <i class="fas fa-tasks"></i> Visualizar portafolios pendientes de revisión
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="javascript:void(0)" class="nav-link" id="ingresar-observaciones">
                                <i class="fas fa-comment-alt"></i> Ingresar observaciones
                            </a>
                        </li>
                        
                        
                    </ul>
                </div>
            </div>
        </div>

        <!-- Área de contenido dinámico -->
        <div class="col-md-9">
            <div id="contenido-dashboard">
                <h4>Bienvenido al Panel del Revisor</h4>
                <p>Seleccione una opción del menú para ver el contenido aquí.</p>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
<script>
    $(document).ready(function () {
        // Función genérica para cargar contenido
        function cargarContenido(url) {
            $.get(url, function (data) {
                $('#contenido-dashboard').html(data);
            });
        }

        // Visualizar portafolios pendientes de revisión
        $('#visualizar-pendientes').on('click', function () {
            cargarContenido("<?php echo e(route('revisor.pendientes_revision')); ?>");
        });

        // Ingresar observaciones
        $('#ingresar-observaciones').on('click', function () {
            cargarContenido("<?php echo e(route('revisor.ingresar_observacion')); ?>");
        });

        // Seleccionar ítems válidos del portafolio
        $('#seleccionar-items').on('click', function () {
            cargarContenido('/revisor/seleccionar-items');
        });

        // Enviar notificaciones de observaciones
        $('#enviar-notificaciones').on('click', function () {
            cargarContenido('/revisor/enviar-notificaciones');
        });

        // Enviar correos de recordatorio
        $('#enviar-correos').on('click', function () {
            cargarContenido('/revisor/enviar-correos');
        });

        
    });
</script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('adminlte::page', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\portafolio3\resources\views/revisor/dashboard.blade.php ENDPATH**/ ?>