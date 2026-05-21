<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class paimentEtudiantModel extends Model
{
    protected $table ="paiement_etudiants";

    protected $fillable = [
        'matriculeEtudiant',
        'codeFaculte',
        'anneAccademique',
        'niveau',
        'session',
        'premierVersement',
        'deuxiemeVersement',
        'troisiemeVersement',
        'total',
        'modePaiement',
        'statut'
    ];

    public function facultePrice()
    {
        return $this->belongsTo(facultes_prices::class, 'codeFaculte', 'codeFac');
    }

    public function etudiant()
    {
        return $this->belongsTo(etudiantModel::class, 'matriculeEtudiant', 'matricule');
    }

}
