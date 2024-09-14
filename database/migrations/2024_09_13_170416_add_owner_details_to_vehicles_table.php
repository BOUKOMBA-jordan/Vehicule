<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddOwnerDetailsToVehiclesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('vehicles', function (Blueprint $table) {
            $table->string('owner_name')->nullable();  // Ajout du champ pour le nom du propriétaire
            $table->string('owner_phone')->nullable(); // Ajout du champ pour le téléphone du propriétaire
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('vehicles', function (Blueprint $table) {
            $table->dropColumn(['owner_name', 'owner_phone']);  // Suppression des champs ajoutés
        });
    }
}