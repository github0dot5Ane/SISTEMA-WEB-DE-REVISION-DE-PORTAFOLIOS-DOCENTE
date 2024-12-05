@extends('admin.layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header bg-primary text-white">
            <h3>Detalles del Usuario</h3>
        </div>
        <div class="card-body">
            <p><strong>Nombre:</strong> {{ $user->name }}</p>
            <p><strong>Correo:</strong> {{ $user->email }}</p>
            <p><strong>Es Administrador:</strong> {{ $user->es_administrador ? 'Sí' : 'No' }}</p>
            <p><strong>Es Revisor:</strong> {{ $user->es_revisor ? 'Sí' : 'No' }}</p>
            <p><strong>Activo:</strong> {{ $user->activo ? 'Sí' : 'No' }}</p>
        </div>
        <div class="card-footer text-end">
            <a href="{{ route('admin.usuarios.index') }}" class="btn btn-secondary">Volver al listado</a>
        </div>
    </div>
</div>
@endsection
