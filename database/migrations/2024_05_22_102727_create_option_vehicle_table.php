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
        Schema::create('option_vehicle', function (Blueprint $table) {
            $table->foreignIdFor(\App\Models\Option::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(\App\Models\Vehicle::class)->constrained()->cascadeOnDelete();
            $table->primary(['option_id', 'vehicle_id']); // Clé primaire composite
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('option_vehicle');
    }
};