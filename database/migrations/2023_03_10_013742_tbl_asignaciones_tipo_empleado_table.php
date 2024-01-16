<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TblAsignacionesTipoEmpleadoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_asignaciones_tipo_empleado', function (Blueprint $table) {
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
