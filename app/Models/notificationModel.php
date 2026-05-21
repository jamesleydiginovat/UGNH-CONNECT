<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class notificationModel extends Model
{
    protected $table = 'notification_tb';
    
    protected $fillable = [
        'notification_id',
        'user_id',
        'message'
    ];
}
