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
         Schema::create('permissions', function (Blueprint $table) {
            $table->id();
            $table->string('nomPermission')->unique();
            $table->text('description')->nullable();
            $table->timestamps();
        });



                // Insérer les permissions avec description
        DB::table('permissions')->insert([
            [
                'nomPermission' => 'Tableau de bord général',
                'description' => 'Accès à la page principale du tableau de bord'
            ],
            [
                'nom_permission' => 'Gestion des personnels',
                'description' => 'Créer, modifier, supprimer et consulter les personnels'
            ],
            [
                'nom_permission' => 'Gestion des utilisateurs et rôles',
                'description' => 'Administration des comptes utilisateurs et des rôles'
            ],
            [
                'nom_permission' => 'Gestion des étudiants',
                'description' => 'Créer, modifier, supprimer et consulter les informations des étudiants'
            ],
            [
                'nom_permission' => 'Gestion des facultés et des décanats',
                'description' => 'Administration des facultés, départements et décanats'
            ],
            [
                'nom_permission' => 'Gestion des professeurs',
                'description' => 'Créer, modifier et consulter les profils des enseignants'
            ],
            [
                'nom_permission' => 'Gestion des cours et programmes',
                'description' => 'Gestion des cours, programmes et modules pédagogiques'
            ],
            [
                'nom_permission' => 'Gestion des finances',
                'description' => 'Accès aux opérations financières, facturation et rapports'
            ],
            [
                'nom_permission' => 'Gestion des évaluations et résultats',
                'description' => 'Création et consultation des notes, bulletins et statistiques'
            ],
            [
                'nom_permission' => 'Gestion des dossiers et archives',
                'description' => 'Archivage et consultation des dossiers étudiants et administratifs'
            ],
            [
                'nom_permission' => 'Gestion des historiques',
                'description' => 'Suivi et consultation des historiques d activité du système'
            ],
            [
                'nom_permission' => 'Gestion des paramètres de l application',
                'description' => 'Configuration globale de l application et des fonctionnalités'
            ],
            [
                'nom_permission' => 'Toutes',
                'description' => 'Accès complet à toutes les fonctionnalités du système'
            ],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
