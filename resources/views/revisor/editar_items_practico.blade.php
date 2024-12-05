@extends('admin.layouts.app')

@section('title', 'Editar Ítems Prácticos')

@section('content_header')
    <h1>Editar Ítems Prácticos del Portafolio: {{ $portafolio->id }}</h1>
@endsection

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('revisor.guardar.itemsPractico', $portafolio->id) }}" method="POST">
                @csrf

                <!-- Avance Académico -->
                <input type="hidden" name="avance_academico" value="0"> <!-- Valor oculto por defecto -->
                <div class="mb-3 form-check">
                    <input type="checkbox" name="avance_academico" id="avance_academico" class="form-check-input" value="1" {{ old('avance_academico', $itemsTeorico->avance_academico ?? false) ? 'checked' : '' }}>
                    <label for="avance_academico" class="form-check-label">Avance Académico</label>
                </div>


                <!-- Evidencia de Actividades -->
                <input type="hidden" name="evidencia_actividades" value="0">
                <div class="mb-3 form-check">
                    <input type="checkbox" name="evidencia_actividades" id="evidencia_actividades" class="form-check-input" value="1" {{ old('evidencia_actividades', $itemsTeorico->evidencia_actividades ?? false) ? 'checked' : '' }}>
                    <label for="evidencia_actividades" class="form-check-label">Evidencia de Actividades</label>
                </div>

                <!-- Registro de Asistencia 1P -->
                <input type="hidden" name="registro_asistencia_1P" value="0">
                <div class="mb-3 form-check">
                    <input type="checkbox" name="registro_asistencia_1P" id="registro_asistencia_1P" class="form-check-input" value="1" {{ old('registro_asistencia_1P', $itemsTeorico->registro_asistencia_1P ?? false) ? 'checked' : '' }}>
                    <label for="registro_asistencia_1P" class="form-check-label">Registro de Asistencia 1P</label>
                </div>

                <!-- Registro de Notas 1P -->
                <input type="hidden" name="registro_notas_1P" value="0">
                <div class="mb-3 form-check">
                    <input type="checkbox" name="registro_notas_1P" id="registro_notas_1P" class="form-check-input" value="1" {{ old('registro_notas_1P', $itemsTeorico->registro_notas_1P ?? false) ? 'checked' : '' }}>
                    <label for="registro_notas_1P" class="form-check-label">Registro de Notas 1P</label>
                </div>

                <!-- Registro de Asistencia 2P -->
                <input type="hidden" name="registro_asistencia_2P" value="0">
                <div class="mb-3 form-check">
                    <input type="checkbox" name="registro_asistencia_2P" id="registro_asistencia_2P" class="form-check-input" value="1" {{ old('registro_asistencia_2P', $itemsTeorico->registro_asistencia_2P ?? false) ? 'checked' : '' }}>
                    <label for="registro_asistencia_2P" class="form-check-label">Registro de Asistencia 2P</label>
                </div>

                <!-- Registro de Notas 2P -->
                <input type="hidden" name="registro_notas_2P" value="0">
                <div class="mb-3 form-check">
                    <input type="checkbox" name="registro_notas_2P" id="registro_notas_2P" class="form-check-input" value="1" {{ old('registro_notas_2P', $itemsTeorico->registro_notas_2P ?? false) ? 'checked' : '' }}>
                    <label for="registro_notas_2P" class="form-check-label">Registro de Notas 2P</label>
                </div>

                <!-- Registro de Asistencia 3P -->
                <input type="hidden" name="registro_asistencia_3P" value="0">
                <div class="mb-3 form-check">
                    <input type="checkbox" name="registro_asistencia_3P" id="registro_asistencia_3P" class="form-check-input" value="1" {{ old('registro_asistencia_3P', $itemsTeorico->registro_asistencia_3P ?? false) ? 'checked' : '' }}>
                    <label for="registro_asistencia_3P" class="form-check-label">Registro de Asistencia 3P</label>
                </div>

                <!-- Registro de Notas 3P -->
                <input type="hidden" name="registro_notas_3P" value="0">
                <div class="mb-3 form-check">
                    <input type="checkbox" name="registro_notas_3P" id="registro_notas_3P" class="form-check-input" value="1" {{ old('registro_notas_3P', $itemsTeorico->registro_notas_3P ?? false) ? 'checked' : '' }}>
                    <label for="registro_notas_3P" class="form-check-label">Registro de Notas 3P</label>
                </div>

                <!-- Cierre del Portafolio -->
                <input type="hidden" name="cierre_portafolio" value="0">
                <div class="mb-3 form-check">
                    <input type="checkbox" name="cierre_portafolio" id="cierre_portafolio" class="form-check-input" value="1" {{ old('cierre_portafolio', $itemsTeorico->cierre_portafolio ?? false) ? 'checked' : '' }}>
                    <label for="cierre_portafolio" class="form-check-label">Cierre del Portafolio</label>
                </div>
                <button type="submit" class="btn btn-success">Guardar Cambios</button>
            </form>
        </div>
    </div>
@endsection
