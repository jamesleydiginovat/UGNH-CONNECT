<?php

namespace App\Livewire\Pages\Finances;

use App\Models\annnee_accademiqueModel;
use App\Models\transactionPaiementModel;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class HistoriqueTransaction extends Component
{
    protected $listeners = [
    'success' => '$refresh',
    'refreshTable'=>'$refresh',
    ];
    public $rechercherTransaction;
    use WithPagination;
    public function anneeAccademiqueActive(){
        return annnee_accademiqueModel::where('active', true)->first();
    }
    private function getCodeFac()
    {
        $user = Auth::user();
        $role = $user->roles()->first();

        $value = $role?->pivot?->codeFac;

        if (!empty($value) && !in_array($value, ['null', '[null]'])) {
            return trim($value);
        }

        return null;
    }

    public function getHistoriqueTransactionProperty()
    {
        return transactionPaiementModel::where('anneAccademique', $this->anneeAccademiqueActive()->libelle)

            // 🔎 recherche transaction
            ->when($this->rechercherTransaction != "", function ($q) {
                $q->where('numeroTransaction', 'ILIKE', "%{$this->rechercherTransaction}%");
            })

            // 🔐 filtre automatique par faculté (doyen, etc.)
            ->when($this->getCodeFac(), function ($q) {
                $q->where('codeFaculteEtudiant', $this->getCodeFac());
            })

            ->orderBy('created_at', 'desc')
            ->paginate(15);
    }
    public function render()
    {
        return view('livewire.pages.finances.historique-transaction');
    }
}
