<?php

namespace App\Livewire\Pages\Roles;

use App\Events\updatedTable;
use App\Models\roleModel;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class CreateRoles extends Component
{
    public $roleName;

    // fonksyon pour mete kontrent sou champ yo nan formulaire lan
    public function rules(){
        return [
        'roleName' => 'required|min:3|regex:/^[A-Za-zÀ-ÿ\s]+$/|unique:roles,nom',
        
        ];
    }
    // se isi a mwen personalize message erreur yo pou le gn yon erreur ki fet nn programme lan pou tel ou tel erreur afficher
     protected $messages = [
        'roleName.min' => 'Le nom est trop court',
        'roleName.required' => 'Le nom est obligatoire',
        'roleName.unique'=>'Ce role exite deja',
    ];

    public function resetForm(){

            $this->reset([
            'roleName',
            
        ]);
    }

    public function save(){

    $validatedData = $this->validate();
    
    roleModel::create([
        'nom' => $this->roleName
    ]);

    
    $this->dispatch('success-role', message: "Role ajoute avec succes");
    $action ="Creation d'un role";
    audit(Auth::user()->personnel->code, $action, $this->roleName);
    broadcast(new updatedTable(''));
    $this->resetForm();
        
    }
    public function render()
    {
        return view('livewire.pages.roles.create-roles');
    }
}
