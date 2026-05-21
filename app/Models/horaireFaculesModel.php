<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class horaireFaculesModel extends Model
{
    protected $table = "horaire_facultes";
    protected $fillable = [
        'codeFac',
        'niveau',
        'session',
        'cours',
        'codeCours',
        'jour',
        'heure_debut',
        'heure_fin',
        'salle'
    ];


    public function faculte()
    {
        return $this->hasOne(faculteModel::class, 'codeFac', 'codeFac');
    }


    public function prof()
    {
        return $this->hasOne(coursModel::class, 'codeCours', 'codeCours');
    }


}
