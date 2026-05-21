<?php

namespace App\Livewire\Pages\Professeurs;

use App\Models\professeurModel;
use Livewire\Component;

class CounterProfesseur extends Component
{
    protected $listeners = [
        'success' => '$refresh',
        'refreshTable'=>'$refresh',
    ];

    public function getTotalProfesseursProperty()
    {
        return professeurModel::count();
    }

    public function render()
    {
        return view('livewire.pages.professeurs.counter-professeur');
    }
}
