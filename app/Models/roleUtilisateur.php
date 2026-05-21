<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class roleUtilisateur extends Model
{
    use HasFactory;
    protected $table = 'role_utilisateur';
    protected $fillable = [
        'nomUtilisateur',
        'role_id',
        'codeFac'
    ];
}
