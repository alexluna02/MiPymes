<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('producto_repuesto', function (Blueprint $table) {
            $table->unsignedBigInteger('producto_id');
            $table->unsignedBigInteger('repuesto_id');
            $table->primary(['producto_id', 'repuesto_id']);
            $table->foreign('producto_id')->references('id')->on('productos')->onDelete('cascade');
            $table->foreign('repuesto_id')->references('id')->on('repuestos')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('producto_repuesto');
    }
};
