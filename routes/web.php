<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Models\Prestamo;
use App\Models\Vehiculo;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PrestamoController;
use App\Http\Controllers\VehiculoController;

Route::get('/', function () {
    return view('welcome');
});

// --- AUTH ---
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/register', [AuthController::class, 'showRegister']);
Route::post('/register', [AuthController::class, 'register']);

// --- DASHBOARD POR ROL ---
Route::get('/administrador', function () {
    return view('administrador.index');
})->middleware(['auth', 'role:administrador'])
  ->name('administrador.index');

Route::get('/empleado', function () {
    $prestamos = Prestamo::with(['vehiculo', 'cliente'])->get(); // Trae los préstamos
    return view('empleado.index', compact('prestamos')); // Pasa la variable a la vista
})->middleware(['auth', 'role:empleado'])
  ->name('empleado.index');

Route::get('/cliente', function () {
    $vehiculos = Vehiculo::where('estado', 'disponible')->get();
    return view('cliente.index', compact('vehiculos'));
})->middleware(['auth', 'role:cliente'])
  ->name('cliente.index');


// --- RUTAS ADMIN ---
Route::middleware(['auth', 'role:administrador'])->group(function () {
    Route::resource('vehiculos', VehiculoController::class);
    // Usuarios
    Route::get('/index', [UserController::class, 'index'])->name('administrador.index');
    Route::get('/creacion_usu', [UserController::class, 'create'])->name('administrador.creacion_usu');
    Route::resource('personas', UserController::class); // CRUD usuarios

// Para crear roles (solo admin)
Route::middleware(['auth', 'role:administrador'])->group(function () {
    Route::get('/creacion_rol', [RoleController::class, 'create'])->name('roles.create');
    Route::post('/creacion_rol', [RoleController::class, 'store'])->name('roles.store');
});


    // Vehículos
    Route::resource('vehiculos', VehiculoController::class); // Admin puede crear, editar, eliminar vehículos
});

// --- RUTAS CLIENTE ---
Route::middleware(['auth', 'role:cliente'])->group(function () {
    Route::get('vehiculos', [VehiculoController::class, 'index'])->name('vehiculos.index');
    Route::get('vehiculos/{vehiculo}', [VehiculoController::class, 'show'])->name('vehiculos.show');

    // Solicitud de préstamo
    Route::get('prestamos/crear/{vehiculo}', [PrestamoController::class, 'create'])->name('prestamos.create');
    Route::post('prestamos', [PrestamoController::class, 'store'])->name('prestamos.store');
}); 

// --- RUTAS EMPLEADO ---
Route::middleware(['auth', 'role:empleado'])->group(function () {
    Route::get('prestamos', [PrestamoController::class, 'index'])->name('prestamos.index');
    Route::get('prestamos/{prestamo}', [PrestamoController::class, 'show'])->name('prestamos.show');

    // Aprobar o rechazar préstamo
    Route::post('prestamos/{prestamo}/aprobar', [PrestamoController::class, 'aprobar'])->name('prestamos.aprobar');
    Route::post('prestamos/{prestamo}/rechazar', [PrestamoController::class, 'rechazar'])->name('prestamos.rechazar');
});
