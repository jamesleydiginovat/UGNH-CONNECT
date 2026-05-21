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
         Schema::create('remise_devoir_etudiants_tb', function (Blueprint $table) {
            $table->id();

            // 🔗 FK vers étudiant (matricule)
            $table->string('matriculeEtudiant');

            // 🔗 FK vers devoir (code)
            $table->string('codeDevoir');

            $table->string('pdf');
            $table->dateTime('dateRemise');

            $table->timestamps();

            // 🔥 Contraintes (IMPORTANT)
            $table->foreign('matriculeEtudiant')
                  ->references('matricule')
                  ->on('etudiants_tb')
                  ->onDelete('cascade');

            $table->foreign('codeDevoir')
                  ->references('code')
                  ->on('devoir_tb_esalle')
                  ->onDelete('cascade');

            // 🚀 Empêcher double soumission du même devoir
            $table->unique(['matriculeEtudiant', 'codeDevoir']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('remise_devoir_etudiants_tb');
    }
};
