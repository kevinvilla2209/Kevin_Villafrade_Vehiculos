@extends('administrador.layout')

@section('title', 'Crear Rol')

@section('extra-buttons')
    <a href="{{ route('administrador.index') }}" class="btn btn-light btn-sm">Volver</a>
@endsection

@section('content')
<div class="container">
    <h2>Crear Rol</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('roles.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Nombre del Rol</label>
            <input type="text" name="name" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary">Crear Rol</button>
    </form>
</div>
@endsection
