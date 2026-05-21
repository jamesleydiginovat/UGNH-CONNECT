<?php

namespace App\Livewire\Pages\Finances;

use App\Models\annnee_accademiqueModel;
use App\Models\etudiantModel;
use App\Models\transactionPaiementModel;
use Livewire\Attributes\On;
use Livewire\Component;

class DetailsPage extends Component
{
    public $matriculeEtudiant;
    public $niveauPourDetails;
    
    protected $listeners = [
    'success' => '$refresh',
    'refreshTable'=>'$refresh',
    ];

    public function getAnneAcademiqueProperty(){
        return annnee_accademiqueModel::where('active', true)->first()->libelle;
    }
    #[On('detail-paiement')]  
    public function selectEtudiant($matricule, $niveau){
        $this->matriculeEtudiant=$matricule;
        $this->niveauPourDetails=$niveau;
    }

    public function getTransactionByAnneeProperty()
    {
        return transactionPaiementModel::where('matriculeEtudiant',$this->matriculeEtudiant)
            ->where('anneAccademique', $this->getAnneAcademiqueProperty())
            ->get();
    }

    public function getInformationEtudiantProperty(){
        return etudiantModel::with('faculte')->where('matricule', $this->matriculeEtudiant)->get();
    }


    public function render()
    {
        return view('livewire.pages.finances.details-page');
    }
}
