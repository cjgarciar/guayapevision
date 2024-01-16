<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RegFichaClienteTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reg_ficha_cliente', function (Blueprint $table) {
	$table->id(); 
 	$table->string('identidad');
 	$table->string('primer_nombre');
 	$table->string('segundo_nombre');
 	$table->string('primer_apellido');
 	$table->string('segundo_apellido');
 	$table->string('direccion');
 	$table->integer('celular');
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
