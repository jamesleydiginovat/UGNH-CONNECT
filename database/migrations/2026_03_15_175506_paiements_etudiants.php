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
        Schema::create('paiement_etudiants', function (Blueprint $table) {
            $table->id();

            // FK vers étudiants
            $table->string('matriculeEtudiant');
            $table->foreign('matriculeEtudiant')
                  ->references('matricule')
                  ->on('etudiants_tb')
                  ->onDelete('cascade');

            // FK vers facultés
            $table->string('codeFaculte');
            $table->foreign('codeFaculte')
                  ->references('codeFac')
                  ->on('facultes')
                  ->onDelete('cascade');


            // FK vers annee accademiques
            $table->string('anneAccademique');
            $table->foreign('anneAccademique')
                  ->references('libelle')
                  ->on('annee_academiques')
                  ->onDelete('cascade');

            $table->string('niveau'); // Ex: L1, L2, M1
            $table->string('session'); // I ou II

            $table->decimal('premierVersement', 10, 2)->default(0);
            $table->decimal('deuxiemeVersement', 10, 2)->default(0);
            $table->decimal('troisiemeVersement', 10, 2)->default(0);
            $table->decimal('total', 10, 2)->default(0);

            // $table->date('datePaiement')->nullable();
            $table->string('modePaiement')->nullable(); // Espèces, Natcash, Carte
            $table->string('statut')->default('Partiel'); // Partiel, Complet
            // $table->text('commentaire')->nullable();

            $table->timestamps();

            // clé unique pour éviter double paiement pour même étudiant, même niveau et session
            $table->unique(['matriculeEtudiant', 'codeFaculte', 'niveau', 'session','anneAccademique']);
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
