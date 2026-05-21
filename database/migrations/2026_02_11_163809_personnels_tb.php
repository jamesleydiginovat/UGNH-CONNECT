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
         Schema::create('personnels_tb', function (Blueprint $table) {
            $table->id();
           // Identification
            $table->string('code')->unique();

            // Informations personnelles
            $table->string('nom');
            $table->string('prenom');
            $table->enum('sexe', ['M', 'F']);
            $table->string('conditioMatrimoniale');
           
            // Coordonnées
            $table->string('telephone')->nullable();
            $table->string('adresse')->nullable();
            $table->string('email')->nullable();
            $table->string('fonction');
            $table->timestamps();
       });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
          Schema::dropIfExists('personnels_tb');
    }
};
