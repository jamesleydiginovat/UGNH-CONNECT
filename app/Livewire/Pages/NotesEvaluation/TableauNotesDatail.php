<?php

namespace App\Livewire\Pages\NotesEvaluation;

use App\Models\annnee_accademiqueModel;
use App\Models\coursModel;
use App\Models\faculteModel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class TableauNotesDatail extends Component
{
     protected $listeners = [
        'successNote' => 'refreshtableau',
        'refreshTable'=>'$refresh',
    ];
    
    public $faculte;
    public $niveau;
    public $session;

    public function anneeAccademiqueActive(){
        return annnee_accademiqueModel::where('active', true)->first();
    }

    public $periodeOuverte;
    public function periodeOuverte()
    {
        return DB::table('evenement_tb')
            ->where('nom', 'Saisie Notes Session 1')
            ->where('date_debut', '<=', now())
            ->where('date_fin', '>=', now())
            ->exists();
    }
    
    public function mount()
    {
        $this->faculte = faculteModel::first()->codeFac ?? null;
        $this->niveau = 1;
        $this->session = 1;
        $this->periodeOuverte = $this->periodeOuverte();
    }

    public function getCoursProperty()
    {
        return coursModel::where('codeFac', $this->faculte ?? faculteModel::first()->codeFac)
            ->where('niveau', $this->niveau ?? 1)
            ->where('session', $this->session ?? 1)
            ->get();
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

    public function getFacultesNameProperty(){
        return faculteModel::where('codeFac', $this->faculte)->first();
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

    public function getNoteDetailProperty()
    {
        $annee = optional($this->anneeAccademiqueActive())->libelle;

        $query = DB::table('notes')
            ->join('etudiants_tb', 'notes.matriculeEtudiant', '=', 'etudiants_tb.matricule')
            ->join('cours_tb', 'notes.codeCours', '=', 'cours_tb.codeCours');

        // 🎯 filtre faculté manuel
        $query->when($this->faculte ?? null, function ($q) {
            $q->where('notes.codeFac', $this->faculte);
        });

        // 🎯 filtre niveau
        $query->when($this->niveau ?? null, function ($q) {
            $q->where('notes.niveau', $this->niveau);
        });

        // 🎯 filtre session
        $query->when($this->session ?? null, function ($q) {
            $q->where('notes.session', $this->session);
        });

        // 📅 année académique
        $query->when($annee, function ($q) use ($annee) {
            $q->where('notes.anneeAcademique', $annee);
        });

        // 🔐 filtre automatique par rôle (doyen, vice, etc.)
        $query->when($this->getCodeFac(), function ($q) {
            $q->where('notes.codeFac', $this->getCodeFac());
        });

        $notes = $query->select(
                'etudiants_tb.matricule',
                'cours_tb.codeCours as coursCode',
                'cours_tb.nom',
                'notes.*'
            )
            ->get();

        return $notes->groupBy('matricule');
    }
    public function render()
    {
        return view('livewire.pages.notes-evaluation.tableau-notes-datail');
    }
}
