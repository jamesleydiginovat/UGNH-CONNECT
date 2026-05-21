<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class personnelsModel extends Model
{
   Use HasFactory;

   protected $table = 'personnels_tb';
    
    protected $fillable = [
        'code',
        'nom',
        'prenom',
        'sexe',
        'telephone',
        'adresse',
        'email',
        'fonction',
        'conditionMatrimoniale',
        'status'
    ];

    public function Utilisateur(){
        return $this->hasMany(personnelsModel::class,'code', 'codePersonnel');
    }
}
