<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Prestamo;
use App\Models\Vehiculo;
use Illuminate\Support\Facades\Auth;


class PrestamoController extends Controller
{
    // Mostrar todos los préstamos (empleado)
    public function index()
    {
        $prestamos = Prestamo::with(['vehiculo', 'cliente'])->orderBy('created_at', 'desc')->get();
        return view('prestamos.index', compact('prestamos'));
    }

    // Mostrar un préstamo específico (empleado)
    public function show(Prestamo $prestamo)
    {
        return view('prestamos.show', compact('prestamo'));
    }

    // Crear solicitud de préstamo (cliente)
    public function create(Vehiculo $vehiculo)
    {
        // Solo permitir vehículos disponibles
        if ($vehiculo->estado !== 'disponible') {
            return redirect()->route('vehiculos.index')
                             ->with('error', 'El vehículo no está disponible.');
        }

        return view('prestamos.create', compact('vehiculo'));
    }

    // Guardar solicitud de préstamo (cliente)
   public function store(Request $request)
{
    $request->validate([
        'vehiculo_id' => 'required|exists:vehiculos,id',
        'observaciones' => 'nullable|string|max:255',
    ]);

    \App\Models\Prestamo::create([
        'vehiculo_id' => $request->vehiculo_id,
        'usuario_id' => Auth::id(),
        'empleado_id' => null, // aún no hay empleado
        'estado' => 'pendiente',
        'observaciones' => $request->observaciones ?? 'ninguno',
    ]);

    return redirect()->route('cliente.index')->with('success', 'Solicitud de préstamo enviada correctamente.');
}


    // Aprobar préstamo (empleado)
    public function aprobar(Prestamo $prestamo)
{
    $prestamo->update([
        'estado' => 'aprobado',
        'empleado_id' => Auth::id(),
    ]);

    return redirect()->back()->with('success', 'Préstamo aprobado.');
}

public function rechazar(Prestamo $prestamo)
{
    $prestamo->update([
        'estado' => 'rechazado',
        'empleado_id' => Auth::id(),
    ]);

    return redirect()->back()->with('success', 'Préstamo rechazado.');
}
}

