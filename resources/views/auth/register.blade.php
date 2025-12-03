<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container d-flex justify-content-center align-items-center min-vh-100">
    <div class="card shadow-lg p-4" style="width: 100%; max-width: 450px;">
        <h2 class="card-title text-center mb-4">Registro</h2>

        <form method="POST">
            @csrf

            <div class="mb-3">
                <label for="name" class="form-label">Nombre</label>
                <input type="text" name="name" id="name" class="form-control" placeholder="Ingresa tu nombre" required>
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Correo</label>
                <input type="email" name="email" id="email" class="form-control" placeholder="Ingresa tu correo" required>
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Contraseña</label>
                <input type="password" name="password" id="password" class="form-control" placeholder="Ingresa tu contraseña" required>
            </div>

            <div class="mb-3">
                <label for="password_confirmation" class="form-label">Confirmar Contraseña</label>
                <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" placeholder="Confirma tu contraseña" required>
            </div>

            <div class="mb-3">
                <label for="role_id" class="form-label">Rol</label>
                <select name="role_id" id="role_id" class="form-select" required>
                    <option value="" disabled selected>Selecciona un rol</option>
                    @foreach(\App\Models\Role::all() as $role)
                        <option value="{{ $role->id }}">{{ ucfirst($role->name) }}</option>
                    @endforeach
                </select>
            </div>

            <button type="submit" class="btn btn-success w-100">Registrar</button>
        </form>

        <p class="text-center text-muted mt-3 mb-0">
            ¿Ya tienes cuenta? <a href="/login" class="text-decoration-none">Inicia sesión</a>
        </p>
    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
