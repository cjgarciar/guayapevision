<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class PerEmpleado extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('per_empleado', function (Blueprint $table) {
            $table->id(); 
            $table->string('primer_nombre');
            $table->string('segundo_nombre');
            $table->string('primer_apellido');
            $table->string('segundo_apellido');
            $table->string('identidad');
            $table->string('telefono');
            $table->string('domicilio');
            $table->integer('id_usuario');
            $table->string('correo');
            $table->integer('id_ciudad_procedencia');
            $table->integer('id_cargo');
            $table->timestamps();
            $table->timestamp('deleted_at')->nullable();
        });				
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
