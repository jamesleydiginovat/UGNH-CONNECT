<?php

namespace App\Livewire\Pages\Pdf;

use Livewire\Component;

class ListePeronnel extends Component
{  
    public $titre ="jamesley Philippe";
    public function render()
    {
        return view('livewire.pages.pdf.liste-peronnel');
    }
}
