<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('esalle_users', function (Blueprint $table) {
            $table->id();

            $table->string('code')->unique(); // matricule ou code prof
            $table->string('nom');
            $table->string('prenom')->nullable();

            $table->string('type'); // 🔥 important

            $table->string('telephone')->nullable();

            $table->boolean('actif')->default(true);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('esalle_users');
    }
};
