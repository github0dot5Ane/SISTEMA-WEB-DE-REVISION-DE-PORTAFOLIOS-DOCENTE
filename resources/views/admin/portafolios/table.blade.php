<table class="table table-bordered">
    <thead>
        <tr>
            <th>ID</th>
            <th>Usuario</th>
            <th>Carga Académica</th>
            <th>Fecha de Subida</th>
            <th>Estado</th>
            <th>Semestre</th>
            <th>Carátula</th>
            <th>Carga Lectiva</th>
            <th>Filosofía</th>
            <th>CV</th>
            <th>Sílabo</th>
            <th>Tipo de Curso</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        @forelse($portafolios as $portafolio)
            <tr>
                <td>{{ $portafolio->id }}</td>
                <td>{{ $portafolio->usuario->name ?? 'No asignado' }}</td>
                <td>{{ $portafolio->carga->nombre ?? 'No asignado' }}</td>
                <td>{{ $portafolio->fecha_subida }}</td>
                <td>
                    <span class="badge 
                        @if($portafolio->estado == 'Pendiente') badge-warning 
                        @elseif($portafolio->estado == 'Revisado') badge-success 
                        @else badge-danger 
                        @endif">
                        {{ $portafolio->estado }}
                    </span>
                </td>
                <td>{{ $portafolio->semestre->nombre ?? 'No asignado' }}</td>
                <td>{{ $portafolio->caratula ? 'Sí' : 'No' }}</td>
                <td>{{ $portafolio->carga_lectiva ? 'Sí' : 'No' }}</td>
                <td>{{ $portafolio->filosofia ? 'Sí' : 'No' }}</td>
                <td>{{ $portafolio->cv ? 'Sí' : 'No' }}</td>
                <td>{{ $portafolio->silabo ? 'Sí' : 'No' }}</td>
                <td>{{ $portafolio->tipo_curso ? 'Teórico' : 'Práctico' }}</td>
                
            </tr>
        @empty
            <tr>
                <td colspan="13" class="text-center">No hay portafolios registrados.</td>
            </tr>
        @endforelse
    </tbody>
</table>
