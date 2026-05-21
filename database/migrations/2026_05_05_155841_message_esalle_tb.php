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
        Schema::create('messageEsalle_tb', function (Blueprint $table) {
            $table->id();
            $table->string('codeUser');
            $table->string('codeFac');
            $table->string('niveau');
            $table->string('message');
            $table->string('anneAcademique');
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
