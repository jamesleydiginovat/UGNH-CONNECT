<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class bultinEtudiantModel extends Model
{
    protected $table ="bultinEtudiant";

    protected $fillable = [
        'matricule',
        'niveau',
        'session',
        'anneeAcademique',
        'valider',
        'pdf',
    ];
}
