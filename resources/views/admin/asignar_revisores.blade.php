@extends('admin.layouts.app')

@section('title', 'Asignar Revisores')

@section('content_header')
    <h1>Asignar Revisores</h1>
@endsection

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Asignar Revisor a la Revisión</h3>
        </div>
        <div class="card-body">
            <!-- Contenedor para mensajes -->
            <div id="response-message" style="display:none;" class="alert"></div>

            <!-- Tabla de revisiones -->
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>ID Portafolio</th>
                        <th>Criterio</th>
                        <th>Resultado</th>
                        <th>Comentarios</th>
                        <th>Fecha de Revisión</th>
                        <th>Semestre</th>
                        <th>Revisor</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($revisiones as $revision)
                        <tr>
                            <td>{{ $revision->id_portafolio }}</td>
                            <td>{{ $revision->criterio }}</td>
                            <td>{{ $revision->resultado }}</td>
                            <td>{{ $revision->comentarios }}</td>
                            <td>{{ \Carbon\Carbon::parse($revision->fecha_revision)->format('d/m/Y') }}</td>
                            <td>{{ $revision->id_semestre }}</td>
                            <td>
                                <!-- Formulario de selección de revisor -->
                                <form class="asignar-revisor-form" data-revision-id="{{ $revision->id }}" method="POST">
                                    @csrf
                                    <div class="form-group">
                                        <select class="form-control revisor-select" name="id_revisor_usuario" required>
                                            <option value="">Selecciona un revisor</option>
                                            @foreach($usuariosRevisores as $usuario)
                                                <option value="{{ $usuario->id }}" 
                                                    {{ $usuario->id == $revision->id_usuario_revisor ? 'selected' : '' }}>
                                                    {{ $usuario->name }} ({{ $usuario->email }})
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Asignar</button>
                                </form>

                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection

@section('js')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function () {
    // Capturar evento de envío del formulario
    $(document).on('submit', '.asignar-revisor-form', function (e) {
        e.preventDefault(); // Evitar recarga de la página

        // Verificar si se captura correctamente el evento
        console.log("Evento submit capturado.");

        // Datos del formulario
        var form = $(this);
        var revisionId = form.data('revision-id');
        var revisorId = form.find('.revisor-select').val();

        // Verificar que se haya seleccionado un revisor
        if (!revisorId) {
            alert("Debe seleccionar un revisor.");
            return;
        }

        // Verificar que los datos se están capturando correctamente
        console.log("Datos capturados: ", {
            revisionId: revisionId,
            revisorId: revisorId
        });

        // Realizar la solicitud Ajax
        $.ajax({
            url: "{{ route('admin.asignar.revisor') }}", // Asegúrate de que esta URL sea correcta
            method: "POST",
            data: {
                revision_id: revisionId,
                id_revisor_usuario: revisorId,
                _token: "{{ csrf_token() }}"  // Incluye el token CSRF
            },
            success: function(response) {
                // Mostrar respuesta en consola para verificar que la solicitud fue exitosa
                console.log("Respuesta de Ajax: ", response);
                alert(response.success);
            },
            error: function(xhr) {
                // Mostrar cualquier error
                console.log("Error en Ajax: ", xhr);
                alert("Hubo un error al asignar el revisor.");
            }
        });
    });

</script>
@endsection
