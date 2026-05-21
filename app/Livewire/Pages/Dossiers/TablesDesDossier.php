<?php

namespace App\Livewire\Pages\Dossiers;

use App\Models\etudianFaculteModel;
use App\Models\etudiantModel;
use App\Models\faculteModel;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class TablesDesDossier extends Component
{
    public $byFaculte;
    public $byNiveau;
    public $byStatus;
    public $search;

    protected $listeners = [
    'success' => '$refresh',
    'refreshTable'=>'$refresh',
    ];

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


    public function getDossierEtudiantsProperty()
    {
        $query = etudiantModel::with('faculte');

        // 🔍 Recherche
        $query->when($this->search != "", function ($q) {

            $search = '%' . $this->search . '%';

            $q->where(function ($query) use ($search) {

                $query->where('matricule', 'ILIKE', $search)
                    ->orWhere('nom', 'ILIKE', $search)
                    ->orWhere('prenom', 'ILIKE', $search);

            });

        });

        // 🎯 Filtre statut
        if ($this->byStatus != "") {
            $query->where('status', $this->byStatus);
        } else {
            $query->where('status', 'Etudiant');
        }

        // 🎯 Filtre niveau
        $query->when($this->byNiveau != "", function ($q) {
            $q->where('niveau', $this->byNiveau);
        });


        $query->when($this->byFaculte != "" && $this->byStatus == "Postulant", function ($q) {
            $q->where('status', $this->byStatus);
            $q->where('codeFac', $this->byFaculte);
        });

        // 🎯 Filtre faculté
        $query->when($this->byFaculte != "" && $this->byStatus != "Postulant", function ($q) {
            $q->whereHas('faculte', function ($fac) {
                $fac->where('codeFac', $this->byFaculte);
            });
        });

        return $query
            ->latest()
            ->get();
    }


    public function DossierEtudiant($id){
         $this->dispatch('dossier-etudiant', id: $id);
    }


    public function render()
    {
        return view('livewire.pages.dossiers.tables-des-dossier');
    }
}
