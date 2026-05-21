<?php

namespace App\Livewire\Pages\AnneeAccademique;

use App\Models\annnee_accademiqueModel;
use App\Models\evenementModel;
use Livewire\Component;
use Livewire\WithPagination;

class AnneeAccademique extends Component
{
    use WithPagination;
    protected $listeners = [
        'refreshTable'=>'$refresh',
        'success'=>'$refresh',
    ];

    public function getEvenementProperty(){
        return evenementModel::all();
    }

    public $editEventId = null;
    public $editDateDebut;
    public $editDateFin;


    public function startEdit($id, $debut, $fin)
    {
        $this->editEventId = $id;
        $this->editDateDebut = $debut;
        $this->editDateFin = $fin;
    }


    public function updateEvent($id)
    {
        $event = evenementModel::find($id);

        if (!$event) return;

        $event->update([
            'date_debut' => $this->editDateDebut,
            'date_fin' => $this->editDateFin,
        ]);

        $this->editEventId = null;

        $this->dispatch('success', message: 'Événement mis à jour avec succès');
    }

    public function getAnneeAcademiqueProperty(){
        return annnee_accademiqueModel::paginate(5);
    }
    public function render()
    {
        return view('livewire.pages.annee-accademique.annee-accademique');
    }
}
