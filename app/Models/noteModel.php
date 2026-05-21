<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class noteModel extends Model
{
    protected $table ='notes';
    
    protected $fillable = [
        'matriculeEtudiant',
        'codeCours',
        'codeFac',
        'niveau',
        'session',
        'anneeAcademique',
        'noteIntra',
        'examenFinal',
        'noteRattrapage',
    ];

    public function faculte()
    {
        return $this->belongsTo(faculteModel::class, 'codeFac', 'codeFac');
    }

    public function etudiant()
    {
        return $this->belongsTo(etudiantModel::class, 'matriculeEtudiant', 'matricule');
    }
}
