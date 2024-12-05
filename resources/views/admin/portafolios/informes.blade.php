@extends('admin.layouts.app')

@section('title', 'Generar Informes')

@section('content_header')
    <h1>Informes de Portafolios</h1>
@endsection

@section('content')
    <div class="mt-3">
        <a href="{{ route('admin.generar-informes-pdf') }}" class="btn btn-primary">Descargar Excel</a>
    </div>
    <div class="table-responsive">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Nombre del Docente</th>
                    <th>Curso</th>
                    <th>Nombre del Revisor</th>
                    <th>Resultado</th>
                    <th>Comentarios</th>
                    <th>Última Actualización</th>
                </tr>
            </thead>
            <tbody>
                @foreach($portafoliosConDatos as $portafolio)
                    <tr>
                        <td>{{ $portafolio['nombre_docente'] }}</td>
                        <td>{{ $portafolio['curso'] }}</td>
                        <td>{{ $portafolio['nombre_revisor'] }}</td>
                        <td>{{ $portafolio['resultado'] }}</td>
                        <td>{{ $portafolio['comentarios'] ?? 'No Comments' }}</td>
                        <td>
                            @php
                                $date = \Carbon\Carbon::createFromFormat('d-m-Y H:i', $portafolio['updated_at'] ?? null);
                            @endphp
                            {{ $date ? $date->format('d/m/Y H:i') : 'No Date Available' }}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    
@endsection
