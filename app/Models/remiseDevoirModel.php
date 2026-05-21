<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class remiseDevoirModel extends Model
{
     // 🗄️ Table associée
    protected $table = 'remise_devoir_etudiants_tb';

    // ✍️ Champs remplissables
    protected $fillable = [
        'matriculeEtudiant',
        'codeDevoir',
        'pdf',
        'dateRemise',
    ];

    // 🎓 Relation : étudiant
    public function etudiant()
    {
        return $this->belongsTo(etudiantModel::class, 'matriculeEtudiant', 'matricule');
    }

    // 📚 Relation : devoir
    public function devoir()
    {
        return $this->belongsTo(devoirModel::class, 'codeDevoir', 'code');
    }
}
