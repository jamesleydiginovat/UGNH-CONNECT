<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class fichePaiementEtudiant extends Model
{
    protected $table="fiche_paiement_etudiant";
    protected $fillable = [
    'matricule',
    'anneAcademique',
    'codeTransaction',
    'pdf',
    ];
}
