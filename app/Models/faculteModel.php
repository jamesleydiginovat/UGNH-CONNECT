<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class faculteModel extends Model
{
    use HasFactory;

    protected $table = 'facultes';
    
    protected $fillable = [
        'codeFac',
        'nom',
        'nombreNiveau',
    ];



    public function etudiants()
    {
        return $this->belongsToMany(
            etudiantModel::class,    // Le modèle lié
            'etudiants_faculte',      // La table pivot
            'codeFaculte',       // La clé étrangère de la faculté dans la pivot
            'matriculeEtudiant',    // La clé étrangère de l'étudiant dans la pivot
            'codeFac',               // La clé locale de la faculté
            'matricule'              // La clé locale de l'étudiant
        );
    }
}
