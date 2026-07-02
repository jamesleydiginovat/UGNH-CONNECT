<?php

namespace App\Livewire\Pages\NotesEvaluation;

use App\Events\updatedTable;
use App\Http\Controllers\anneesAccademiques;
use App\Models\annnee_accademiqueModel;
use App\Models\coursModel;
use App\Models\etudianFaculteModel;
use App\Models\etudiantModel;
use App\Models\faculteModel;
use App\Models\noteModel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class FormulaireNotesEvaluation extends Component
{
    public $codeFac;
    public $niveau;
    public $session;
    public $matricule;
    public $note;
    public $typeEvaluation;
    public $codeCours;
    public $anneAccademique;

    public $noteIntra;
    public $noteExamenFinal;
    public $noteRattrapage;

    public $traitementOK=false;
    public $errorMessage;


    public function mount(){
        $session1 = DB::table('evenement_tb')
            ->where('nom', 'Saisie Notes Session 1')
            ->where('date_debut', '<=', now())
            ->where('date_fin', '>=', now())
            ->exists();

        $session2 = DB::table('evenement_tb')
            ->where('nom', 'Saisie Notes Session 2')
            ->where('date_debut', '<=', now())
            ->where('date_fin', '>=', now())
            ->exists();

        $role = Auth::user()->roles->first()->nom ?? '';
        $isAdmin = $role = 'Administrateur';
        $isSecretaireGenerale = $role == "Secrétaire générale";
        $doyenFaculte = $role == "Doyen de faculté";
        $VicedoyenFaculte = $role == "Vice-doyen de faculté";
        $SecretaireFaculte = $role == "Secretaire faculte";
        $Secrétaireadjoint = $role == "Secrétaire adjoint";

        // if($isAdmin || ){
        //     $this->session = null;
        // }
        // else{
            if($session1){
                $this->session = '1';
            }
            elseif($session2){
                $this->session = '2';
            }
        // }
       

        // $this->session = '2';
        
    }

    public function getEtudiantsProperty(){
        if($this->codeFac !="" && $this->niveau !="" ){
         return etudianFaculteModel::with(['etudiant', 'faculte'])
                                    ->where('codeFaculte', $this->codeFac)
                                    ->whereHas('etudiant', function ($query) {
                                        $query->where('status', 'Etudiant')
                                            ->where('niveau', $this->niveau);
                                    })
                                    ->get();
        }
        elseif($this->codeFac !="" && $this->niveau ==""){

            return etudianFaculteModel::with(['etudiant', 'faculte'])
                                    ->where('codeFaculte', $this->codeFac)
                                    ->whereHas('etudiant', function ($query) {
                                        $query->where('status', 'Etudiant');
                                    })
                                    ->get();
        }
        
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

    public function getCoursProperty(){

        if($this->niveau !="" && $this->codeFac !="" && $this->session !=""){
                return coursModel::where('codeFac', $this->codeFac)
                           ->where('niveau', $this->niveau)
                           ->where('session',$this->session)
                           ->get();
        }
    }


    public function anneeAccademiqueActive(){
        return annnee_accademiqueModel::where('active', true)->first();
    }

    public function rules()
    {
        return [
            // 🔹 Identification
            'matricule' => 'required',
            'codeCours'         => 'required',

            // 🔹 Contexte
            'codeFac'           => 'required',
            'niveau'            => 'required',
            'session'           => 'required|in:1,2',

            'typeEvaluation'=>'required',
            'codeCours'=>'required',

            // 🔹 Notes
            'note'         => 'required|numeric|min:0|max:100',
        ];
    }



    protected $messages = [

        // 🔹 Identification
        'matricule.required' => 'Sélection requise.',
        'codeCours.required' => 'Information requise.',

        // 🔹 Contexte
        'codeFac.required'   => 'Champ requis.',
        'niveau.required'    => 'Champ requis.',
        'session.required'   => 'Sélection requise.',
        'session.in'         => 'Valeur invalide.',

        // 🔹 Évaluation
        'typeEvaluation.required' => 'Information requise.',

        // 🔹 Notes
        'note.required' => 'Saisie requise.',
        'note.numeric'  => 'Valeur invalide.',
        'note.min'      => 'Valeur non autorisée.',
        'note.max'      => 'Valeur non autorisée.',
    ];

    public function verificationNote()
    {
        $annee = $this->anneeAccademiqueActive() ? $this->anneeAccademiqueActive()->libelle : null;

        return noteModel::where('matriculeEtudiant', $this->matricule)
                        ->where('codeFac', $this->codeFac)
                        ->where('codeCours', $this->codeCours)
                        ->where('niveau', $this->niveau)
                        ->where('session', $this->session)
                        ->where('anneeAcademique', $annee)
                        ->exists();
    }

    public function RechercherNote()
    {
        $annee = $this->anneeAccademiqueActive() ? $this->anneeAccademiqueActive()->libelle : null;

        return noteModel::where('matriculeEtudiant', $this->matricule)
                        ->where('codeFac', $this->codeFac)
                        ->where('codeCours', $this->codeCours)
                        ->where('niveau', $this->niveau)
                        ->where('session', $this->session)
                        ->where('anneeAcademique', $annee)
                        ->first();
    }

    public function traitementNotes(){

        if($this->verificationNote()){

            $NoteIntraDB = $this->RechercherNote()->noteIntra;
            $NoteExamenFinaDB = $this->RechercherNote()->examenFinal;
            $noteRattrapageDB = $this->RechercherNote()->noteRattrapage;

            if($this->typeEvaluation == "Intra"){
                if($NoteIntraDB == null){
                    if($this->note <=30){
                        $this->noteIntra =  $this->note;
                        $this->traitementOK=true;
                    }
                    else{
                        $this->errorMessage='Une erreur est survenu dans le note entrer';
                    }
                }
                else{
                    $this->errorMessage='Cet eleve a deja un note intra pour ce matiere';
                }
            }
            elseif($this->typeEvaluation == "Examen Final"){
                if($NoteExamenFinaDB == null){
                    if($this->note <=70){
                        $this->noteExamenFinal = $this->note;
                        $this->traitementOK=true;
                    }
                    else{
                        $this->errorMessage='Une erreur est survenu dans le note entrer';
                    }
                }
                else{
                    $this->errorMessage='Cet eleve a deja un note Examen final pour ce matiere';
                }
            }
            elseif($this->typeEvaluation == "Note de rattrapage"){
                if($noteRattrapageDB == null){
                    if($this->note <=100){
                        $this->noteRattrapage = $this->note;
                        $this->traitementOK=true;
                    }
                    else{
                        $this->errorMessage='Une erreur est survenu dans le note entrer';
                    }
                }
                else{
                    $this->errorMessage='Cet eleve a deja un note de rattrapage pour ce matiere';
                }
            }
        }
        else{

            if($this->typeEvaluation == "Intra"){
                // dd($this->note);
                if($this->note <=30){
                    $this->noteIntra =  $this->note;
                    $this->traitementOK=true;
                }
                else{
                    $this->errorMessage='Une erreur est survenu dans le note entrer';
                }
                
            }
            elseif($this->typeEvaluation == "Examen Final"){
                if($this->note <=70){
                    $this->noteExamenFinal = $this->note;
                    $this->traitementOK=true;
                }
                else{
                    $this->errorMessage='Une erreur est survenu dans le note entrer';
                }
                
            }
            elseif($this->typeEvaluation == "Note de rattrapage"){
                if($this->note <=100){
                    $this->noteRattrapage = $this->note;
                    $this->traitementOK=true;
                }
                else{
                    $this->errorMessage='Une erreur est survenu dans le note entrer';
                }
                
            }

        }

    }

    public function resetForm()
    {
        $this->reset([
            'matricule',
            'codeCours',
            'codeFac',
            'niveau',
            'typeEvaluation',
            'note',
        ]);
    }

    public function  save(){
        $validatedData = $this->validate();
        $this->traitementNotes();
        
        if($this->verificationNote()){
            
            if($this->traitementOK){
                    
                    if($this->typeEvaluation=="Intra"){
                    noteModel::where('matriculeEtudiant', $this->matricule)
                        ->where('codeFac', $this->codeFac)
                        ->where('codeCours', $this->codeCours)
                        ->where('niveau', $this->niveau)
                        ->where('session', $this->session)
                        ->where('anneeAcademique', $this->anneeAccademiqueActive()->libelle)
                        ->update([
                            'noteIntra' => $this->noteIntra
                        ]);

                    
                    }
                    elseif($this->typeEvaluation=="Examen Final"){
                    noteModel::where('matriculeEtudiant', $this->matricule)
                        ->where('codeFac', $this->codeFac)
                        ->where('codeCours', $this->codeCours)
                        ->where('niveau', $this->niveau)
                        ->where('session', $this->session)
                        ->where('anneeAcademique', $this->anneeAccademiqueActive()->libelle)
                        ->update([
                            'examenFinal' => $this->noteExamenFinal
                        ]);
                    
                    }
                    elseif($this->typeEvaluation=="Note de rattrapage"){
                    noteModel::where('matriculeEtudiant', $this->matricule)
                        ->where('codeFac', $this->codeFac)
                        ->where('codeCours', $this->codeCours)
                        ->where('niveau', $this->niveau)
                        ->where('session', $this->session)
                        ->where('anneeAcademique', $this->anneeAccademiqueActive()->libelle)
                        ->update([
                            'noteRattrapage' => $this->noteRattrapage
                        ]);
                    }
                    session()->flash('successNote', 'Note Ajouter avec succes');
                    // $this->dispatch('successNote',message:'Note Ajouter avec succes');
                    broadcast(new updatedTable(''));
                    $action ="Enregistrement d'une note";
                    audit(Auth::user()->personnel->code, $action, $this->codeCours);
                    $this->resetForm();
            }
            else{
                    session()->flash('erreur',$this->errorMessage );
                    // $this->dispatch('erreur',message: "$this->errorMessage");
            }
            
        }
        else{
            if($this->traitementOK){
            noteModel::create([
                'matriculeEtudiant' =>$this->matricule,
                'codeFac'=>$this->codeFac,
                'codeCours'=>$this->codeCours,
                'niveau'=>$this->niveau,
                'session'=>$this->session,
                'anneeAcademique'=>$this->anneeAccademiqueActive()->libelle,
                'noteIntra'=>$this->noteIntra,
                'examenFinal'=>$this->noteExamenFinal
            ]);
                session()->flash('successNote', 'Note Ajouter avec succes');
                 broadcast(new updatedTable(''));
                 $action ="Enregistrement d'une note";
                 audit(Auth::user()->personnel->code, $action, $this->codeCours);
                $this->resetForm();
            }
            else{
                session()->flash('erreur',$this->errorMessage );
                // $this->dispatch('erreur',message: "$this->errorMessage");
            }
        }

    }

    public function clearFlash()
    {
        session()->forget('success');
    }

    public function render()
    {
        return view('livewire.pages.notes-evaluation.formulaire-notes-evaluation');
    }
}
