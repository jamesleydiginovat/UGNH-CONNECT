<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class roleModel extends Model
{
    use HasFactory;
    protected $table = 'roles';
    protected $fillable = [
        'nom',
    ];


    public function permissions()
    {
        return $this->belongsToMany(
            permissionModel::class,
            'role_permission',
            'role_id',
            'permission_id'
        );
    }
}
