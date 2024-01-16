<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TblCuadrillasEmpleadosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_cuadrillas_empleados', function (Blueprint $table) {
	$table->id(); 
 	$table->integer('id_cuadrilla');
 	$table->integer('id_empleado');
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
