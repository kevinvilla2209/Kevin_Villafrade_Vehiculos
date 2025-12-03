@extends('administrador.layout') 

@section('title', 'Index Administrador') 

@section('extra-buttons')
    <a href="{{ route('administrador.index') }}" class="btn btn-light btn-sm">Volver</a>
@endsection

@section('content')


<div class="container">

    <h2 class="mb-4">Gestión de Usuarios</h2>

    {{-- MENSAJES --}}
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    {{-- FORMULARIO CREAR / EDITAR --}}
    <div class="card mb-4">
        <div class="card-header">
            @isset($user)
                Editar Usuario
            @else
                Crear Nuevo Usuario
            @endisset
        </div>

        <div class="card-body">
            <form 
                action="@isset($user) {{ route('personas.update', $user->id) }} @else {{ route('personas.store') }} @endisset" 
                method="POST"
            >
                @csrf

                @isset($user)
                    @method('PUT')
                @endisset

                <div class="mb-3">
                    <label for="name" class="form-label">Nombre</label>
                    <input 
                        type="text" 
                        name="name" 
                        class="form-control" 
                        value="{{ $user->name ?? old('name') }}"
                        required
                    >
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">Correo</label>
                    <input 
                        type="email" 
                        name="email" 
                        class="form-control" 
                        value="{{ $user->email ?? old('email') }}"
                        required
                    >
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">
                        @isset($user)
                            Nueva Contraseña (opcional)
                        @else
                            Contraseña
                        @endisset
                    </label>
                    <input 
                        type="password" 
                        name="password" 
                        class="form-control"
                        @empty($user) required @endempty
                    >
                </div>

                <div class="mb-3">
                    <label for="role_id" class="form-label">Rol</label>
                    <select name="role_id" class="form-control" required>
                        <option value="">Seleccione un rol</option>
                        @foreach ($roles as $rol)
                            <option 
                                value="{{ $rol->id }}"
                                @if(isset($user) && $user->role_id == $rol->id) selected @endif
                            >
                                {{ $rol->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <button type="submit" class="btn btn-primary">
                    @isset($user)
                        Actualizar
                    @else
                        Crear
                    @endisset
                </button>

                @isset($user)
                    <a href="{{ route('administrador.creacion_usu') }}" class="btn btn-secondary">
                        Cancelar
                    </a>
                @endisset

            </form>
        </div>
    </div>

    {{-- TABLA DE USUARIOS --}}
    <div class="card">
        <div class="card-header">
            Lista de Usuarios
        </div>

        <div class="card-body">
            <table class="table table-striped">

                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Email</th>
                        <th>Rol</th>
                        <th>Acciones</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($users as $u)
                        <tr>
                            <td>{{ $u->id }}</td>
                            <td>{{ $u->name }}</td>
                            <td>{{ $u->email }}</td>
                            <td>{{ $u->role->name ?? 'Sin rol' }}</td>

                            <td>
                                <a href="{{ route('personas.edit', $u->id) }}" class="btn btn-warning btn-sm">
                                    Editar
                                </a>

                                <form action="{{ route('personas.destroy', $u->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')

                                    <button 
                                        type="submit" 
                                        class="btn btn-danger btn-sm"
                                        onclick="return confirm('¿Seguro que deseas eliminar este usuario?')"
                                    >
                                        Eliminar
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>

            </table>
        </div>
    </div>

</div>

@endsection