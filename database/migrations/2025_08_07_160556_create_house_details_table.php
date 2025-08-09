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
        Schema::create('house_details', function (Blueprint $table) {
            $table->id();
            $table->string('subtitle')->nullable();
			$table->decimal('price',10,2)->nullable();
            $table->text('detalle')->nullable();
            $table->decimal('area_total', 10, 2)->nullable();
            $table->unsignedTinyInteger('bedrooms')->nullable();
            $table->unsignedTinyInteger('bathrooms')->nullable();
            $table->unsignedTinyInteger('num_pisos')->nullable();
            $table->unsignedTinyInteger('num_cuartos')->nullable();
            $table->unsignedTinyInteger('num_cars')->nullable();
            $table->boolean('has_garage')->default(false);
            $table->string('url_video')->nullable();
			$table->string('url_plano')->nullable();
			$table->string('url_plano2')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('house_details');
    }
};
