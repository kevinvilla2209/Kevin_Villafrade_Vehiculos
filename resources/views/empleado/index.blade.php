@extends('empleado.layout') 

@section('title', 'Index Empleado')

@section('content')
    <h1 style="text-align:center; margin-bottom: 20px;">Solicitudes de préstamos</h1>

    @if($prestamos->isEmpty())
        <p style="text-align:center; color: #555;">No hay solicitudes de préstamos por el momento.</p>
    @endif

    @foreach($prestamos as $prestamo)
        <div style="border: 1px solid #ccc; padding: 15px; margin-bottom: 15px; border-radius: 8px; background-color: #f9f9f9;">
            <p>
                <strong>Vehículo:</strong> {{ $prestamo->vehiculo->marca }} - {{ $prestamo->vehiculo->modelo }}<br>
                <strong>Cliente:</strong> {{ $prestamo->cliente->name }}<br>
                <strong>Estado:</strong> 
                @if($prestamo->estado === 'pendiente')
                    <span style="color: orange; font-weight: bold;">Pendiente</span>
                @elseif($prestamo->estado === 'activo')
                    <span style="color: green; font-weight: bold;">Aprobado</span>
                @elseif($prestamo->estado === 'cancelado')
                    <span style="color: red; font-weight: bold;">Rechazado</span>
                @else
                    <span>{{ ucfirst($prestamo->estado) }}</span>
                @endif
            </p>

            @if($prestamo->estado === 'pendiente')
                <form action="{{ route('prestamos.aprobar', $prestamo) }}" method="POST" style="display: inline-block; margin-right: 10px;">
                    @csrf
                    <button type="submit" style="padding: 5px 15px; background-color: green; color: white; border: none; border-radius: 4px; cursor: pointer;">Aprobar</button>
                </form>
                <form action="{{ route('prestamos.rechazar', $prestamo) }}" method="POST" style="display: inline-block;">
                    @csrf
                    <button type="submit" style="padding: 5px 15px; background-color: red; color: white; border: none; border-radius: 4px; cursor: pointer;">Rechazar</button>
                </form>
            @endif
        </div>
    @endforeach
@endsection
