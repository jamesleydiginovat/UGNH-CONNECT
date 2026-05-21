<?php

namespace App\Livewire\Pages;

use App\Models\annnee_accademiqueModel;
use App\Models\transactionPaiementModel;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class TransactionByFaculte extends Component
{
    public $chartData = [];

    public $anneeAcademique;
    public function anneeAccademiqueActive(){
        return annnee_accademiqueModel::where('active', true)->first();
    }
    public function loadTransactionsByFaculte()
    {  
        
    }


    public function mount(){
        $this->chartData = transactionPaiementModel::query()

            // 🔥 filtre année académique
            ->where('anneAccademique', optional($this->anneeAccademiqueActive())->libelle)

            // 🔥 regroupement par faculté
            ->select(
                'codeFaculteEtudiant',
                DB::raw('SUM(montant) as total')
            )

            ->groupBy('codeFaculteEtudiant')

            ->orderBy('total', 'desc')

            ->pluck('total', 'codeFaculteEtudiant')

            ->toArray();

            // dd($this->chartData);
    }
    public function render()
    {
        return view('livewire.pages.transaction-by-faculte');
    }
}
