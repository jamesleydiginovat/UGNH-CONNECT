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
        Schema::create('horaire_facultes', function (Blueprint $table) {
        //     $table->id();

        //     // Informations principales
        //     $table->string('codeFac');
        //     $table->integer('niveau');
        //     $table->string('session');

        //     // Informations du cours
        //     $table->string('cours');
        //     $table->string('jour')->nullable();

        //     // Jours de la semaine (horaires ou valeurs)
        //     $table->string('lundi')->nullable();
        //     $table->string('mardi')->nullable();
        //     $table->string('mercredi')->nullable();
        //     $table->string('jeudi')->nullable();
        //     $table->string('vendredi')->nullable();
        //     $table->string('samedi')->nullable();
        //     $table->string('dimanche')->nullable();

        //     $table->timestamps();



        $table->id();

        $table->string('codeFac');
        $table->string('niveau');
        $table->string('session');
        

        $table->string('cours');
        $table->string('codeCours');
        $table->string('jour'); // lundi, mardi...

        $table->time('heure_debut');
        $table->time('heure_fin');

        $table->string('salle')->nullable();

        $table->foreign('codeFac')
        ->references('codeFac')
        ->on('facultes')
        ->onDelete('cascade');

        $table->foreign('codeCours')
        ->references('codeCours')
        ->on('cours_tb')
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
