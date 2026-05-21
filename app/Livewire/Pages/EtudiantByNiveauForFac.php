<?php

namespace App\Livewire\Pages;

use App\Models\etudianFaculteModel;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class EtudiantByNiveauForFac extends Component
{
    public function render()
    {
        return view('livewire.pages.etudiant-by-niveau-for-fac');
    }
}
