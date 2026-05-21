<?php

namespace App\Livewire\Pages\Pdf;

use App\Models\personnelsModel;
use Barryvdh\Snappy\Facades\SnappyPdf as PDF;
use Livewire\Attributes\On;
use Livewire\Component;

class Liste extends Component
{
    
    public function getListePersonnelProperty(){
        return personnelsModel::all();
    }
    public function render()
    {
        return view('livewire.pages.pdf.liste');
    }
}
