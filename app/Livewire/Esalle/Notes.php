<?php

namespace App\Livewire\Esalle;

use App\Models\annnee_accademiqueModel;
use App\Models\bultinEtudiantModel;
use FontLib\Table\Type\name;
use Livewire\Component;

class Notes extends Component
{
    public function anneeAccademiqueActive(){
        return annnee_accademiqueModel::where('active', true)->first();
    }

    public function getBultin($session){
        return bultinEtudiantModel::where('matricule', session('user_code'))
                                    ->where('niveau', session('user_niveau'))
                                    ->where('anneeAcademique', optional($this->anneeAccademiqueActive())->libelle)
                                    ->where('session', $session)
                                    ->value('pdf');
    }


    public function downloadBultin($name){
        $path = storage_path('app/public/pdf/' . $name);

        return response()->download($path);
    }

    public function render()
    {
        return view('livewire.esalle.notes');
    }
}
