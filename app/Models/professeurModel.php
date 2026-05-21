<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class professeurModel extends Model
{
    protected $table='professeurs_tb';
    protected $fillable = [
        'codeProf',
        'nom',
        'prenom',
        'adresse',
        'telephone',
        'email',
        'sexe',
        'specialite',
        'conditionMatrimoniale',
        'dateNaissance',
        'dateEmbauche',
        'photo',
        'status'
    ];
}
