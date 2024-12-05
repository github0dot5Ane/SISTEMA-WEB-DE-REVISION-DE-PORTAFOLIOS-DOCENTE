@extends('admin.layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header bg-warning text-white">
            <h3>Editar Usuario</h3>
        </div>
        <form action="{{ route('admin.usuarios.update', $user->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="card-body">
                <div class="mb-3">
                    <label for="name" class="form-label">Nombre</label>
                    <input type="text" id="name" name="name" class="form-control" value="{{ $user->name }}" required>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Correo</label>
                    <input type="email" id="email" name="email" class="form-control" value="{{ $user->email }}" required>
                </div>
                <div class="mb-3 form-check">
                    <input type="checkbox" id="es_administrador" name="es_administrador" class="form-check-input" {{ $user->es_administrador ? 'checked' : '' }}>
                    <label for="es_administrador" class="form-check-label">Es Administrador</label>
                </div>
                <div class="mb-3 form-check">
                    <input type="checkbox" id="es_revisor" name="es_revisor" class="form-check-input" {{ $user->es_revisor ? 'checked' : '' }}>
                    <label for="es_revisor" class="form-check-label">Es Revisor</label>
                </div>
                <div class="mb-3 form-check">
                    <input type="checkbox" id="activo" name="activo" class="form-check-input" {{ $user->activo ? 'checked' : '' }}>
                    <label for="activo" class="form-check-label">Activo</label>
                </div>
            </div>
            <div class="card-footer text-end">
                <button type="submit" class="btn btn-success">Guardar cambios</button>
                <a href="{{ route('admin.usuarios.index') }}" class="btn btn-secondary">Cancelar</a>
            </div>
        </form>
    </div>
</div>
@endsection
