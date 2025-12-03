<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prestamo extends Model
{
    use HasFactory;

    protected $fillable = [
        'vehiculo_id', 'usuario_id', 'empleado_id', 'estado', 'observaciones'
    ];

    public function vehiculo()
    {
        return $this->belongsTo(Vehiculo::class);
    }

    public function cliente()
    {
        return $this->belongsTo(User::class, 'usuario_id');
    }

    public function empleado()
    {
        return $this->belongsTo(User::class, 'empleado_id');
    }
}