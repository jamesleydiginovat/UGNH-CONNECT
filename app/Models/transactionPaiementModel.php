<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class transactionPaiementModel extends Model
{
    use HasFactory;
    protected $table="transaction_paiements";

    protected $fillable = [
        'numeroTransaction',
        'matriculeEtudiant',
        'codeFaculteEtudiant',
        'anneAccademique',
        'niveau',
        'session',
        'montant',
        'motif',
        'modePaiement',
        'dateTransaction',
        'statut'
    ];
}
