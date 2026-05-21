<?php

namespace App\Livewire\Esalle;

use App\Events\updatedTable;
use App\Models\annnee_accademiqueModel;
use App\Models\coursModel;
use App\Models\etudianFaculteModel;
use App\Models\etudiantModel;
use App\Models\faculteModel;
use App\Models\messageEsalleModel;
use App\Models\professeurModel;
use Livewire\Attributes\On;
use Livewire\Component;

class ChatGroup extends Component
{
    public $message;

    protected $listeners = [
    'success' => '$refresh',
    'refreshTable'=>'$refresh',
    ];


    public function anneeAccademiqueActive(){
        return annnee_accademiqueModel::where('active', true)->first();
    }


    public function getListeEtudiantEsalleProperty(){

        return etudiantModel::with('faculte')
                                    ->where('status', 'Etudiant')
                                    ->where('codeFac', session('user_codeFac'))
                                    ->where('niveau', session('user_niveau'))
                                    ->get();
    }


    public function getListeSalleProfProperty(){
       return coursModel::where('codeProf', session('user_code'))
                        ->select('codeFac', 'niveau')
                        ->distinct()
                        ->get();
    }

    public function nomFac($codeFac){
        return faculteModel::where('codeFac', $codeFac)->value('nom');
    }

    
    
    public function save(){
        $this->validate([
            'message'=>'required'
        ]);
        messageEsalleModel::create([
            'message'=>$this->message,
            'codeUser'=>session('user_code'),
            'codeFac'=>session('user_codeFac'),
            'niveau'=>session('user_niveau'),
            'anneAcademique'=> annnee_accademiqueModel::where('active',true)->first()->libelle
        ]);

        broadcast(new updatedTable(""));
        $this->reset();
    }


    public function saveMessageProf(){
        $this->validate([
            'message'=>'required'
        ]);
        messageEsalleModel::create([
            'message'=>$this->message,
            'codeUser'=>session('user_code'),
            'codeFac'=>$this->codeFac,
            'niveau'=>$this->niveau,
            'anneAcademique'=> annnee_accademiqueModel::where('active',true)->first()->libelle
        ]);

        broadcast(new updatedTable(""));
        $this->reset();
    }


    public function getMessageGroupProperty(){
        return messageEsalleModel::where('anneAcademique', annnee_accademiqueModel::where('active',true)->first()->libelle)
                                   ->where('codeFac', session('user_codeFac'))
                                   ->where('niveau', session('user_niveau'))
                                   ->get();
    }
    public $codeFac=null;
    public $niveau =null;

    public function setValue($codeFac,$niveau){
        $this->codeFac = $codeFac;
        $this->niveau=$niveau;
    }


    public function isEtudiant($code){
        return etudiantModel::where('matricule', $code)
                              ->where('status', 'Etudiant')
                              ->exists();
    }

    public function nomEtudiant($code)
    {
        $etudiant = etudiantModel::where('matricule', $code)->where('status', 'Etudiant')->first();

        return trim(optional($etudiant)->nom . ' ' . optional($etudiant)->prenom) ?: 'Etudiant inconnu';
    }

    public function isProf($code){
        return professeurModel::where('codeProf', $code)
                              ->exists();
    }

    public function nomProf($codeProf)
    {
        $prof = professeurModel::where('codeProf', $codeProf)->first();

        return trim(optional($prof)->nom . ' ' . optional($prof)->prenom) ?: 'Professeur inconnu';
    }

    public function getMessageGroupProfProperty(){
    return messageEsalleModel::where('anneAcademique', annnee_accademiqueModel::where('active',true)->first()->libelle)
                                ->where('codeFac', $this->codeFac)
                                ->where('niveau', $this->niveau)
                                ->get();
    }
    
    public function render()
    {
        return view('livewire.esalle.chat-group');
    }
}
