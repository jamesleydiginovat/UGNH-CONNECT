<?php

namespace App\Livewire\Esalle;

use App\Models\annnee_accademiqueModel;
use App\Models\facultes_prices;
use App\Models\transactionPaiementModel;
use Livewire\Component;
use Livewire\WithPagination;

class SituationFinancier extends Component
{
     use WithPagination;
    public function fraisDejaPaye(){
        return transactionPaiementModel::where('matriculeEtudiant', session('user_code'))->SUM('montant');
    }


    public function fraisRester($session){
        $fraisScolarite = facultes_prices::where('codeFac', session('user_codeFac'))
                                            ->where('niveau', session('user_niveau'))
                                            ->where('session', $session)
                                            ->first();
        return $fraisScolarite;
    }

    public function anneeAccademiqueActive(){
        return annnee_accademiqueModel::where('active', true)->first();
    }

    public function gethistoriqueTransactionProperty(){
         return transactionPaiementModel::where('matriculeEtudiant', session('user_code'))
                                          ->where('anneAccademique', $this->anneeAccademiqueActive()->libelle ?? "")
                                          ->paginate(10);
    }
    public function render()
    {
        return view('livewire.esalle.situation-financier');
    }
}
