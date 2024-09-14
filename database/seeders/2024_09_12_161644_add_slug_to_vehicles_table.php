<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSlugToVehiclesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('vehicles', function (Blueprint $table) {
            // Ajouter la colonne slug si elle n'existe pas déjà
            if (!Schema::hasColumn('vehicles', 'slug')) {
                $table->string('slug')->unique();
            }
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
            // Supprimer l'index unique si nécessaire
            $table->dropUnique(['slug']);
            $table->dropColumn('slug');
        });
    }
}