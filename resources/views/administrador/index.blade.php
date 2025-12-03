@extends('administrador.layout') 

@section('title', 'Index Administrador') 

@section('content')
<div class="card mb-3 p-3">
    <h2>Creación de usuarios</h2>
    <a href="{{ route('administrador.creacion_usu') }}" class="btn btn-primary btn-sm w-25 mb-2">Crear usuario</a>
    <p> Aquí podras crear, editar, actualizar o eliminar Usuarios </p>
</div>

<div class="card mb-3 p-3">
    <h2>Creación de roles</h2>
    <a href="{{ route('roles.create') }}" class="btn btn-success btn-sm w-25 mb-2">Crear rol</a>
    <p> Aquí podras crear, editar, actualizar o eliminar Roles </p>
</div>

<div class="card mb-3 p-3">
    <h2>Creación de Vehiculos</h2>
    <a href="{{ route('vehiculos.index') }}" class="btn btn-warning btn-sm w-25 mb-2">Crear Vehículo</a>
    <p> Aquí podras crear, editar, actualizar o eliminar Vehiculos </p>
</div>
@endsection