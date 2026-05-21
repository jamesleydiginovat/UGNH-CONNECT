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
       Schema::create('role_utilisateur', function (Blueprint $table) {
            $table->id();

            // Clé étrangère vers nomUtilisateur
            $table->string('nomUtilisateur'); // correspond au champ unique dans utilisateurs_tb
            $table->foreign('nomUtilisateur')
                ->references('nomUtilisateur') // champ unique dans utilisateurs_tb
                ->on('utilisateurs_tb')
                ->onDelete('cascade');

            // Clé étrangère vers roles.id
            $table->foreignId('role_id')
                ->constrained('roles')
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
