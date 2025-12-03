<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Role;

class RoleController extends Controller
{
    public function create()
    {
        // Retorna la vista para crear un rol
        return view('administrador.creacion_rol');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:50|unique:roles,name',
        ]);

        Role::create([
            'name' => $request->name,
        ]);

        return redirect()->route('roles.create')->with('success', 'Rol creado correctamente.');
    }
}
