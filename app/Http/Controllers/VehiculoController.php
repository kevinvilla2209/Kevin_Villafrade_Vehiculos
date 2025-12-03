<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vehiculo;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class VehiculoController extends Controller
{
    public function __construct()
    {
        // Aplica middleware de autenticación
        $this->middleware('auth');
    }

    // Mostrar todos los vehículos
    public function index()
    {
        $user = Auth::user();

        if ($user->hasRole('cliente')) {
            $vehiculos = Vehiculo::where('estado', 'disponible')->get();
        } else {
            $vehiculos = Vehiculo::all();
        }

        return view('vehiculos.index', compact('vehiculos'));
    }

    // Formulario de creación (solo admin)
    public function create()
    {
        if (!Auth::user()->hasRole('administrador')) {
            abort(403, 'No autorizado.');
        }

        return view('vehiculos.create');
    }

    // Guardar vehículo nuevo (solo admin)
    public function store(Request $request)
    {
        if (!Auth::user()->hasRole('administrador')) {
            abort(403, 'No autorizado.');
        }

        $request->validate([
            'marca' => 'required|string|max:255',
            'modelo' => 'required|string|max:255',
            'anio' => 'required|digits:4|integer',
            'color' => 'required|string|max:50',
            'placa' => 'required|string|max:20|unique:vehiculos,placa',
            'estado' => 'nullable|in:disponible,prestado,mantenimiento',
        ]);

        Vehiculo::create([
            'marca' => $request->marca,
            'modelo' => $request->modelo,
            'anio' => $request->anio,
            'color' => $request->color,
            'placa' => $request->placa,
            'estado' => $request->estado ?? 'disponible',
        ]);

        return redirect()->route('vehiculos.index')->with('success', 'Vehículo creado correctamente.');
    }

    // Formulario de edición (solo admin)
    public function edit(Vehiculo $vehiculo)
    {
        if (!Auth::user()->hasRole('administrador')) {
            abort(403, 'No autorizado.');
        }

        return view('vehiculos.edit', compact('vehiculo'));
    }

    // Actualizar vehículo (solo admin)
    public function update(Request $request, Vehiculo $vehiculo)
    {
        if (!Auth::user()->hasRole('administrador')) {
            abort(403, 'No autorizado.');
        }

        $request->validate([
            'marca' => 'required|string|max:255',
            'modelo' => 'required|string|max:255',
            'anio' => 'required|digits:4|integer',
            'color' => 'required|string|max:50',
            'placa' => 'required|string|max:20|unique:vehiculos,placa,' . $vehiculo->id,
            'estado' => 'required|in:disponible,prestado,mantenimiento',
        ]);

        $vehiculo->update($request->all());

        return redirect()->route('vehiculos.index')->with('success', 'Vehículo actualizado correctamente.');
    }

    // Eliminar vehículo (solo admin)
    public function destroy(Vehiculo $vehiculo)
    {
        if (!Auth::user()->hasRole('administrador')) {
            abort(403, 'No autorizado.');
        }

        $vehiculo->delete();

        return redirect()->route('vehiculos.index')->with('success', 'Vehículo eliminado correctamente.');
    }
}
