@extends('vehiculos.layout')

@section('title', 'Editar Vehículo')


@section('extra-buttons')
    <a href="{{ route('vehiculos.index') }}" class="btn btn-light btn-sm">Volver</a>
@endsection


@section('content')
<div class="container mt-4">
    <h2>Editar Vehículo</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                  <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('vehiculos.update', $vehiculo) }}" method="POST">
        @csrf
        @method('PUT')
        @include('vehiculos.form', ['vehiculo' => $vehiculo])
        <button type="submit" class="btn btn-success">Actualizar Vehículo</button>
    </form>
</div>
@endsection
