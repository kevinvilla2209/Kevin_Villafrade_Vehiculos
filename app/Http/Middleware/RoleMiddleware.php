<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, string $roles): Response
    {
        $user = auth()->user();

        if (!$user) {
            abort(403, 'Acceso denegado');
        }

        // Permite varios roles separados por "|"
        $rolesArray = explode('|', $roles);

        if ($user->role->name === 'administrador') {
        return $next($request);
    }

        $hasRole = false;
        foreach ($rolesArray as $role) {
            if ($user->hasRole($role)) {
                $hasRole = true;
                break;
            }
        }

        if (!$hasRole) {
            abort(403, 'Acceso denegado');
        }

        return $next($request);
    }
}
