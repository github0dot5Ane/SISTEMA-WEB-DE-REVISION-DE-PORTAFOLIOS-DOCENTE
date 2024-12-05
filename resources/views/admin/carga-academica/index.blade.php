<!-- resources/views/admin/carga-academica/table.blade.php -->
<table class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>ID</th>
            <th>Docente</th>
            <th>Curso</th>
            <th>Nro Créditos</th>
            <th>Es Teórico</th>
            <th>Malla</th>
            <th>Semestre</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($cargaAcademica as $carga)
            <tr>
                <td>{{ $carga->id_carga }}</td>
                <td>{{ $carga->usuario->name ?? 'No asignado' }}</td>
                <td>{{ $carga->id_curso }}</td>
                <td>{{ $carga->nro_creditos }}</td>
                <td>{{ $carga->es_teorico ? 'Sí' : 'No' }}</td>
                <td>{{ $carga->id_malla }}</td>
                <td>{{ $carga->id_semestre }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
