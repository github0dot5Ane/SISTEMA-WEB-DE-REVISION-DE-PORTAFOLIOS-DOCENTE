@extends('adminlte::page')

@section('title', 'Dashboard Docente')

@section('content_header')
    <h1>Panel del Docente</h1>
@endsection

@section('content')
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
@endsection

@section('js')
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
            cargarContenido("{{ route('docente.visualizar_estado') }}");
        });
    });
</script>
@endsection
