<?php

namespace App\Livewire\Pages\Finances;

use App\Models\annnee_accademiqueModel;
use App\Models\paimentEtudiantModel;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class CountPaiementEtudiants extends Component
{
    protected $listeners = [
    'success' => '$refresh',
    'refreshTable'=>'$refresh',
    ];
    
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

    public function getSommePaiementRecusProperty()
    {
        return paimentEtudiantModel::where('anneAccademique', $this->anneeAccademiqueActive()->libelle)
            ->where('statut', 'Valide')

            // 🔐 filtre automatique par faculté (doyen, etc.)
            ->when($this->getCodeFac(), function ($q) {
                $q->where('codeFaculte', $this->getCodeFac());
            })

            ->sum('total');
    }

    public function render()
    {
        return view('livewire.pages.finances.count-paiement-etudiants');
    }
}
