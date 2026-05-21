<?php

namespace App\Livewire\Pages\Roles;

use App\Events\updatedTable;
use App\Models\permissionModel;
use App\Models\role_permissionModel;
use App\Models\roleModel;
use Illuminate\Support\Facades\Auth;
// use Illuminate\Container\Attributes\DB;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class TableauPermissionEtRoles extends Component
{
    public $role_id;
    public $permission_id;

    protected $listeners = [
        'success' => '$refresh',
        'success-delete'=> '$refresh',
        'refreshTable'=>'$refresh',
    ];

    public function getPermissionsProperty(){
        return permissionModel::all();
    }
    public function getRolesProperty(){
        // return roleModel::all();
        return DB::table('roles as r')
        ->leftJoin('role_permission as rp', 'r.id', '=', 'rp.role_id')
        ->leftJoin('permissions as p', 'p.id', '=', 'rp.permission_id')
        ->select(
            'r.id',
            'r.nom',
            DB::raw('COALESCE(STRING_AGG(p."nomPermission", \' | \'), \'Aucune permission\') as permissions')
        )
        ->groupBy('r.id','r.nom')
        ->orderBy('r.nom')
        ->get();
    }

    public $saveOrDeleteValue;
    public function  saveOrDelete($value){
        $this->saveOrDeleteValue = $value;
    }
    public function save($role_id){
        if($this->saveOrDeleteValue == "save"){
            role_permissionModel::create([
            'role_id' => $role_id,
            'permission_id' => $this->permission_id,
            ]);
            $this->dispatch('success', message: 'Permission ajouté avec succès!');
            $action ="Ajout d'une permission dans un role";
            audit(Auth::user()->personnel->code, $action, $this->permission_id);
            broadcast(new updatedTable(''));
        }
        else{
            role_permissionModel::where('role_id',$role_id)
                                    ->where('permission_id', $this->permission_id)
                                    ->delete();
            broadcast(new updatedTable(''));
        }
        
    }

    public function render()
    {
        return view('livewire.pages.roles.tableau-permission-et-roles');
    }
}
