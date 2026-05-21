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
            Schema::create('utilisateurs_tb', function (Blueprint $table) {
            $table->id();
            // Foreign key vers personnels_tb.code
            $table->string('codePersonnel');

            // Informations personnelles
            $table->string('nomUtilisateur')->unique();
            $table->string('motDePasse');
            $table->enum('statut', ['1', '0']);

            $table->timestamps();

            // Déclaration de la clé étrangère
            $table->foreign('codePersonnel')
                ->references('code')
                ->on('personnels_tb')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists("utilisateurs_tb");
    }
};
