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
        Schema::create('fiche_paiement_etudiant', function (Blueprint $table) {
            $table->id();
            $table->string('matricule');
            $table->string('anneAcademique');
            $table->string('codeTransaction');
            $table->string('pdf');
            $table->timestamps();



            $table->unique([
                'matricule',
                'anneAcademique',
                'codeTransaction',
            ]);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fiche_paiement_etudiant');
    }
};
