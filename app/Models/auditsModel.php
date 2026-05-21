<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class auditsModel extends Model
{
     protected $table ="audits_tb";

    protected $fillable = [
        'code',
        'action',
        'record_code',
        'ip_address',
        'notificable'
    ];
}
