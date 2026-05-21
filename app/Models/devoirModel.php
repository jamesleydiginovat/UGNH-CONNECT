<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class devoirModel extends Model
{
   // 🗄️ Table associée
    protected $table = 'devoir_tb_esalle';

    // ✍️ Champs remplissables
    protected $fillable = [
        'code',
        'titre',
        'description',
        'professeur',
        'cours',
        'pdf',
        'dateRemise',
        'anneAcademique',
    ];

    // 👨‍🏫 Relation : professeur (utilisateur)
    public function professeur()
    {
        return $this->belongsTo(UtilisateurModel::class, 'professeur');
    }

    public function coursRelation()
    {
        return $this->belongsTo(coursModel::class, 'cours', 'codeCours');
    }

    // 📤 Relation : soumissions des étudiants
    public function soumissions()
    {
        return $this->hasMany(remiseDevoirModel::class, 'codeDevoir', 'code');
    }
}
