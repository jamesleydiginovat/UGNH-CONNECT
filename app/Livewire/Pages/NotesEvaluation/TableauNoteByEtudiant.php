<?php

namespace App\Livewire\Pages\NotesEvaluation;

use App\Events\updatedTable;
use App\Models\annnee_accademiqueModel;
use App\Models\bultinEtudiantModel;
use App\Models\etudiantModel;
use App\Models\faculteModel;
use App\Models\paimentEtudiantModel;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\On;
use Livewire\Component;
use Barryvdh\Snappy\Facades\SnappyPdf as PDF;

class TableauNoteByEtudiant extends Component
{
    protected $listeners = [
    'success'=>'$refresh',
    'refreshTable'=>'$refresh',
    ];
    
    public function anneeAccademiqueActive(){
        return annnee_accademiqueModel::where('active', true)->first();
    }
    public $matricule, $niveau, $codeFac;

    #[On('noteByEtudiant')]
    public function lesValeurs($matricule, $niveau, $codeFac){
        $this->matricule =$matricule;
        $this->niveau =$niveau;
        $this->codeFac=$codeFac ?? '';
    }

    public function getInfosEtudiantProperty(){
        return etudiantModel::with('faculte')->where('matricule', $this->matricule)->get();
    }
    public $annee;
    public function getNoteByEtudiantProperty(){

        // $faculte = $this->faculte ?? faculteModel::first()->codeFac;
        $this->annee = optional($this->anneeAccademiqueActive())->libelle;

        $notes = DB::table('cours_tb')
                    ->leftJoin('notes', function ($join) {
                        $join->on('cours_tb.codeCours', '=', 'notes.codeCours')
                            ->where('notes.matriculeEtudiant', $this->matricule) 
                            ->where('notes.niveau', $this->niveau)
                            ->where('notes.anneeAcademique', $this->annee)
                            ->where('notes.codeFac', $this->codeFac);
                    })

                    ->where('cours_tb.codeFac', $this->codeFac) 
                    ->where('cours_tb.niveau', $this->niveau)

                    ->select(
                        'cours_tb.codeCours as coursCode',
                        'cours_tb.nom',
                        'cours_tb.session',
                        'notes.noteIntra',
                        'notes.examenFinal',
                        'notes.noteRattrapage',
                        'notes.matriculeEtudiant',
                        'notes.niveau',
                        'notes.codeFac',
                    )
                    ->get();

        return $notes->groupBy('session');
        // dd($notes->groupBy('session'));
    }


    public function getMention($note)
    {
        if ($note >= 85) return 'Très Bien';
        if ($note >= 75) return 'Bien';
        if ($note >= 65) return 'Assez Bien';
        if ($note >= 50) return 'Passable';
        
        return 'Échec';
    }

    public function getNombreNiveauProperty(){
        return faculteModel::where('codeFac', $this->codeFac)->first();
    }


    public function isNoteComplet(){
        $noteManquante = DB::table('cours_tb')
                        ->leftJoin('notes', function ($join) {
                            $join->on('cours_tb.codeCours', '=', 'notes.codeCours')
                                ->where('notes.matriculeEtudiant', $this->matricule)
                                ->where('notes.niveau', $this->niveau)
                                ->where('notes.anneeAcademique', $this->annee)
                                ->where('notes.codeFac', $this->codeFac);
                        })
                        ->where('cours_tb.codeFac', $this->codeFac)
                        ->where('cours_tb.niveau', $this->niveau)
                        ->where(function ($q) {
                            $q->whereNull('notes.noteIntra')
                            ->orWhereNull('notes.examenFinal');
                        })
                        ->exists();

        return $noteManquante;
    }


    public function isSession1CompleteAndSession2Empty()
    {
        /*
        |-----------------------------------------------------------
        | Vérifier si Session 1 est complète
        |-----------------------------------------------------------
        */

        $session1Incomplete = DB::table('cours_tb')
            ->leftJoin('notes', function ($join) {

                $join->on('cours_tb.codeCours', '=', 'notes.codeCours')
                    ->where('notes.matriculeEtudiant', $this->matricule)
                    ->where('notes.niveau', $this->niveau)
                    ->where('notes.anneeAcademique', $this->annee)
                    ->where('notes.codeFac', $this->codeFac)
                    ->where('notes.session', 1);

            })

            ->where('cours_tb.codeFac', $this->codeFac)
            ->where('cours_tb.niveau', $this->niveau)
            ->where('cours_tb.session', 1)

            ->where(function ($q) {
                $q->whereNull('notes.noteIntra')
                ->orWhereNull('notes.examenFinal');
            })

            ->exists();



        /*
        |-----------------------------------------------------------
        | Vérifier si Session 2 est vide
        |-----------------------------------------------------------
        */

        $session2HasNotes = DB::table('notes')
            ->where('matriculeEtudiant', $this->matricule)
            ->where('niveau', $this->niveau)
            ->where('anneeAcademique', $this->annee)
            ->where('codeFac', $this->codeFac)
            ->where('session', 2)

            ->where(function ($q) {
                $q->whereNotNull('noteIntra')
                ->orWhereNotNull('examenFinal');
            })

            ->exists();



        /*
        |-----------------------------------------------------------
        | Retour
        |-----------------------------------------------------------
        */

        return !$session1Incomplete && !$session2HasNotes;
    }

    public function isDejaAdmisOrNot(){
        return  etudiantModel::where('matricule', $this->matricule)->value('admisOrNot');
    }
    public $admisOrNot;

    // public function isAdmisOrNot($value){
    //     $this->admisOrNot = $value;
    // }
    public function export()
    {
        // P1. Récupération sécurisée des données
        $etudiants = $this-> getInfosEtudiantProperty();
        $notes = $this->getNoteByEtudiantProperty();
        $anneAcademique = optional($this->anneeAccademiqueActive())->libelle;
        $niveau = $this->niveau;
        $admisOrNot = $this->admisOrNot;
        $pdf = Pdf::loadView('tamplate.pdf.bultinEtudiant', [
                'InfosEtudiant' => $etudiants,
                'noteByEtudiant'=> $notes,
                'anneAcademique'=>$anneAcademique,
                'niveau'=>$niveau,
                'admisOrNot'=>$admisOrNot
        ])->setOption('enable-local-file-access', true);
         
        $date = now()->format('Y-m-d_H-i-s');

        // 📁 Nom du fichier
        $titreFichier = preg_replace('/[^A-Za-z0-9\-]/', '_', $this->matricule);
        $filename = trim($titreFichier).'_niveau_'.$niveau.'_'.$anneAcademique.'.pdf';
        // 📁 Chemin de stockage
        $path = storage_path('app/public/pdf/'.$filename);

        // 💾 Enregistrement du fichier
        $pdf->save($path);

        bultinEtudiantModel::create([
            'matricule'=>$this->matricule,
            'niveau' =>$this->niveau,
            'session'=>'2',
            'anneeAcademique' => optional($this->anneeAccademiqueActive())->libelle,
            'pdf'=> $filename,
        ]);

        $this->dispatch('success-pdf', fileName:$filename);
    }

    public function admissionEtudiant($value){

        $this->admisOrNot = $value;
        etudiantModel::where('matricule', $this->matricule)->update([
            'admisOrNot'=>$value
        ]);
        $this->export();   
        broadcast(new updatedTable(''));           
    }


    public function PublicationNotesSession1Etudiant($value){

        $this->admisOrNot = $value;
        $this->export();  
        broadcast(new updatedTable(''));            
    }

    public function render()
    {
        return view('livewire.pages.notes-evaluation.tableau-note-by-etudiant');
    }
}
