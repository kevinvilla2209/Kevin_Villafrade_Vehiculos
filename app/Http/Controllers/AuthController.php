<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (auth()->attempt($credentials)) {
            $user = auth()->user();

            // Redirigir según rol
            switch ($user->role->name) {
                case 'administrador':
                    return redirect('/administrador');
                case 'empleado':
                    return redirect('/empleado');
                case 'cliente':
                    return redirect('/cliente');
                default:
                    return redirect('/dashboard');
            }
        }

        return back()->withErrors(['email' => 'Credenciales incorrectas']);
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/login');
    }

    public function showRegister()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'email' => 'required|unique:users',
            'password' => 'required|confirmed',
            'role_id' => 'required|exists:roles,id'
        ]);

        $data['password'] = Hash::make($data['password']);

        User::create($data);

        return redirect('/login');
    }
}
