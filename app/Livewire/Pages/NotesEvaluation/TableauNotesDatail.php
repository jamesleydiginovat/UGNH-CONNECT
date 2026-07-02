<?php

namespace App\Livewire\Pages\NotesEvaluation;

use App\Events\updatedTable;
use App\Models\annnee_accademiqueModel;
use App\Models\coursModel;
use App\Models\faculteModel;
use App\Models\noteModel;
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
    public $nombreReprises;


    public $matricule;
    public $codeCours;
    public $codeFac;
    public $niveaux;
    public $sessions;
    public $noteIntra = null;
    public $examenFinal = null;
    public $noteRattrapage = null;

    public function putNOte($inta, $examenFinal, $rattrapage,$codeCours, $matricule, $codeFac, $niveau, $session){
        $this->noteIntra = $inta;
        $this->examenFinal = $examenFinal;
        $this->noteRattrapage = $rattrapage;
        $this->codeCours= $codeCours;
        $this->matricule = $matricule;
        $this->codeFac = $codeFac;
        $this->niveaux = $niveau;
        $this->sessions = $session;
    }

    public function isNoteExiste(){
        return noteModel::where('matriculeEtudiant', $this->matricule)
                          ->where('codeCours', $this->codeCours)
                          ->where('anneeAcademique', $this->anneeAccademiqueActive()->libelle)
                          ->exists();
    }


    public function updateNote()
    {
        if($this->isNoteExiste()){
            // dd($this->noteIntra);
            $this->validate([
                'noteIntra'       => 'required|numeric|min:0|max:30',
                'examenFinal'     => 'nullable|numeric|min:0|max:70',
                'noteRattrapage'  => 'nullable|numeric|min:0|max:100',
            ], [
                'noteIntra.required'      => 'La note Intra est obligatoire.',
                'noteIntra.numeric'       => 'La note Intra doit être un nombre.',
                'noteIntra.min'           => 'La note Intra ne peut pas être négative.',
                'noteIntra.max'           => 'La note Intra ne peut pas dépasser 30.',

                // 'examenFinal.required'    => 'La note de l\'examen final est obligatoire.',
                'examenFinal.numeric'     => 'La note de l\'examen final doit être un nombre.',
                'examenFinal.min'         => 'La note de l\'examen final ne peut pas être négative.',
                'examenFinal.max'         => 'La note de l\'examen final ne peut pas dépasser 70.',

                'noteRattrapage.numeric'  => 'La note de rattrapage doit être un nombre.',
                'noteRattrapage.min'      => 'La note de rattrapage ne peut pas être négative.',
                'noteRattrapage.max'      => 'La note de rattrapage ne peut pas dépasser 100.',
            ]);

            $note = noteModel::where('matriculeEtudiant', $this->matricule)
                ->where('codeCours', $this->codeCours)
                ->where('anneeAcademique', $this->anneeAccademiqueActive()->libelle)
                ->first();

            if ($note) {
                $note->update([
                    'noteIntra' => $this->noteIntra,
                    'examenFinal' => $this->examenFinal,
                    'noteRattrapage' => $this->noteRattrapage,
                ]);
            }

            broadcast(new updatedTable(''));

            $action = "Modification d'une note";
            audit(Auth::user()->personnel->code, $action, $this->codeCours);

            session()->flash('successM', 'Note mise à jour avec succès.');
        }
        else{

           $this->validate([
                'noteIntra'       => 'required|numeric|min:0|max:30',
                'examenFinal'     => 'nullable|numeric|min:0|max:70',
                'noteRattrapage'  => 'nullable|numeric|min:0|max:100',
            ], [
                'noteIntra.required'      => 'La note Intra est obligatoire.',
                'noteIntra.numeric'       => 'La note Intra doit être un nombre.',
                'noteIntra.min'           => 'La note Intra ne peut pas être négative.',
                'noteIntra.max'           => 'La note Intra ne peut pas dépasser 30.',

                // 'examenFinal.required'    => 'La note de l\'examen final est obligatoire.',
                'examenFinal.numeric'     => 'La note de l\'examen final doit être un nombre.',
                'examenFinal.min'         => 'La note de l\'examen final ne peut pas être négative.',
                'examenFinal.max'         => 'La note de l\'examen final ne peut pas dépasser 70.',

                'noteRattrapage.numeric'  => 'La note de rattrapage doit être un nombre.',
                'noteRattrapage.min'      => 'La note de rattrapage ne peut pas être négative.',
                'noteRattrapage.max'      => 'La note de rattrapage ne peut pas dépasser 100.',
            ]);
            
            noteModel::create([
                'matriculeEtudiant' =>$this->matricule,
                'codeFac'=>$this->codeFac,
                'codeCours'=>$this->codeCours,
                'niveau'=>$this->niveaux,
                'session'=>$this->sessions,
                'anneeAcademique'=>$this->anneeAccademiqueActive()->libelle,
                'noteIntra'=>$this->noteIntra ,
                'examenFinal'=>$this->examenFinal
            ]);
                session()->flash('successM', 'Note Ajouter avec succes');
                 broadcast(new updatedTable(''));
                 $action ="Enregistrement d'une note";
                 audit(Auth::user()->personnel->code, $action, $this->codeCours);
        }
        
    }

    public function clearFlash()
    {
        session()->forget('successM');
    }

    public function anneeAccademiqueActive(){
        return annnee_accademiqueModel::where('active', true)->first();
    }

    public $periodeOuverte;
    public function periodeOuverte1()
    {
        return DB::table('evenement_tb')
            ->where('nom', 'Saisie Notes Session 1')
            ->where('date_debut', '<=', now())
            ->where('date_fin', '>=', now())
            ->exists();
    }

    public function periodeOuverte2()
    {
        return DB::table('evenement_tb')
            ->where('nom', 'Saisie Notes Session 2')
            ->where('date_debut', '<=', now())
            ->where('date_fin', '>=', now())
            ->exists();
    }
    
    public function mount()
    {
        $this->faculte = faculteModel::first()->codeFac ?? null;
        $this->niveau = 1;
        $periode1 = $this->periodeOuverte1();
        $periode2 = $this->periodeOuverte2();

        if ($periode1) {
            $this->periodeOuverte = $periode1 ;
            $this->session = 1;
        } elseif ($periode2) {
            $this->periodeOuverte = $periode2;
            $this->session = 2;
        } else {
            $this->session = null; // ou 1 selon votre besoin
        }
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
