<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class utilisateurModel extends Authenticatable
{
     use Notifiable;

    protected $table = 'utilisateurs_tb';
    
    protected $fillable = [
        'codePersonnel',
        'nomUtilisateur', // correspond à ton "username"
        'motDePasse',
        'statut',
        'etat',
    ];

    protected $hidden = [
        'motDePasse',
    ];

    // Relation avec le personnel
    public function personnel()
    {
        return $this->belongsTo(personnelsModel::class, 'codePersonnel', 'code');
    }

    // Indiquer à Laravel où se trouve le mot de passe
    public function getAuthPassword()
    {
        return $this->motDePasse;
    }

    public function roles()
    {
        return $this->belongsToMany(roleModel::class, 'role_utilisateur','nomUtilisateur','role_id', 'nomUtilisateur','id')->withPivot('codeFac');;
    }
 
    public function hasRole($roleName)
    {
        // Vérifie si l'utilisateur connecté a le rôle donné
        return $this->roles->contains('nom', $roleName);
    }

    public function hasPermission($permission)
    {
        foreach ($this->roles as $role) {
            if ($role->permissions->contains('nomPermission', $permission)) {
                return true;
            }
        }

        return false;
    }



}
