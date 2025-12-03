<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container d-flex justify-content-center align-items-center min-vh-100">
    <div class="card shadow-lg p-4" style="width: 100%; max-width: 400px;">
        <h2 class="card-title text-center mb-4">Iniciar Sesión</h2>

        <form method="POST">
            @csrf

            <div class="mb-3">
                <label for="email" class="form-label">Correo</label>
                <input type="email" name="email" class="form-control" id="email" placeholder="Ingresa tu correo" required>
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Contraseña</label>
                <input type="password" name="password" class="form-control" id="password" placeholder="Ingresa tu contraseña" required>
            </div>

            <button type="submit" class="btn btn-primary w-100">Ingresar</button>
        </form>

        <p class="text-center text-muted mt-3 mb-0">
            ¿No tienes cuenta? <a href="/register" class="text-decoration-none">Regístrate</a>
        </p>
    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
