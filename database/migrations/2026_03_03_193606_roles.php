<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
         Schema::create('roles', function (Blueprint $table) {
            $table->id();
            $table->string('nom')->unique(); // admin, enseignant, etc.
            $table->timestamps();
        });


        // Insérer les rôles avec timestamps
        DB::table('roles')->insert([
            ['nom' => 'Administrateur', 'created_at' => now(), 'updated_at' => now()],
            ['nom' => 'Secrétaire générale', 'created_at' => now(), 'updated_at' => now()],
            ['nom' => 'Secrétaire adjoint', 'created_at' => now(), 'updated_at' => now()],
            ['nom' => 'Comptable', 'created_at' => now(), 'updated_at' => now()],
            ['nom' => 'Doyen de faculté', 'created_at' => now(), 'updated_at' => now()],
            ['nom' => 'Vice-doyen de faculté', 'created_at' => now(), 'updated_at' => now()],
            ['nom' => 'Enseignant', 'created_at' => now(), 'updated_at' => now()],
            ['nom' => 'Étudiant', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('roles');
    }
};
