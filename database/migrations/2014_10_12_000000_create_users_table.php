<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id(); // ID (Estudiante / Administrativo)
            $table->string('matricula')->unique(); // (Matrícula / Clave)
            $table->string('name'); // Nombre
            $table->string('apellido_paterno'); // Apellido Paterno
            $table->string('apellido_materno'); // Apellido Materno
            $table->string('licenciatura'); // Licenciatura
            $table->string('telefono'); // Teléfono
            $table->string('email')->unique(); // Correo Electrónico
            $table->timestamp('email_verified_at')->nullable(); // Verificar Correo
            $table->string('password'); // Contraseña
            $table->float('saldo', 8, 2)->default(0.00); // Saldo
            $table->string('tipo_usuario')->default('Estudiante'); // Tipo Usuario
            $table->rememberToken(); // Token (Remember)
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
};
