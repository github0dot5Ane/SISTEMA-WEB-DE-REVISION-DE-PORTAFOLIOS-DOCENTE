@extends('admin.layouts.app')

@section('content')
<div class="container mt-4">
    <h1 class="mb-4">Registro de Actividades de Revisión</h1>

    <div class="card">
        <div class="card-body">
            @if ($revisiones->isEmpty())
                <p class="alert alert-warning">No hay registros de revisiones.</p>
            @else
                <div class="table-responsive">
                    <table class="table table-striped table-bordered">
                        <thead class="thead-dark">
                            <tr>
                                <th>Docente</th>
                                <th>Nombre del Revisor</th>
                                <th>Fecha de Revisión</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($revisiones as $revision)
                                <tr>
                                    <td>{{ $revision->usuario_name }}</td>
                                    <td>{{ $revision->revisor_name }}</td>
                                    <td>{{ \Carbon\Carbon::parse($revision->updated_at)->format('d-m-Y H:i') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                
            @endif
        </div>
    </div>
</div>
@endsection
