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
            $table->timestamp('fecha_venta')->useCurrent(); ;
            $table->decimal('total', 10, 2);
            $table->unsignedBigInteger('metodo_pago_id');
            $table->string('estado');
            $table->date('fecha_entrega');
            $table->text('direccion_entrega');
            $table->text('comentarios')->nullable();
            $table->timestamps();

            $table->foreign('cliente_id')->references('id')->on('clientes')->onDelete('cascade');
            $table->foreign('metodo_pago_id')->references('id')->on('metodo_pago')->onDelete('cascade');
        });
    }
    public function down()
    {
        Schema::dropIfExists('ventas');
    }
}