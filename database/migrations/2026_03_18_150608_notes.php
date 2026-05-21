formu<?php

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
         Schema::create('notes', function (Blueprint $table) {
            $table->id();

            // 🔹 Identification
            $table->string('matriculeEtudiant');
            $table->string('codeCours');

            // 🔹 Contexte académique
            $table->string('codeFac');
            $table->string('niveau'); // 1 à 5
            $table->enum('session', ['1', '2']);
            $table->string('anneeAcademique');

            // 🔹 Notes
            $table->decimal('noteIntra', 5, 2)->default(0);
            $table->decimal('examenFinal', 5, 2)->default(0);
            $table->decimal('noteRattrapage', 5, 2)->nullable();

            // 🔹 Statut
            // $table->boolean('aRefait')->default(false);

            // 🔹 Décision finale
            // $table->enum('decision', ['Admis', 'Rattrapage', 'Echoue'])->nullable();

            $table->timestamps();

            $table->foreign('codeFac')
            ->references('codeFac')
            ->on('facultes')
            ->onDelete('cascade');

            $table->foreign('codeCours')
            ->references('codeCours')
            ->on('cours_tb')
            ->onDelete('cascade');

            $table->foreign('matriculeEtudiant')
            ->references('matricule')
            ->on('etudiants_tb')
            ->onDelete('cascade');

            // Empêcher les doublons
            $table->unique([
                'matriculeEtudiant',
                'codeCours',
                'session',
                'anneeAcademique'
            ]);
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
