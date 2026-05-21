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
        Schema::create('bultinEtudiant', function (Blueprint $table) {
            $table->id();
            $table->string('matricule');
            $table->string('niveau');
            $table->string('session');
            $table->string('anneeAcademique');
            $table->string('pdf');
            $table->string('valider');
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
