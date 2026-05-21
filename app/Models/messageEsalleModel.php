<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class messageEsalleModel extends Model
{
    protected $table="messageEsalle_tb";

    protected $fillable = [
        'codeUser',
        'niveau',
        'codeFac',
        'message',
        'anneAcademique'
    ];
}
