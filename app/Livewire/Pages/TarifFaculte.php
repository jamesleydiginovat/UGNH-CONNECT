<?php

namespace App\Livewire\Pages;

use App\Models\faculteModel;
use App\Models\facultes_prices;
use Livewire\Component;

class TarifFaculte extends Component
{
    public function getTarifFaculteProperty(){
        return facultes_prices::all();
    }

    public function nomFac($codeFac){
        return faculteModel::where('codeFac', $codeFac)->value('nom');
    }
    public function render()
    {
        return view('livewire.pages.tarif-faculte');
    }
}
