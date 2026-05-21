<?php

namespace App\Livewire\Pages\NotesEvaluation;

use App\Models\annnee_accademiqueModel;
use App\Models\faculteModel;
use App\Models\noteModel;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class TableauNotes extends Component
{
    public $codeFac;
    public $niveau;
    public $session='1';
    public $anneAcademique;

    public $search;

    protected $listeners = [
    'successNote' => 'refreshtableau',
    'refreshTable'=>'$refresh',
    ];
    public function refreshtableau(){
        $this->getLesNotesProperty();
    }
    
    public function anneeAccademiqueActive(){
        return annnee_accademiqueModel::where('active', true)->first();
    }

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

    public function getLesNotesProperty()
    {
        $annee = $this->anneeAccademiqueActive()->libelle;

        $query = noteModel::with(['faculte', 'etudiant'])
            ->where(
                'anneeAcademique',
                $this->anneAcademique != "" ? $this->anneAcademique : $annee
            );

        // 🎯 filtre faculté manuel
        $query->when($this->codeFac != "", function ($q) {
            $q->where('codeFac', $this->codeFac);
        });

        // 🎯 filtre niveau
        $query->when($this->niveau != "", function ($q) {
            $q->where('niveau', $this->niveau);
        });

        // 🎯 filtre session
        $query->when($this->session != "", function ($q) {
            $q->where('session', $this->session);
        });

        // 🔍 recherche
        $query->when($this->search != "", function ($q) {

            $search = '%' . $this->search . '%';

            $q->where(function ($query) use ($search) {

                // recherche matricule
                $query->where('matriculeEtudiant', 'ILIKE', $search)

                    // recherche dans relation étudiant
                    ->orWhereHas('etudiant', function ($etd) use ($search) {
                        $etd->where('nom', 'ILIKE', $search)
                            ->orWhere('prenom', 'ILIKE', $search);
                    });

            });

        });

        // 🔐 filtre automatique par rôle
        $query->when($this->getCodeFac(), function ($q) {
            $q->where('codeFac', $this->getCodeFac());
        });

        return $query
            ->latest()
            ->get()
            ->groupBy('matriculeEtudiant');
    }


    public function sessionNoteByEtudiant($matricule, $niveau, $codeFac){
        $this->dispatch('noteByEtudiant', matricule: $matricule, niveau: $niveau, codeFac: $codeFac);
    }

    public function render()
    {
        return view('livewire.pages.notes-evaluation.tableau-notes');
    }
}
