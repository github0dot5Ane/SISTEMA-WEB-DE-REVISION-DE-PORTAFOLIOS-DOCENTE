<form action="{{ route('revisor.guardar.revision', $portafolio->id) }}" method="POST">
    @csrf

    <h4>Detalles del Portafolio</h4>
    
    <div>
        <label>Carátula</label>
        <input type="checkbox" name="caratula" value="1" {{ $portafolio->caratula ? 'checked' : '' }}>
    </div>

    <div>
        <label>Carga Lectiva</label>
        <input type="checkbox" name="carga_lectiva" value="1" {{ $portafolio->carga_lectiva ? 'checked' : '' }}>
    </div>

    <div>
        <label>Filosofía</label>
        <input type="checkbox" name="filosofia" value="1" {{ $portafolio->filosofia ? 'checked' : '' }}>
    </div>

    <div>
        <label>CV</label>
        <input type="checkbox" name="cv" value="1" {{ $portafolio->cv ? 'checked' : '' }}>
    </div>

    <div>
        <label>Sílabo</label>
        <input type="checkbox" name="silabo" value="1" {{ $portafolio->silabo ? 'checked' : '' }}>
    </div>

    <div>
        <label>Tipo de Curso</label>
        <input type="checkbox" name="tipo_curso" value="1" {{ $portafolio->tipo_curso ? 'checked' : '' }}>
        <span>{{ $portafolio->tipo_curso ? 'Teórico' : 'Práctico' }}</span>
    </div>

    <h4>Ítems del Curso</h4>
    <table>
        <thead>
            <tr>
                <th>Ítem</th>
                <th>Estado</th>
            </tr>
        </thead>
        <tbody>
            @php
                $itemsTeorico = [
                    'avance_academico',
                    'registro_entrega_silabo',
                    'informe_examen_entrada',
                    'enunciado_y_solucion_exameN_1P',
                    'enunciado_y_solucion_exameN_2P',
                    'enunciado_y_solucion_exameN_3P',
                    'evidencia_actividades',
                    'registro_asistencia_1P',
                    'registro_asistencia_2P',
                    'registro_asistencia_3P',
                    'registro_notas_1P',
                    'registro_notas_2P',
                    'registro_notas_3P',
                    'cierre_portafolio',
                ];

                $itemsPractico = [
                    'avance_academico',
                    'evidencia_actividades',
                    'registro_asistencia_1P',
                    'registro_asistencia_2P',
                    'registro_asistencia_3P',
                    'registro_notas_1P',
                    'registro_notas_2P',
                    'registro_notas_3P',
                ];

                $items = $portafolio->tipo_curso ? $itemsTeorico : $itemsPractico;
            @endphp

            @foreach ($items as $item)
                <tr>
                    <td>{{ ucfirst(str_replace('_', ' ', $item)) }}</td>
                    <td>
                        <input 
                            type="checkbox" 
                            name="items[{{ $item }}]" 
                            value="1" 
                            {{ $portafolio->$item ? 'checked' : '' }}>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <button type="submit" class="btn btn-success">Guardar</button>
</form>
