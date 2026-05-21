<?php

namespace App\Livewire\Esalle;

use App\Models\annnee_accademiqueModel;
use App\Models\coursModel;
use App\Models\document_tb_esalleModel;
use Livewire\Component;
use Livewire\WithFileUploads;

class FormulaireDocument extends Component
{
    public $titre;
    public $codeFac;
    public $niveau;
    public $session;
    public $codeCours;
    public $pdf;

    use WithFileUploads;

    public function getfaculteProfProperty()
    {
        return coursModel::with('faculte')->where('codeProf', session('user_code'))
            ->get()
            ->groupBy('codeFac');
    }


    public function getLesNiveaufaculteProfProperty()
    {
        return coursModel::with('faculte')->where('codeProf', session('user_code'))
            ->where('codeFac', $this->codeFac)
            ->get()
            ->groupBy('niveau');
    }




    public function getLesSessionfaculteProfProperty()
    {
        return coursModel::with('faculte')->where('codeProf', session('user_code'))
            ->where('codeFac', $this->codeFac)
            ->where('niveau', $this->niveau)
            ->get()
            ->groupBy('session');
    }


    public function getCoursfaculteProfProperty()
    {
        return coursModel::with('faculte')->where('codeProf', session('user_code'))
            ->where('codeFac', $this->codeFac)
            ->where('niveau', $this->niveau)
            ->where('session', $this->session)
            ->get();
    }

    public function anneeAccademiqueActive(){
        return annnee_accademiqueModel::where('active', true)->first();
    }

    public function saveDocument(){
        $this->validate([
            'titre' => 'required',
            'codeFac' => 'required',
            'niveau' => 'required',
            'codeCours' => 'required',
            'session' => 'required',
            'pdf' => 'required'
        ]);

        $path = $this->pdf->store('documentCours', 'public');
        $fileName = basename($path);

        document_tb_esalleModel::create([
            'titre' => $this->titre,
            'codeFac' => $this->codeFac,
            'niveau' => $this->niveau,
            'codeCours' => $this->codeCours,
            'professeurs' => session('user_code'),
            'pdf' => $fileName,
            'session' => $this->session,
            'anneAcademique'=> annnee_accademiqueModel::where('active',true)->first()->libelle
        ]);

        session()->flash('success', 'Document ajouté avec succès ✅');

        $this->reset();
    }
    public function render()
    {
        return view('livewire.esalle.formulaire-document');
    }
}
