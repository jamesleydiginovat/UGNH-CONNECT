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
         Schema::create('facultes', function(Blueprint $table ){
            $table->id();
            $table->string('codeFac')->unique();
            $table->string('nom')->unique();
            $table->integer('nombreNiveau');

            $table->timestamps();
        });



        DB::table('facultes')->insert([
            ['codeFac' => '0022', 'nom' => 'Sciences informatiques', 'nombreNiveau' => 4, 'created_at' => now(), 'updated_at' => now()],
            ['codeFac' => '0033', 'nom' => 'Sciences de l’éducation', 'nombreNiveau' => 3, 'created_at' => now(), 'updated_at' => now()],
            ['codeFac' => '0044', 'nom' => 'Génie civil', 'nombreNiveau' => 5, 'created_at' => now(), 'updated_at' => now()],
            ['codeFac' => '0055', 'nom' => 'Sciences administratives', 'nombreNiveau' => 4, 'created_at' => now(), 'updated_at' => now()],
            ['codeFac' => '0066', 'nom' => 'Sciences agronomiques', 'nombreNiveau' => 4, 'created_at' => now(), 'updated_at' => now()],
            ['codeFac' => '0077', 'nom' => 'Sciences infirmières', 'nombreNiveau' => 4, 'created_at' => now(), 'updated_at' => now()],
            ['codeFac' => '0088', 'nom' => 'Biologie médicale', 'nombreNiveau' => 4, 'created_at' => now(), 'updated_at' => now()],
            ['codeFac' => '0099', 'nom' => 'Laboratoire médical', 'nombreNiveau' => 4, 'created_at' => now(), 'updated_at' => now()],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
         Schema::dropIfExists('facultes');
    }
};
