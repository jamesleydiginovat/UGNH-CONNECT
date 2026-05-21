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
        Schema::create('devoir_tb_esalle', function (Blueprint $table) {
            $table->id();

            $table->string('code')->unique(); // code du devoir
            $table->string('titre');
            $table->text('description')->nullable();

            $table->string('professeur'); // code du prof
            $table->string('cours'); // code du cours

            $table->string('pdf')->nullable(); // chemin fichier

            $table->date('dateRemise');
            $table->string('anneAcademique');

            $table->timestamps();

            // 🔗 Relations (fortement recommandé)
            $table->foreign('professeur')
                  ->references('codeProf')
                  ->on('professeurs_tb')
                  ->onDelete('cascade');

            $table->foreign('cours')
                  ->references('codeCours')
                  ->on('cours_tb')
                  ->onDelete('cascade');
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
