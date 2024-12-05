@extends('admin.layouts.app')

@section('title', 'Editar Detalles Generales')

@section('content_header')
    <h1>Editar Detalles Generales del Portafolio: {{ $portafolio->id }}</h1>
@endsection

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('revisor.guardar.detallesGenerales', $portafolio->id) }}" method="POST">
                @csrf

                <!-- Caratula -->
                <input type="hidden" name="caratula" value="0"> <!-- Valor oculto por defecto -->
                <div class="mb-3 form-check">
                    <input type="checkbox" name="caratula" id="caratula" class="form-check-input" value="1" {{ old('caratula', $portafolio->caratula ?? false) ? 'checked' : '' }}>
                    <label for="caratula" class="form-check-label">Caratula</label>
                </div>

                <!-- Carga Lectiva -->
                <input type="hidden" name="carga_lectiva" value="0"> <!-- Valor oculto por defecto -->
                <div class="mb-3 form-check">
                    <input type="checkbox" name="carga_lectiva" id="carga_lectiva" class="form-check-input" value="1" {{ old('carga_lectiva', $portafolio->carga_lectiva ?? false) ? 'checked' : '' }}>
                    <label for="carga_lectiva_check" class="form-check-label">Carga Lectiva Verificada</label>
                </div>

                <!-- Filosofía -->
                <input type="hidden" name="filosofia" value="0"> <!-- Valor oculto por defecto -->
                <div class="mb-3 form-check">
                    <input type="checkbox" name="filosofia" id="filosofia" class="form-check-input" value="1" {{ old('filosofia', $portafolio->filosofia ?? false) ? 'checked' : '' }}>
                    <label for="filosofia" class="form-check-label">Filosofía Incluida</label>
                </div>

                <!-- CV -->
                <input type="hidden" name="cv" value="0"> <!-- Valor oculto por defecto -->
                <div class="mb-3 form-check">
                    <input type="checkbox" name="cv" id="cv" class="form-check-input" value="1" {{ old('cv', $portafolio->cv ?? false) ? 'checked' : '' }}>
                    <label for="cv" class="form-check-label">CV Actualizado</label>
                </div>

                <!-- Silabo -->
                <input type="hidden" name="silabo" value="0"> <!-- Valor oculto por defecto -->
                <div class="mb-3 form-check">
                    <input type="checkbox" name="silabo" id="silabo" class="form-check-input" value="1" {{ old('silabo', $portafolio->silabo ?? false) ? 'checked' : '' }}>
                    <label for="silabo_check" class="form-check-label">Silabo Incluido</label>
                </div>

                <button type="submit" class="btn btn-success">Guardar Cambios</button>
            </form>
        </div>
    </div>
@endsection
