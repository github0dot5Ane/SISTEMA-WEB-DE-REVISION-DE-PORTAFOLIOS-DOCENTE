@extends('admin.layouts.app')

@section('title', 'Portafolios Pendientes de Revisión')

@section('content_header')
    <h1>Portafolios Pendientes de Revisión</h1>
@endsection

@section('content')
    <div class="card">
        <div class="card-body">
            @if ($portafoliosConDatos->isEmpty())
                <p>No hay portafolios pendientes de revisión.</p>
            @else
                <table>
                    <thead>
                        <tr>
                            <th>Docente</th>
                            <th>Curso</th>
                            <th>Estado</th>
                            <th>Fecha de Actualización</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($portafoliosConDatos as $portafolio)
                            <tr>
                                <td>{{ $portafolio['nombre_usuario'] }}</td>
                                <td>{{ $portafolio['id_curso'] }}</td>
                                <td>{{ $portafolio['estado'] }}</td>
                                <td>{{ $portafolio['updated_at'] }}</td>
                                <td>
                                    <button class="btn btn-primary" onclick="mostrarFormulario('general', {{ $portafolio['id'] }}, '{{ $portafolio['tipo_curso'] }}')">Editar Detalles Generales</button>
                                    <button class="btn btn-primary" onclick="mostrarFormulario('items', {{ $portafolio['id'] }}, '{{ $portafolio['tipo_curso'] }}')">Editar Ítems</button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="modalFormulario" tabindex="-1" aria-labelledby="modalFormularioLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalFormularioLabel">Formulario</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="modalContent">
                    <!-- Aquí se cargarán los formularios dinámicamente -->
                </div>
                
            </div>
        </div>
    </div>
@endsection

<script>
    function mostrarFormulario(tipo, idPortafolio, tipoCurso) {
        console.log(`Tipo: ${tipo}, idPortafolio: ${idPortafolio}, tipoCurso: ${tipoCurso}`);
        
        let url = '';
        let modalContent = document.getElementById('modalContent');
        
        // Si es 'general', redirigimos a la ruta para editar detalles generales
        if (tipo === 'general') {
            url = '{{ route("revisor.editar.detallesGenerales", ":id") }}'.replace(':id', idPortafolio);
            fetch(url)
                .then(response => response.text())
                .then(html => {
                    modalContent.innerHTML = html;
                    $('#modalFormulario').modal('show');
                });
        } 
        // Si es 'items', redirigimos a la ruta para editar los ítems según el tipo de curso
        else if (tipo === 'items') {
            if (parseInt(tipoCurso) === 1) { // Teórico
                url = '{{ route("revisor.editar.itemsTeorico", ":id") }}'.replace(':id', idPortafolio);
            } else if (parseInt(tipoCurso) === 0) { // Práctico
                url = '{{ route("revisor.editar.itemsPractico", ":id") }}'.replace(':id', idPortafolio);
            }

            if (url !== '') {
                fetch(url)
                    .then(response => response.text())
                    .then(html => {
                        modalContent.innerHTML = html;
                        $('#modalFormulario').modal('show');
                    });
            } else {
                console.error("No se pudo determinar el tipo de curso.");
            }
        }
    }
</script>
