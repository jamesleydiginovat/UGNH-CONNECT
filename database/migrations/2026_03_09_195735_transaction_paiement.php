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
        Schema::create('transaction_paiements', function (Blueprint $table) {
            $table->id();

            // numéro unique de transaction
            $table->string('numeroTransaction')->unique();

            // FK vers etudiants
            $table->string('matriculeEtudiant');
            $table->foreign('matriculeEtudiant')
                  ->references('matricule')
                  ->on('etudiants_tb')
                  ->onDelete('cascade');

            $table->string('niveau');
            $table->string('session');

            // FK vers facultes
            $table->string('codeFaculteEtudiant');
            $table->foreign('codeFaculteEtudiant')
                  ->references('codeFac')
                  ->on('facultes')
                  ->onDelete('cascade');

            // informations paiement
            $table->decimal('montant', 10, 2);
            $table->string('motif')->nullable(); // ex: 1er versement, inscription, etc.
            $table->string('modePaiement'); // Espèces, Natcash, Carte

            $table->date('dateTransaction');

            // champs supplémentaires utiles
            $table->string('statut')->default('valide'); // valide, annule

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
