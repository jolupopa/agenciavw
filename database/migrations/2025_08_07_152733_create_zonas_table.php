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
        Schema::create('zonas', function (Blueprint $table) {
            $table->id();
             $table->string('name');
            $table->string('slug');
            $table->foreignId('distrito_id')->nullable()->on('distritos');
            $table->foreignId('provincia_id')->nullable()->on('provincias');
            $table->foreignId('departamento_id')->nullable()->on('departamentos');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('zonas');
    }
};
