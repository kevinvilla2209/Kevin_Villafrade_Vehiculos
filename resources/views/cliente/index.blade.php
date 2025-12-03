@extends('cliente.layout')

@section('title', 'Vehículos disponibles')

@section('content')
    <h1>Vehículos disponibles</h1>

    @if($vehiculos->isEmpty())
        <p>No hay vehículos disponibles por el momento.</p>
    @endif

    @foreach($vehiculos as $vehiculo)
        <div style="border: 1px solid #ccc; padding: 10px; margin-bottom: 10px;">
            <p><strong>Marca:</strong> {{ $vehiculo->marca }}</p>
            <p><strong>Modelo:</strong> {{ $vehiculo->modelo }}</p>
            <p><strong>Año:</strong> {{ $vehiculo->anio }}</p>
            <p><strong>Color:</strong> {{ $vehiculo->color }}</p>
            <p><strong>Estado:</strong> {{ $vehiculo->estado }}</p>

            @if($vehiculo->estado === 'disponible')
                <a href="{{ route('prestamos.create', $vehiculo) }}">
                    <button>Solicitar préstamo</button>
                </a>
            @endif
        </div>
    @endforeach
@endsection