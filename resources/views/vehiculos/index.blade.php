@extends('vehiculos.layout')

@section('title', 'Listado de Vehículos')

@section('extra-buttons')
    <a href="{{ route('administrador.index') }}" class="btn btn-light btn-sm">Volver</a>
@endsection

@section('content')
<div class="container">
    <h2>Vehículos</h2>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if (Auth::user()->hasRole('administrador'))
        <a href="{{ route('vehiculos.create') }}" class="btn btn-success mb-3">Agregar Vehículo</a>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Marca</th>
                <th>Modelo</th>
                <th>Año</th>
                <th>Color</th>
                <th>Placa</th>
                <th>Estado</th>
                @if (Auth::user()->hasRole('administrador'))
                    <th>Acciones</th>
                @endif
            </tr>
        </thead>
        <tbody>
            @foreach ($vehiculos as $vehiculo)
                <tr>
                    <td>{{ $vehiculo->marca }}</td>
                    <td>{{ $vehiculo->modelo }}</td>
                    <td>{{ $vehiculo->anio }}</td>
                    <td>{{ $vehiculo->color }}</td>
                    <td>{{ $vehiculo->placa }}</td>
                    <td>{{ ucfirst($vehiculo->estado) }}</td>
                    @if (Auth::user()->hasRole('administrador'))
                        <td>
                            <a href="{{ route('vehiculos.edit', $vehiculo->id) }}" class="btn btn-primary btn-sm">Editar</a>
                            <form action="{{ route('vehiculos.destroy', $vehiculo->id) }}" method="POST" style="display:inline-block">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm"
                                    onclick="return confirm('¿Eliminar vehículo?')">Eliminar</button>
                            </form>
                        </td>
                    @endif
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
