<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Panel')</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- CSS personalizado -->
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
</head>
<body>
    <header class="bg-dark text-white p-3 text-center">
        <h1>Usted es Cliente</h1>
    </header>

    <nav class="bg-secondary p-2 text-center mb-4">
        <a href="{{ route('logout') }}" class="btn btn-light btn-sm"
           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
           Cerrar sesión
        </a>

        
        <!-- Sección opcional para botones adicionales en el header -->
        @hasSection('extra-buttons')
            @yield('extra-buttons')
        @endif
    </nav>

    <main class="container">
        @yield('content') <!-- Aquí se cargará el contenido específico de cada vista -->
    </main>

    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display:none;">
        @csrf
    </form>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>