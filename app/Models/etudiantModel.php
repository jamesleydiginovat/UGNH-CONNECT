<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class etudiantModel extends Model
{
    use HasFactory;

    protected $table="etudiants_tb";

    protected $fillable = [
        'matricule',
        'nom',
        'prenom',
        'sexe',
        'adresse',
        'telephone',
        'dateNaissance',
        'lieuNaissance',
        'nif_cin',
        'groupeSanguin',
        'conditionMatrimoniale',
        'email',
        'occupationAcctuelle',
        'lieuDeTravail',
        'nomPrenomPersonneR',
        'telephonePersonneR',
        'lien',
        'PersonneReferences',
        'niveauBac',
        'anneeBac',
        'etablissementBac',
        'niveauES',
        'disciplineES',
        'anneeES',
        'etablissementES',
        'photo',
        'status',
        'niveau',
        'codeFac',
        'admisOrNot'
    ];



    public function faculte()
    {
        return $this->belongsToMany(
            faculteModel::class,     // Le modèle lié
            'etudiants_faculte',      // La table pivot
            'matriculeEtudiant',    // La clé étrangère de l'étudiant dans la pivot
            'codeFaculte',       // La clé étrangère de la faculté dans la pivot
            'matricule',             // La clé locale de l'étudiant
            'codeFac'                // La clé locale de la faculté
        );       
    }


    public function niveau()
    {
        return $this->hasOne(niveauModel::class, 'matriculeMatricule', 'matricule');
    }

}
