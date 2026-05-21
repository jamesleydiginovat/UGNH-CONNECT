<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class etudiant_password extends Model
{
    protected $table="passwordEtudiant";

    protected $fillable = [
        'matricule',
        'password'
    ];
}
