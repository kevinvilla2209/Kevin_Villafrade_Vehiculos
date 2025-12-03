<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehiculo extends Model
{
    use HasFactory;

    protected $fillable = [
        'marca', 'modelo', 'anio', 'color', 'placa', 'estado'
    ];

    public function prestamos()
    {
        return $this->hasMany(Prestamo::class);
    }
}