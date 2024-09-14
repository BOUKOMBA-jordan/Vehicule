<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('vehicles', function (Blueprint $table) {
            $table->id();
            $table->string('make'); // Marque du véhicule
            $table->string('model'); // Modèle du véhicule
            $table->integer('year'); // Année de fabrication
            $table->string('fuel_type'); // Type de carburant (essence, diesel, électrique, etc.)
            $table->integer('mileage'); // Kilométrage
            $table->string('color'); // Couleur du véhicule
            $table->decimal('price', 15, 2); // Prix du véhicule
            $table->string('city'); // Ville de vente
            $table->string('address'); // Adresse de vente
            $table->string('postal_code'); // Code postal de vente
            $table->boolean('sold')->default(false); // Statut de vente
            $table->string('image')->nullable(); // Image du véhicule
            $table->timestamps(); // Dates de création et de mise à jour
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vehicles');
    }
};