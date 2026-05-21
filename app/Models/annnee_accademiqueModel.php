<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class annnee_accademiqueModel extends Model
{
    protected $table="annee_academiques";
    protected $fillable = [
        'libelle',
        'date_debut',
        'date_fin',
        'active'
    ];
}
