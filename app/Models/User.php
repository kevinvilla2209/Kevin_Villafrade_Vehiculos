<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role_id',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    /**
     * Relación con el modelo Role.
     */
    public function role()
    {
        return $this->belongsTo(Role::class, 'role_id');
    }

    /**
     * Verifica si el usuario tiene un rol específico (insensible a mayúsculas/minúsculas).
     */
    public function hasRole($roleName)
    {
        return $this->role && strtolower($this->role->name) === strtolower($roleName);
    }

    public function prestamosCliente()
    {
        return $this->hasMany(Prestamo::class, 'usuario_id');
    }

    public function prestamosEmpleado()
    {
        return $this->hasMany(Prestamo::class, 'empleado_id');
    }
}
