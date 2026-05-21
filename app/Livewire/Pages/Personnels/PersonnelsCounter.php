<?php

namespace App\Livewire\Pages\Personnels;

use App\Models\personnelsModel;
use Livewire\Component;

class PersonnelsCounter extends Component
{

    protected $listeners = [
        'refreshTable'=>'$refresh',
        'success' => '$refresh',
        'success-delete'=>'$refresh',
    ];
    public function getTotalPersonnelsProperty()
    {
        return personnelsModel::where('status','Active')->count();
    }
    public function getTotalPersonnelsFemmeProperty()
    {
        return personnelsModel::where('status','Active')->where('sexe','F')->count();
    }

    public function getTotalPersonnelsHommeProperty()
    {
        return personnelsModel::where('status','Active')->where('sexe','M')->count();
    }

    public function render()
    {
        return view('livewire.pages.personnels.personnels-counter');
    }
}
