<?php

namespace App\Livewire\Esalle\Inclus;

use App\Models\etudiantModel;
use App\Models\professeurModel;
use Livewire\Component;

class Sidebar extends Component
{
    public function nomProf($codeProf)
    {
        $prof = professeurModel::where('codeProf', $codeProf)->first();

        return trim(optional($prof)->nom . ' ' . optional($prof)->prenom) ?: 'Professeur inconnu';
    }
    

    public function nomEtudiant($code)
    {
        $etudiant = etudiantModel::where('matricule', $code)->where('status', 'Etudiant')->first();

        return trim(optional($etudiant)->nom . ' ' . optional($etudiant)->prenom) ?: 'Etudiant inconnu';
    }
    public function render()
    {
        return view('livewire.esalle.inclus.sidebar');
    }
}
