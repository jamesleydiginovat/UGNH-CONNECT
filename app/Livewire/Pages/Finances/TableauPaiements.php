<?php

namespace App\Livewire\Pages\Finances;

use App\Models\annnee_accademiqueModel;
use App\Models\faculteModel;
use App\Models\paimentEtudiantModel;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class TableauPaiements extends Component
{
    public $search;
    public $byAnneeAccademique;
    public $byNiveau;
    public $byFaculte;
    public $bySession;
    
    protected $listeners = [
    'success' => '$refresh',
    'refreshTable'=>'$refresh',
    ];

    use WithPagination;
        public function getFacultesProperty()
    {
        $user = Auth::user();

        // 🔐 récupérer le rôle
        $role = $user->roles()->first();

        // 🧹 nettoyer codeFac
        $codeFac = null;

        if ($role && $role->pivot) {
            $value = trim($role->pivot->codeFac);

            if (!empty($value) && !in_array($value, ['null', '[null]'])) {
                $codeFac = $value;
            }
        }

        // 📦 requête de base
        $query = faculteModel::query();

        // 🔐 filtrage automatique par faculté (doyen, vice, etc.)
        $query->when($codeFac, function ($q) use ($codeFac) {
            $q->where('codeFac', 'ILIKE', "%{$codeFac}%");
        });

        return $query->orderBy('id', 'ASC')->get();
    }

    public function anneeAccademiqueActive(){
        return annnee_accademiqueModel::where('active', true)->first();
    }

    public function getAnneeAccademiqueProperty(){
        return annnee_accademiqueModel::orderBy('id', 'DESC')->get();
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

    public function getPaiementsProperty()
    {
        $query = paimentEtudiantModel::join('faculte_prices', function($join) {
                $join->on('paiement_etudiants.codeFaculte', '=', 'faculte_prices.codeFac')
                    ->on('paiement_etudiants.niveau', '=', 'faculte_prices.niveau')
                    ->on('paiement_etudiants.session', '=', 'faculte_prices.session');
            })
            ->join('etudiants_tb', 'paiement_etudiants.matriculeEtudiant', '=', 'etudiants_tb.matricule')
            ->select(
                'paiement_etudiants.*',
                'faculte_prices.premierVersement as prixVersement1',
                'faculte_prices.deuxiemeVersement as prixVersement2',
                'faculte_prices.troisiemeVersement as prixVersement3',
                'faculte_prices.prixTotal',
                'etudiants_tb.*'
            )
            ->where('etudiants_tb.status', 'Etudiant');

        // 🔎 SEARCH
        if ($this->search != "") {
            $query->where(function ($q) {
                $q->where('etudiants_tb.nom', 'ILIKE', "%{$this->search}%")
                ->orWhere('etudiants_tb.prenom', 'ILIKE', "%{$this->search}%")
                ->orWhere('etudiants_tb.matricule', 'ILIKE', "%{$this->search}%");
            });
        }

        // 📅 ANNÉE
        $annee = $this->byAnneeAccademique != ""
            ? $this->byAnneeAccademique
            : $this->anneeAccademiqueActive()->libelle;

        $query->where('paiement_etudiants.anneAccademique', $annee);

        // 🎯 FILTRES MANUELS
        $query->when($this->byNiveau != "", function ($q) {
            $q->where('paiement_etudiants.niveau', $this->byNiveau);
        });

        $query->when($this->byFaculte != "", function ($q) {
            $q->where('paiement_etudiants.codeFaculte', $this->byFaculte);
        });

        $query->when($this->bySession != "", function ($q) {
            $q->where('paiement_etudiants.session', $this->bySession);
        });

        // 🔐 FILTRE AUTOMATIQUE PAR RÔLE (DOYEN / VICE / SECRETAIRE)
        $query->when($this->getCodeFac(), function ($q) {
            $q->where('paiement_etudiants.codeFaculte', $this->getCodeFac());
        });

        return $query
            ->orderBy('paiement_etudiants.updated_at', 'desc')
            ->paginate(10);
    }
    public function sessionDetail($matricule, $niveau){
        $this->dispatch('detail-paiement', matricule: $matricule, niveau:$niveau);
        
    }

    public function render()
    {
        return view('livewire.pages.finances.tableau-paiements');
    }
}
