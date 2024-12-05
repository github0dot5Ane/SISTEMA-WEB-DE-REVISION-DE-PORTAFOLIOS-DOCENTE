

<?php $__env->startSection('title', 'Dashboard Docente'); ?>

<?php $__env->startSection('content_header'); ?>
    <h1>Panel del Docente</h1>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="row">
        <!-- Menú lateral -->
        <div class="col-md-3">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Opciones del Docente</h3>
                </div>
                <div class="card-body">
                    <ul class="nav nav-pills flex-column">
                        
                        <li class="nav-item">
                            <a href="javascript:void(0)" class="nav-link" id="visualizar-estado">
                                <i class="fas fa-eye"></i> Visualizar estado de portafolio y responder observaciones
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Área de contenido dinámico -->
        <div class="col-md-9">
            <div id="contenido-dashboard">
                <h4>Bienvenido al Panel del Docente</h4>
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

        
        // Visualizar estado de portafolio y responder observaciones
        $('#visualizar-estado').on('click', function () {
            cargarContenido("<?php echo e(route('docente.visualizar_estado')); ?>");
        });
    });
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('adminlte::page', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\portafolio3\resources\views/docente/dashboard.blade.php ENDPATH**/ ?>