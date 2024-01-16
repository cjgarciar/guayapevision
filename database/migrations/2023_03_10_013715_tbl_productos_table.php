<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TblProductosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_productos', function (Blueprint $table) {
	$table->id(); 
 	$table->string('nombre');
 	$table->integer('id_unidad_medida');
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
