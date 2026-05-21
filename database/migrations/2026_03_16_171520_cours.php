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
        Schema::create('cours_tb', function (Blueprint $table) {
        $table->id();
        
        $table->string('codeCours')->unique();
        $table->string('nom');
        $table->string('codeFac');
        $table->string('niveau');
        $table->string('session');
        $table->string('codeProf');


        $table->foreign('codeFac')
        ->references('codeFac')
        ->on('facultes')
        ->onDelete('cascade');

        $table->foreign('codeProf')
        ->references('codeProf')
        ->on('professeurs_tb')
        ->onDelete('cascade');

        $table->timestamps();

        $table->unique(['nom','codeFac','niveau','session']);
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
