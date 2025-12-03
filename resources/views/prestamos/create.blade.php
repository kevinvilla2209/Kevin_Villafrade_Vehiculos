@extends('cliente.layout')

@section('title', 'Solicitar préstamo')

@section('extra-buttons')
    <a href="{{ route('cliente.index') }}" class="btn btn-light btn-sm">Volver</a>
@endsection

@section('content')
    <h1 class="mb-4">Solicitar préstamo del vehículo</h1>

    <div class="card mb-4">
        <div class="card-body">
            <p><strong>Marca:</strong> {{ $vehiculo->marca }}</p>
            <p><strong>Modelo:</strong> {{ $vehiculo->modelo }}</p>
            <p><strong>Año:</strong> {{ $vehiculo->anio }}</p>
            <p><strong>Color:</strong> {{ $vehiculo->color }}</p>
        </div>
    </div>

    <form action="{{ route('prestamos.store') }}" method="POST" class="w-100" style="max-width: 500px;">
        @csrf
        <input type="hidden" name="vehiculo_id" value="{{ $vehiculo->id }}">

        <div class="mb-3">
            <label for="observaciones" class="form-label">Observaciones (opcional):</label>
            <textarea name="observaciones" id="observaciones" rows="4" class="form-control" placeholder="Escribe aquí cualquier comentario..."></textarea>
        </div>

        <button type="submit" class="btn btn-primary">Enviar solicitud</button>
    </form>
@endsection
