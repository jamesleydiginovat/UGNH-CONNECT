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
         Schema::create('faculte_prices', function (Blueprint $table) {
            $table->id();
            
            $table->string('codeFac'); // FK vers facultes.codeFac
            $table->string('session'); // ex: I, II

            $table->decimal('premierVersement', 10, 2)->default(0);
            $table->decimal('deuxiemeVersement', 10, 2)->default(0);
            $table->decimal('troisiemeVersement', 10, 2)->default(0);
            $table->decimal('prixTotal', 10, 2)->default(0);

            $table->timestamps();

            // clé étrangère
            $table->foreign('codeFac')
                  ->references('codeFac')
                  ->on('facultes')
                  ->onDelete('cascade');

            // unique pour chaque faculté et session
            $table->unique(['codeFac', 'session']);
        });



        $facultes = DB::table('facultes')->get();

        foreach ($facultes as $faculte) {

            $premier = 5000;
            $deuxieme = 3000;
            $troisieme = 2000;

            $total = $premier + $deuxieme + $troisieme;

            DB::table('faculte_prices')->insert([
                [
                    'codeFac' => $faculte->codeFac,
                    'session' => 'I',
                    'premierVersement' => $premier,
                    'deuxiemeVersement' => $deuxieme,
                    'troisiemeVersement' => $troisieme,
                    'prixTotal' => $total,
                    'created_at' => now(),
                    'updated_at' => now()
                ],
                [
                    'codeFac' => $faculte->codeFac,
                    'session' => 'II',
                    'premierVersement' => $premier,
                    'deuxiemeVersement' => $deuxieme,
                    'troisiemeVersement' => $troisieme,
                    'prixTotal' => $total,
                    'created_at' => now(),
                    'updated_at' => now()
                ]
            ]);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
