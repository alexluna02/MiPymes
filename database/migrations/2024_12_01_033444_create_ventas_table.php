<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVentasTable extends Migration
{
    public function up()
    {
        Schema::create('ventas', function (Blueprint $table) {
            $table->id();
            $table->string('cliente_id');
            $table->timestamp('fecha_venta');
            $table->decimal('total', 10, 2);
            $table->string('metodo_pago_id');
            $table->string('estado');
            $table->date('fecha_entrega');
            $table->text('direccion_entrega');
            $table->text('comentarios')->nullable();
            $table->timestamps();
        });
    }
    public function down()
    {
        Schema::dropIfExists('ventas');
    }
}