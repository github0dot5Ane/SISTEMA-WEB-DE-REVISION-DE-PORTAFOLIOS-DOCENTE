@extends('adminlte::page')

@section('title', 'Ingresar Observaciones')

@section('content_header')
    <h1>Ingresar Observaciones</h1>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            @foreach($data as $item)
                <div class="card mb-4">
                    <div class="card-header">
                        <h4>Revisión del portafolio de {{ $item['usuario'] }} - Curso: {{ $item['curso'] }}</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('revisor.guardar_observacion', $item['revision']->id) }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="comentarios">Observación:</label>
                                <textarea name="comentarios" id="comentarios" class="form-control" rows="5">{{ $item['revision']->comentarios }}</textarea>
                            </div>
                            <button type="submit" class="btn btn-primary mt-3">Guardar Observación</button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
