

<?php $__env->startSection('title', 'Dashboard'); ?>

<?php $__env->startSection('content_header'); ?>
    <h1>Panel de Administración</h1>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="row">
        <!-- Menú lateral -->
        <div class="col-md-3">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Gestión de Funciones</h3>
                </div>
                <div class="card-body">
                    <ul class="nav nav-pills flex-column">
                        <li class="nav-item">
                            <a href="javascript:void(0)" class="nav-link" id="ingresar-usuario">
                                <i class="fas fa-user-plus"></i> Registrar y habilitar docentes
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="javascript:void(0)" class="nav-link" id="ver-usuarios">
                                <i class="fas fa-users"></i> Ver Usuarios
                            </a>
                        </li>
                        
                        <li class="nav-item">
                            <a href="javascript:void(0)" class="nav-link" id="acceder-registro">
                                <i class="fas fa-book"></i> Acceder al registro de actividades
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="javascript:void(0)" class="nav-link" id="subir-carga">
                                <i class="fas fa-upload"></i> Subir carga académica
                            </a>
                        </li>
                        
                        <li class="nav-item">
                            <a href="javascript:void(0)" class="nav-link" id="generar-informes">
                                <i class="fas fa-file-alt"></i> Generar informes de portafolios
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="javascript:void(0)" class="nav-link" id="crear-copias">
                                <i class="fas fa-copy"></i> Crear copias de seguridad
                            </a>
                        </li>
                        
                        <li class="nav-item">
                            <a href="javascript:void(0)" class="nav-link" id="asignar-revisores">
                                <i class="fas fa-users"></i> Asignar revisores a docentes
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Área de contenido dinámico -->
        <div class="col-md-9">
            <div id="contenido-dashboard">
                <h4>Bienvenido al Panel de Administración</h4>
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

        // Registrar y habilitar docentes
        $('#ingresar-usuario').on('click', function () {
            cargarContenido("<?php echo e(route('usuarios.create')); ?>");
        });

        // Ver Usuarios
        $('#ver-usuarios').on('click', function () {
            cargarContenido("<?php echo e(route('usuarios.index')); ?>");
        });

        // Enviar recordatorios de revisión
        $('#enviar-recordatorios').on('click', function () {
            cargarContenido('/admin/enviar-recordatorios');
        });

        // Acceder al registro de actividades
        $('#acceder-registro').on('click', function () {
            cargarContenido("<?php echo e(route('admin.registro.actividades')); ?>");
        });

        // Subir carga académica
        $('#subir-carga').on('click', function () {
            cargarContenido("<?php echo e(route('admin.carga-academica.form')); ?>");
        });
        


        // Generar informes de portafolios
        $('#generar-informes').on('click', function () {
            cargarContenido("<?php echo e(route('admin.generar_reportes')); ?>");
        });

        // Crear copias de seguridad
        $('#crear-copias').on('click', function () {
            cargarContenido("<?php echo e(route('admin.generar-copia.form')); ?>");
        });

        // Visualizar progreso de revisiones
        $('#visualizar-progreso').on('click', function () {
            cargarContenido('/admin/admin.progreso-revisiones');
        });

        // Asignar revisores a docentes
        $('#asignar-revisores').on('click', function () {
            cargarContenido("<?php echo e(route('admin.revisiones.index')); ?>");
        });
    });
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('adminlte::page', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\portafolio3\resources\views/admin/dashboard.blade.php ENDPATH**/ ?>