@extends('admin.layouts.app')

@section('content')
<div class="container">
    <h2>Lista de Revisiones</h2>

    <!-- Mostrar mensaje de éxito si existe -->
    <div id="message" style="display: none;" class="alert"></div>

    <table class="table">
        <thead>
            <tr>
                <th>Docente</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($revisiones as $revision)
            <tr>
                <td>{{ $revision->usuario_name }}</td>
                <td>
                    <form action="{{ route('admin.revisiones.asignar', $revision->id) }}" method="POST" class="assign-revisor-form" data-id="{{ $revision->id }}">
                        @csrf
                        <select name="revisor_id" class="form-control">
                            <option value="">Seleccione un revisor</option>
                            @foreach($usuarios as $usuario)
                                <option value="{{ $usuario->id }}">{{ $usuario->name }}</option>
                            @endforeach
                        </select>
                        <button type="submit" class="btn btn-primary mt-2">Asignar Revisor</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<!-- Incluir jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    $(document).ready(function() {
        $('.assign-revisor-form').on('submit', function(event) {
            event.preventDefault(); // Evitar el envío del formulario

            var form = $(this);
            var revisor_id = form.find('select[name="revisor_id"]').val();
            var revision_id = form.data('id');

            $.ajax({
                url: "{{ route('admin.revisiones.asignar', ':id') }}".replace(':id', revision_id),
                type: 'POST',
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content'),
                    revisor_id: revisor_id
                },
                success: function(response) {
                    // Si la asignación es exitosa, mostrar mensaje
                    $('#message').removeClass('alert-danger').addClass('alert-success').text(response.success).show();
                },
                error: function(xhr) {
                    // Si ocurre un error, mostrar el mensaje de error
                    var errorMessage = xhr.responseJSON.error || 'Error desconocido';
                    $('#message').removeClass('alert-success').addClass('alert-danger').text(errorMessage).show();
                }
            });
        });
    });
</script>
@endsection
