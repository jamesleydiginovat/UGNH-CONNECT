<?php

namespace App\Livewire\Esalle;

use App\Models\annnee_accademiqueModel;
use App\Models\coursModel;
use App\Models\devoirModel;
use App\Models\faculteModel;
use App\Models\remiseDevoirModel;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;

class FormulaireDevoir extends Component
{
    use WithFileUploads;

    public $code, $titre, $description, $cours, $pdf, $dateRemise, $anneAcademique, $codeFac, $niveau, $session;


    public function getCoursProperty(){
        return coursModel::where('codeProf', session('user_code'))
                           ->where('codeFac', $this->codeFac)
                           ->where('niveau', $this->niveau)
                           ->where('session', $this->session)
                           ->get();
    }


    public function nomFac($codeFac){
        return faculteModel::where('codeFac', $codeFac)->value('nom');
    }


    public function getFaculteProfProperty(){
        return coursModel::where('codeProf', session('user_code'))
                           ->get()->groupBy('codeFac');
    }

    public function getNiveauFaculteProfProperty(){
        return coursModel::where('codeProf', session('user_code'))
                           ->where('codeFac', $this->codeFac )
                           ->get()->groupBy('niveau');
    }


    public function getSessionNiveauFaculteProfProperty(){
    return coursModel::where('codeProf', session('user_code'))
                        ->where('codeFac', $this->codeFac )
                        ->where('niveau', $this->niveau )
                        ->get()->groupBy('session');
    }


    public function anneeAccademiqueActive(){
        return annnee_accademiqueModel::where('active', true)->first();
    }

    public function generateCodeDevoir()
    {
        do {
            $code = 'DEV-' . now()->format('Ymd') . '-' . strtoupper(Str::random(4));

            $exists = devoirModel::where('code', $code)->exists();

        } while ($exists);

        return $code;
    }

    public $idRemis;

    public function mount(){
        $this->anneAcademique=annnee_accademiqueModel::where('active',true)->first()->libelle;
        $this->code=$this->generateCodeDevoir(); 
    }



    public function save()
    {
        $this->validate([
            'code' => 'required|unique:devoir_tb_esalle,code',
            'titre' => 'required',
            'cours' => 'required',
            'dateRemise' => 'required|date|after:today',
            'pdf' => 'required|mimes:pdf|max:2048'
        ]);

        $path = $this->pdf->store('devoirs', 'public');
        $fileName = basename($path);

        devoirModel::create([
            'code' => $this->code,
            'titre' => $this->titre,
            'description' => $this->description,
            'cours' => $this->cours,
            'professeur' => session('user_code'),
            'pdf' => $fileName,
            'dateRemise' => $this->dateRemise,
            'anneAcademique' => annnee_accademiqueModel::where('active',true)->first()->libelle,
        ]);

        session()->flash('success', 'Devoir ajouté avec succès ✅');

        $this->reset();
        $this->code=$this->generateCodeDevoir();
    }
    
    public function render()
    {
        return view('livewire.esalle.formulaire-devoir');
    }
}
