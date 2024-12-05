@if(auth()->user()->es_administrador)
    <!-- Menú para Administrador -->
    <li class="nav-item">
        <a href="{{ route('admin.dashboard') }}" class="nav-link">
            <i class="nav-icon fas fa-user-shield"></i>
            <p>Administrador</p>
        </a>
    </li>
    <!-- Menú para Revisor -->
    <li class="nav-item">
        <a href="{{ route('revisor.dashboard') }}" class="nav-link">
            <i class="nav-icon fas fa-user-check"></i>
            <p>Revisor</p>
        </a>
    </li>
    <!-- Menú para Docente -->
    <li class="nav-item">
        <a href="{{ route('docente.dashboard') }}" class="nav-link">
            <i class="nav-icon fas fa-chalkboard-teacher"></i>
            <p>Docente</p>
        </a>
    </li>
@elseif(auth()->user()->es_revisor)
    <!-- Menú para Revisor -->
    <li class="nav-item">
        <a href="{{ route('revisor.dashboard') }}" class="nav-link">
            <i class="nav-icon fas fa-user-check"></i>
            <p>Revisor</p>
        </a>
    </li>
    <!-- Menú para Docente -->
    <li class="nav-item">
        <a href="{{ route('docente.dashboard') }}" class="nav-link">
            <i class="nav-icon fas fa-chalkboard-teacher"></i>
            <p>Docente</p>
        </a>
    </li>
@elseif(auth()->user()->es_docente)
    <!-- Menú para Docente -->
    <li class="nav-item">
        <a href="{{ route('docente.dashboard') }}" class="nav-link">
            <i class="nav-icon fas fa-chalkboard-teacher"></i>
            <p>Docente</p>
        </a>
    </li>
@endif
