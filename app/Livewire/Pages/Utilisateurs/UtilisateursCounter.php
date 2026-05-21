<?php

namespace App\Livewire\Pages\Utilisateurs;

use App\Models\utilisateurModel;
use Livewire\Component;

class UtilisateursCounter extends Component
{
    protected $listeners = [
        'success' => '$refresh',
        'refreshTable'=>'$refresh',
    ];
    public function getTotalUtilisateurProperty()
    {
        return utilisateurModel::count();
    }
    public function getTotalUtilisateurEnLigneProperty()
    {
        return utilisateurModel::where('statut',1)->count();
    }

    public function getTotalUtilisateurHommeProperty()
    {
        return utilisateurModel::where('sexe','M')->count();
    }
    public function render()
    {
        return view('livewire.pages.utilisateurs.utilisateurs-counter');
    }
}
