<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('prestamos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('vehiculo_id')->constrained('vehiculos')->onDelete('cascade');
            $table->foreignId('usuario_id')->constrained('users')->onDelete('cascade'); // Cliente
            $table->foreignId('empleado_id')->constrained('users')->onDelete('cascade'); // Empleado que gestiona
            $table->enum('estado', ['pendiente', 'activo', 'finalizado', 'cancelado'])->default('pendiente');
            $table->text('observaciones')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('prestamos');
    }
};