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
        Schema::create('proyects', function (Blueprint $table) {
            $table->id();
            $table->string('code')->nullable();
            $table->string('title');
            $table->string('address');

            $table->string('longitud')->nullable();
			$table->string('latitud')->nullable();

            $table->boolean('is_land_proyect')->default(false);

            $table->enum('visibilidad', ['regular', 'destacada', 'superdestacada'])->default('regular');
            $table->enum('estado', ['edicion', 'publicada', 'vencida', 'baneada'])->default('edicion');
            $table->boolean('active')->nullable()->default(false);

                //  locations
            $table->foreignId('zona_id')->nullable()->constrained('zonas')->onDelete('set null'); // Asumiendo tabla 'zonas'
            $table->foreignId('distrito_id')->nullable()->constrained('distritos')->onDelete('cascade');
            $table->foreignId('provincia_id')->nullable()->constrained('provincias')->onDelete('cascade'); // Asumiendo tabla 'provincias'
            $table->foreignId('departamento_id')->nullable()->constrained('departamentos')->onDelete('cascade'); // Asumiendo tabla 'departamentos'
            // foreing key
            $table->foreignId('category_id')->nullable()->constrained('categories')->onDelete('set null'); // Relación con 'Category' (venta o alquiler)
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('typeproperty_id')->nullable()->constrained('typeproperties')->onDelete('set null'); // Relación con 'Typeproperty' (casa, depto, terreno)

	        $table->timestamp('published_at')->nullable();
			$table->timestamp('published_end')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('proyects');
    }
};
