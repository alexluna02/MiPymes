<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('repuestos', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->text('descripcion')->nullable();
            $table->decimal('precio', 10, 2);
            $table->integer('cantidad_stock');
            $table->unsignedBigInteger('categoria_id');
            $table->string('marca');
            $table->string('modelo');
            $table->year('año_fabricacion');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('repuestos');
    }
};
