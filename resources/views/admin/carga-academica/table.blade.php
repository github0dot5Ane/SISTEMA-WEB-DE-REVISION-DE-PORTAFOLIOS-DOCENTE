<table class="table table-bordered">
    <thead>
        <tr>
            <th>ID Curso</th>
            <th>Usuario</th>
            <th>Nro Créditos</th>
            <th>Teórico</th>
        </tr>
    </thead>
    <tbody>
        @forelse($tabla as $fila)
            <tr>
                <td>{{ $fila->id_curso }}</td>
                <td>{{ $fila->usuario->name }}</td>
                <td>{{ $fila->nro_creditos }}</td>
                <td>{{ $fila->es_teorico ? 'Sí' : 'No' }}</td>
            </tr>
        @empty
            <tr>
                <td colspan="4">No hay datos disponibles.</td>
            </tr>
        @endforelse
    </tbody>
</table>
