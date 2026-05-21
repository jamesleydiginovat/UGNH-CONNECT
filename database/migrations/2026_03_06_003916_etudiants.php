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
        Schema::create('etudiants_tb',function(Blueprint $table ){
            $table->id();
            $table->string('matricule')->unique();
            $table->string('nom');
            $table->string('prenom');
            $table->enum('sexe',['M','F']);
            $table->string('adresse');
            $table->string('telephone',20);
            $table->date('dateNaissance');
            $table->string('lieuNaissance');
            $table->string('nif_cin',30);
            $table->enum('groupeSanguin',['A+','A-','B+','B-','AB+','AB-','O+','O-'])->nullable();
            $table->string('conditionMatrimoniale');
            $table->string('email')->nullable();
            $table->string('occupationAcctuelle')->nullable();
            $table->string('lieuDeTravail')->nullable();
            $table->string('nomPrenomPersonneR');
            $table->string('telephonePersonneR');
            $table->string('lien')->nullable();
            $table->string('PersonneReferences')->nullable();
            $table->enum('niveauBac',['Bac I', 'Bac II']);
            $table->year('anneeBac')->nullable();
            $table->string('etablissementBac')->nullable();
            $table->string('niveauES')->nullable();
            $table->string('disciplineES')->nullable();
            $table->year('anneeES')->nullable();
            $table->string('etablissementES')->nullable();
            $table->string('photo')->nullable();



            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
