<?php

namespace App\Livewire\Esalle;

use App\Models\etudiantModel;
use Livewire\Component;

class Informations extends Component
{
    // public  $etudiant;

    public function mount()
    {
        
    }


    public function getetudiantProperty(){
        $etudiant = etudiantModel::where(
            'matricule',
            session('user_code')
        )->first();

        // dd($etudiant);
        return $etudiant;
    }
    public function render()
    {
        return view('livewire.esalle.informations');
    }
}
