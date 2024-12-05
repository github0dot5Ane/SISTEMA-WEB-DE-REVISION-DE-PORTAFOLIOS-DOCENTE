@extends('admin.layouts.app')

@section('title', 'Revisiones')

@section('content_header')
    <h1>Revisiones del Revisor</h1>
@endsection

@section('content')
    <div class="container">
        @foreach($datosRevisiones as $dato)
            <div class="card mb-3">
                <div class="card-header">
                    <h4>Revisión de: {{ $dato['nombre_usuario'] }}</h4>
                    <p>Curso: {{ $dato['nombre_curso'] }}</p>
                </div>
                <div class="card-body">
                    <p><strong>Comentarios actuales:</strong></p>
                    <p>{{ $dato['revision']->comentarios ?? 'Sin comentarios' }}</p>

                    <form action="{{ route('revisor.guardar_observacion', $dato['revision']->id) }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="comentarios">Ingresar Observación:</label>
                            <textarea name="comentarios" id="comentarios" class="form-control" rows="3"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Guardar Observación</button>
                    </form>
                </div>
            </div>
        @endforeach
    </div>
@endsection
