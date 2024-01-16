<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TblInventarioTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_inventario', function (Blueprint $table) {
	$table->id(); 
 	$table->integer('id_producto');
 	$table->string('cantidad');
 	$table->string('precio_compra');
 	$table->string('precio_venta');
 	$table->date('fecha_entrada');
 	$table->date('fecha_fin_existencia');
 	$table->string('codigo_barra_producto');
 	$table->integer('impuesto');
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
