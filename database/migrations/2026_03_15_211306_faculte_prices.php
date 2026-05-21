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
        
        $table->string('codeFac');
        $table->string('niveau'); // 1 à 5
        $table->string('session'); // I ou II

        $table->decimal('premierVersement', 10, 2)->default(0);
        $table->decimal('deuxiemeVersement', 10, 2)->default(0);
        $table->decimal('troisiemeVersement', 10, 2)->default(0);
        $table->decimal('prixTotal', 10, 2)->default(0);

        $table->timestamps();

        $table->foreign('codeFac')
            ->references('codeFac')
            ->on('facultes')
            ->onDelete('cascade');

        $table->unique(['codeFac', 'niveau', 'session']);
    });


    $facultes = DB::table('facultes')->get();

    $niveaux = ["1","2","3","4","5"];

    foreach ($facultes as $faculte) {

        foreach ($niveaux as $niveau) {

            // prix session I selon niveau
            $premier1 = 4000 + ($niveau * 500);
            $deuxieme1 = 3000 + ($niveau * 300);
            $troisieme1 = 2000 + ($niveau * 200);

            $total1 = $premier1 + $deuxieme1 + $troisieme1;

            // prix session II selon niveau (différent)
            $premier2 = 3000 + ($niveau * 400);
            $deuxieme2 = 2000 + ($niveau * 250);
            $troisieme2 = 1500 + ($niveau * 150);

            $total2 = $premier2 + $deuxieme2 + $troisieme2;

            DB::table('faculte_prices')->insert([
                [
                    'codeFac' => $faculte->codeFac,
                    'niveau' => $niveau,
                    'session' => 'I',
                    'premierVersement' => $premier1,
                    'deuxiemeVersement' => $deuxieme1,
                    'troisiemeVersement' => $troisieme1,
                    'prixTotal' => $total1,
                    'created_at' => now(),
                    'updated_at' => now()
                ],
                [
                    'codeFac' => $faculte->codeFac,
                    'niveau' => $niveau,
                    'session' => 'II',
                    'premierVersement' => $premier2,
                    'deuxiemeVersement' => $deuxieme2,
                    'troisiemeVersement' => $troisieme2,
                    'prixTotal' => $total2,
                    'created_at' => now(),
                    'updated_at' => now()
                ]
            ]);

        }
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
