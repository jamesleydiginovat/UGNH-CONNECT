<?php

namespace App\Livewire\Pages;

use App\Models\annnee_accademiqueModel;
use App\Models\fichePaiementEtudiant;
use Livewire\Component;
use Livewire\WithPagination;

class FicheTransaction extends Component
{
    use WithPagination;
    public $search;
    protected $listeners = [
    'refreshTable'=>'$refresh',
    ];


    public function voirLePdf($codeTransaction)
    {   
        $fichier = fichePaiementEtudiant::where('codeTransaction', $codeTransaction)->value('pdf');
        $path = asset('storage/pdf/' . $fichier);
        $this->dispatch('oppen-df', url: $path);
        
    }

    public function anneeAccademiqueActive(){
        return annnee_accademiqueModel::where('active', true)->first();
    }

    public function getFicheTransactionProperty()
    {
        if($this->search !=""){
           return fichePaiementEtudiant::where('anneAcademique',optional($this->anneeAccademiqueActive())->libelle)
                                        ->where(function ($q) {
                                            $q->where('matricule', 'ILIKE', "%{$this->search}%")
                                            ->orWhere('codeTransaction', 'ILIKE', "%{$this->search}%");
                                        })
                                        ->latest()
                                        ->paginate(20);
        }
        else{
            return fichePaiementEtudiant::where('anneAcademique',optional($this->anneeAccademiqueActive())->libelle)
                                        ->latest()
                                        ->paginate(20);
        }
        
        
    }
    public function render()
    {
        return view('livewire.pages.fiche-transaction');
    }
}
