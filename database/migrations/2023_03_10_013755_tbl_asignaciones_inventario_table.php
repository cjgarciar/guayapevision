<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TblAsignacionesInventarioTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_asignaciones_inventario', function (Blueprint $table) {
	$table->id(); 
 	$table->integer('id_tipo_empleado');
 	$table->integer('id_empleado');
 	$table->integer('id_inventario_producto');
 	$table->integer('cantidad_asignada');
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
