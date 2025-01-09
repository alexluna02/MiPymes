<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */

    // tabla de productos
    public function up()
    {
        Schema::create('productos', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('descripcion');  
            $table->unsignedBigInteger('proveedor_id');
            $table->decimal('precio', 8, 2);  
            $table->integer('cantidad_stock');
            $table->string('tipo_producto');
            $table->string('categoria');  
            $table->string('marca');      
            $table->string('modelo');     
            $table->integer('año_fabricacion');  
            $table->timestamps();
            $table->foreign('proveedor_id')->references('id')->on('proveedores')->onDelete('cascade');

        });
    }
    

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('productos');
    }
}