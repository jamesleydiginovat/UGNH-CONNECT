<?php

namespace App\Livewire\Pages\NotesEvaluation;

use Illuminate\Support\Facades\DB;
use Livewire\Component;

class CountNotes extends Component
{
    protected $listeners = [
    'success'=>'$refresh',
    'refreshTable'=>'$refresh',
    ];
    
    public $periodeOuverte;
    public function periodeOuverte()
    {
        return DB::table('evenement_tb')
            ->where('nom', 'Saisie Notes Session 1')
            ->where('date_debut', '<=', now())
            ->where('date_fin', '>=', now())
            ->exists();
    }

    public function mount()
    {
        $this->periodeOuverte = $this->periodeOuverte();
    }
    
    public function render()
    {
        return view('livewire.pages.notes-evaluation.count-notes');
    }
}
