@extends('admin.layouts.app')

@section('title', 'Visualizar Estado')

@section('content_header')
    <h1>Visualizar Estado de los Portafolios</h1>
@endsection

@section('content')
    <div class="container">
        <!-- Mostrar mensaje de éxito o error -->
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @elseif(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        @if(isset($mensaje))
            <div class="alert alert-info">
                {{ $mensaje }}
            </div>
        @endif

        @foreach($datosPortafolios as $dato)
            <div class="card mb-3">
                <div class="card-header">
                    <h4>Curso: {{ $dato['nombre_curso'] }}</h4>
                </div>
                <div class="card-body">
                    <p><strong>Estado de la Revisión:</strong> {{ $dato['estado_revision'] }}</p>
                    <p><strong>Comentarios:</strong> {{ $dato['comentarios'] }}</p>

                    @if($dato['estado_revision'] == 'Corregir')
                        <!-- Mostrar botón si el estado es 'Corregir' -->
                        <form action="{{ route('docente.cambiar_estado', $dato['id_portafolio']) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-success">Corregido</button>
                        </form>
                    @endif
                </div>
            </div>
        @endforeach
    </div>
@endsection
