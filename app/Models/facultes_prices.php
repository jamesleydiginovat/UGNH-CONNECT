<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class facultes_prices extends Model
{
    protected $table="faculte_prices";
    protected $fillable = [
    'codeFac',
    'session',
    'niveau',
    'premierVersement',
    'deuxiemeVersement',
    'troisiemeVersement',
    'prixTotal',
];
}
