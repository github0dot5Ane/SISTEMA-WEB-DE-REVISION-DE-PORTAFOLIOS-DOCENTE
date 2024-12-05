<?php if(auth()->user()->es_administrador): ?>
    <!-- Menú para Administrador -->
    <li class="nav-item">
        <a href="<?php echo e(route('admin.dashboard')); ?>" class="nav-link">
            <i class="nav-icon fas fa-user-shield"></i>
            <p>Administrador</p>
        </a>
    </li>
    <!-- Menú para Revisor -->
    <li class="nav-item">
        <a href="<?php echo e(route('revisor.dashboard')); ?>" class="nav-link">
            <i class="nav-icon fas fa-user-check"></i>
            <p>Revisor</p>
        </a>
    </li>
    <!-- Menú para Docente -->
    <li class="nav-item">
        <a href="<?php echo e(route('docente.dashboard')); ?>" class="nav-link">
            <i class="nav-icon fas fa-chalkboard-teacher"></i>
            <p>Docente</p>
        </a>
    </li>
<?php elseif(auth()->user()->es_revisor): ?>
    <!-- Menú para Revisor -->
    <li class="nav-item">
        <a href="<?php echo e(route('revisor.dashboard')); ?>" class="nav-link">
            <i class="nav-icon fas fa-user-check"></i>
            <p>Revisor</p>
        </a>
    </li>
    <!-- Menú para Docente -->
    <li class="nav-item">
        <a href="<?php echo e(route('docente.dashboard')); ?>" class="nav-link">
            <i class="nav-icon fas fa-chalkboard-teacher"></i>
            <p>Docente</p>
        </a>
    </li>
<?php elseif(auth()->user()->es_docente): ?>
    <!-- Menú para Docente -->
    <li class="nav-item">
        <a href="<?php echo e(route('docente.dashboard')); ?>" class="nav-link">
            <i class="nav-icon fas fa-chalkboard-teacher"></i>
            <p>Docente</p>
        </a>
    </li>
<?php endif; ?>
<?php /**PATH C:\laragon\www\portafolio3\resources\views/dashboard.blade.php ENDPATH**/ ?>