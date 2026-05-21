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
        Schema::create('document_cours_tb_esalle', function (Blueprint $table) {
            $table->id();
            $table->string('titre');
            $table->string('professeurs');
            $table->string('codeFac');
            $table->string('niveau');
            $table->string('session');
            $table->string('codeCours');
            $table->string('pdf')->unique();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('esalle_document_cours_tb_esalle');
    }
};
