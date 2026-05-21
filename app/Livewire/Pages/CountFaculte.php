<?php

namespace App\Livewire\Pages;

use App\Models\faculteModel;
use Livewire\Component;

class CountFaculte extends Component
{
    public function getnombreFaculteProperty(){
        return faculteModel::count('id');
    }
    public function render()
    {
        return view('livewire.pages.count-faculte');
    }
}
