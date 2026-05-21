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
        Schema::create('niveaux', function (Blueprint $table) {
            $table->id();
            
            $table->string('matriculeEtudiant'); // FK vers etudiants_tb
            $table->foreign('matriculeEtudiant')
                ->references('matricule')
                ->on('etudiants_tb')
                ->onDelete('cascade');

            // $table->string('faculte_codeFac'); // FK vers facultes_tb
            // $table->foreign('faculte_codeFac')
            //     ->references('codeFac')
            //     ->on('facultes_tb')
            //     ->onDelete('cascade');

            $table->integer('niveau'); // L1, L2, L3, L4...
            $table->string('anneeAcademique')->nullable(); // ex: 2025-2026

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
