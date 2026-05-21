<?php

namespace App\Livewire\Pages;

use App\Models\faculteModel;
use Livewire\Component;

class TableauFaculteEtDecanats extends Component
{
    public $nombreNiveau;
    public $editingId;
    public $nom;
    public $codeFac;

    protected $listeners = [
        'refreshTable'=>'$refresh',
    ];

    public function getFacultesProperty(){
        return faculteModel::all();
    }


    public function edit($id)
    {
        $fac = faculteModel::findOrFail($id);

        $this->editingId = $id;
        $this->nom = $fac->nom;
        $this->codeFac = $fac->codeFac;
        $this->nombreNiveau = $fac->nombreNiveau;
    }


    public function updateFaculte()
    {
        faculteModel::where('id', $this->editingId)
            ->update([
                'nombreNiveau' => $this->nombreNiveau,
            ]);

        // reset mode édition
        $this->editingId = null;

        $this->dispatch('success', message: 'Faculté mise à jour avec succès');
    }

    public function render()
    {
        return view('livewire.pages.tableau-faculte-et-decanats');
    }
}
