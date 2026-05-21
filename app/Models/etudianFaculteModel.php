<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class etudianFaculteModel extends Model
{
    protected $table ="etudiants_faculte";

    protected $fillable = [
        'matriculeEtudiant',
        'codeFaculte'
    ];

    public function etudiant()
    {
        return $this->belongsTo(etudiantModel::class, 'matriculeEtudiant', 'matricule');
    }
    public function faculte()
    {
        return $this->hasOne(faculteModel::class, 'codeFac', 'codeFaculte');
    }

}
