<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CatCargosEmpleadosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cat_cargos_empleados', function (Blueprint $table) {
	$table->id(); 
 	$table->string('nombre');
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
