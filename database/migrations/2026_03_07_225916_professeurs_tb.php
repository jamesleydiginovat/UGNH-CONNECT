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
        Schema::create('professeurs_tb', function (Blueprint $table) {
            $table->id();
            $table->string('codeProf')->unique(); // code unique pour chaque professeur
            $table->string('nom');
            $table->string('prenom');
            $table->string('adresse')->nullable();
            $table->string('telephone', 20)->nullable();
            $table->string('email')->nullable();
            $table->enum('sexe', ['M', 'F'])->nullable();
            $table->string('specialite')->nullable();
            $table->string('conditionMatrimoniale')->nullable();
            $table->date('dateNaissance')->nullable();
            $table->date('dateEmbauche')->nullable();
            $table->string('photo')->nullable();
            $table->enum('status', ['Actif', 'Congé', 'Retraité'])->default('Actif');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('professeurs_tb');
    }
};
