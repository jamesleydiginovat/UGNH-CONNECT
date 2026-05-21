<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class documentsModel extends Model
{
    protected $table ="documents_tb";
    
    protected $fillable = [
        'nom',
        'utilisateurs',
        'anneeAcademique'
    ];
}
