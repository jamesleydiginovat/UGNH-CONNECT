<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class coursModel extends Model
{
    protected $table ="cours_tb";

    protected $fillable = [
        'codeCours',
        'nom',
        'codeFac',
        'niveau',
        'session',
        'codeProf',
        'status',
    ];

    public function faculte()
    {
        return $this->hasOne(faculteModel::class, 'codeFac', 'codeFac');
    }

    public function professeur()
    {
        return $this->hasOne(professeurModel::class, 'codeProf', 'codeProf');
    }
}
