<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    // 📌 Mostrar lista de usuarios
    public function index()
    {
        // Listado de usuarios con su rol
        $users = User::with('role')->get();

        // Listado de roles para el formulario
        $roles = Role::all();

        return view('administrador.creacion_usu', compact('users', 'roles'));
    }

    // 📌 Formulario de creación
    public function create()
    {
        $users = user::with('role')->get();
        $roles = Role::all();
        return view('administrador.creacion_usu', compact('users','roles'));
    }

    // 📌 Guardar nuevo usuario
    public function store(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|min:6',
            'role_id'  => 'required|exists:roles,id',
        ]);

        User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            'role_id'  => $request->role_id,
        ]);

        return redirect()->route('administrador.creacion_usu')
                         ->with('success', 'Usuario creado correctamente');
    }

    // 📌 Formulario de edición
    public function edit($id)
    {
        $user  = User::findOrFail($id);
        $users = User::with('role')->get();
        $roles = Role::all();

        return view('administrador.creacion_usu', compact('user', 'users', 'roles'));
    }

    // 📌 Actualizar usuario
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'name'    => 'required|string|max:255',
            'email'   => 'required|email|unique:users,email,' . $user->id,
            'role_id' => 'required|exists:roles,id',
        ]);

        // Actualizar campos
        $user->name = $request->name;
        $user->email = $request->email;
        $user->role_id = $request->role_id;

        // Actualizar password si fue enviada
        if ($request->password) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return redirect()->route('administrador.creacion_usu')
                         ->with('success', 'Usuario actualizado correctamente');
    }

    // 📌 Eliminar usuario
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('administrador.creacion_usu')
                         ->with('success', 'Usuario eliminado correctamente');
    }
}
