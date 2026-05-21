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
        Schema::create('etudiants_faculte', function (Blueprint $table) {
            $table->id();

            // Lien avec l'étudiant par matricule
            $table->string('matriculeEtudiant');
            $table->foreign('matriculeEtudiant')
                  ->references('matricule')
                  ->on('etudiants_tb')
                  ->onDelete('cascade');

            // Lien avec la faculté par codeFac
            $table->string('codeFaculte');
            $table->foreign('codeFaculte')
                  ->references('codeFac')
                  ->on('facultes')
                  ->onDelete('cascade');

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
