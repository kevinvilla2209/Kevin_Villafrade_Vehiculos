@extends('vehiculos.layout')

@section('title', 'Crear Vehículo')

@section('extra-buttons')
    <a href="{{ route('vehiculos.index') }}" class="btn btn-light btn-sm">Volver</a>
@endsection


@section('content')
<div class="container mt-4">
    <h2>Crear Vehículo</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                  <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('vehiculos.store') }}" method="POST">
        @csrf
        @include('vehiculos.form')
        <button type="submit" class="btn btn-primary">Crear Vehículo</button>
    </form>
</div>
@endsection
