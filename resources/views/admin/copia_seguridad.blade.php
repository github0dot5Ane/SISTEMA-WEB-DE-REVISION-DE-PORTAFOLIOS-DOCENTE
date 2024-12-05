@extends('admin.layouts.app')

@section('content')
<div class="container">
    <h1>Generar Copia de Seguridad</h1>

    <div class="card">
        <div class="card-body">
            @if(session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif

            <form action="{{ route('admin.generar-copia') }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-primary">Generar Copia de Seguridad</button>
            </form>
        </div>
    </div>
</div>
@endsection
