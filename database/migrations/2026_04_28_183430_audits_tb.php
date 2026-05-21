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
        Schema::create('audits_tb', function (Blueprint $table) {
            $table->id();

            // 🔐 utilisateur
            $table->string('code')->nullable();

            // 🧾 action
            $table->string('action'); // ex: UPDATE_NOTE

            // 🔑 code de la donnée
            $table->string('record_code')->nullable();

            // 🌐 sécurité
            $table->string('ip_address')->nullable();

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
