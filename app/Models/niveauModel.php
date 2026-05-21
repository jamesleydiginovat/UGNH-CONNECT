<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class niveauModel extends Model
{
    protected $table = 'niveaux';
    
    protected $fillable = [
        'matriculeEtudiant',
        'niveau',
        'anneeAcademique',
    ];
}
