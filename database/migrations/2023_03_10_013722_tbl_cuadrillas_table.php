<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TblCuadrillasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_cuadrillas', function (Blueprint $table) {
	$table->id(); 
 	$table->string('nombre');
 	$table->string('descripcion');
 	$table->string('orden_servicio');
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
