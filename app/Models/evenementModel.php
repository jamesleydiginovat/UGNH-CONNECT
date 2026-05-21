<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class evenementModel extends Model
{
    protected $table ="evenement_tb";

    protected $fillable = [
        'nom',
        'description',
        'date_debut',
        'date_fin'
    ];
}
