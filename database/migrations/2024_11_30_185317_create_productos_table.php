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
            $table->string('descripcion',500);  
            $table->unsignedBigInteger('proveedor_id');
            $table->unsignedBigInteger('categoria_id')->nullable(); // Relación con categorias
            $table->decimal('precio', 8, 2);  
            $table->integer('cantidad_stock');
            $table->string('marca');      
            $table->string('modelo');     
            $table->integer('año_fabricacion');  
            $table->timestamps();

            $table->foreign('proveedor_id')->references('id')->on('proveedores')->onDelete('cascade');
            $table->foreign('categoria_id')->references('id')->on('categorias')->onDelete('set null'); // Relación con categorias
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
