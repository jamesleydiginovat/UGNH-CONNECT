<?php

namespace App\Livewire\Pages\Pdf;

use App\Models\annnee_accademiqueModel;
use App\Models\documentsModel;
use App\Models\professeurModel;
use Livewire\Component;
use Barryvdh\Snappy\Facades\SnappyPdf as PDF;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DocumentsProfesseurs extends Component
{

    public $type;
    public $date;
    public $filterStatus;
    public $filterSexe;
    public $filterConditionMatrimoniale;
    public $titre;
    public $isUser=false;
    public $codeProf;
    public $fullInformation;
    public $cheminPDF;

    public function export()
    {
        // 🔹 1. Récupération sécurisée des données
        $professeurs = $this->getListeProfesseurProperty();
        $titres = $this->getTitreProperty();
        $codeProf = $this->codeProf;

        // 🔹 2. Génération du PDF + téléchargement
        // return response()->streamDownload(function () use ($personnels, $titres, $codePersonnels) {

        //     echo PDF::loadView('tamplate.liste-personnel', [
        //         'personnels' => $personnels,
        //         'titre'=> $titres,
        //         'codePersonnel'=>$codePersonnels,

        //     ])
        //     ->setOption('enable-local-file-access', true)
        //     ->output();

        // }, 'liste_personnel.pdf');

        $pdf = Pdf::loadView('tamplate.pdf.document-professeur', [
        'professeurs' => $professeurs,
        'titre' => $titres,
        'codeProf' => $codeProf,
        ])->setOption('enable-local-file-access', true);
         
        $date = now()->format('Y-m-d_H-i-s');

        // 📁 Nom du fichier
        $titreFichier = preg_replace('/[^A-Za-z0-9\-]/', '_', $titres);
        $filename = trim($titreFichier).trim($date).'.pdf';
        // 📁 Chemin de stockage
        $path = storage_path('app/public/pdf/'.$filename);

        // 💾 Enregistrement du fichier
        $pdf->save($path);
        $this->cheminPDF=$filename;
        // (optionnel) retourner le chemin ou message
        // return $path;

        documentsModel::create([
            'nom'=>$filename,
            'utilisateurs'=>Auth::user()->nomUtilisateur,
            'anneeAcademique'=>annnee_accademiqueModel::where('active',true)->first()->libelle
        ]);

        $this->dispatch('success-pdf', fileName:$filename);
    }

    public function getListeProfesseurProperty(){

        if($this->filterStatus !="" && $this->filterSexe =="" && $this->filterConditionMatrimoniale ==""){
            // $this->titre="Liste des personnels"." ".$this->filterStatus;
            return professeurModel::where('status', $this->filterStatus)->get();
        }
        elseif($this->filterStatus =="" && $this->filterSexe !="" && $this->filterConditionMatrimoniale ==""){
            // $this->titre="Liste des personnels "." ".$this->filterSexe;
            return professeurModel::where('sexe', $this->filterSexe)
                                    ->where('status', "Actif")
                                    ->get();
        }
        elseif($this->filterStatus =="" && $this->filterSexe =="" && $this->filterConditionMatrimoniale !=""){
            // $this->titre="Liste des personnels "." ".$this->filterConditionMatrimoniale;
            return professeurModel::where('conditionMatrimoniale', $this->filterConditionMatrimoniale)
                                    ->where('status', "Actif")
                                    ->get();
        }
        elseif($this->filterStatus !="" && $this->filterSexe !="" && $this->filterConditionMatrimoniale ==""){
            // $this->titre="Liste des personnels ";
            return professeurModel::where('sexe', $this->filterSexe)
                                    ->where('status', "Actif")
                                    ->get();
        }
        elseif($this->filterStatus !="" && $this->filterSexe =="" && $this->filterConditionMatrimoniale !=""){
            // $this->titre="Liste des personnels ";
            return professeurModel::where('conditionMatrimoniale', $this->filterConditionMatrimoniale)
                                    ->where('status', $this->filterStatus)
                                    ->get();
        }
        elseif($this->filterStatus !="" && $this->filterSexe !="" && $this->filterConditionMatrimoniale !=""){
            // $this->titre="Liste des personnels ";
            return professeurModel::where('conditionMatrimoniale', $this->filterConditionMatrimoniale)
                                    ->where('status', $this->filterStatus)
                                    ->where('sexe', $this->filterSexe)
                                    ->get();
        }
        elseif($this->codeProf !=""){
            return professeurModel::where('codeProf', $this->codeProf)
                                    ->get();
        }
        else{
            // $this->titre="Liste des personnels ";
            return professeurModel::where('status', "Actif")->get();
        }
        
    }

    public function getTitreProperty(){
        if($this->filterStatus !="" && $this->filterSexe =="" && $this->filterConditionMatrimoniale ==""){
           return $this->titre="Liste des professeurs"." ".$this->filterStatus;
        }
        elseif($this->filterStatus =="" && $this->filterSexe !="" && $this->filterConditionMatrimoniale ==""){
           return $this->titre="Liste des professeurs "." ".$this->filterSexe;
        }
        elseif($this->filterStatus =="" && $this->filterSexe =="" && $this->filterConditionMatrimoniale !=""){
            return $this->titre="Liste des professeurs "." ".$this->filterConditionMatrimoniale;
        }
        elseif($this->codeProf !=""){
            return $this->titre="Information Personnelle de "." ".$this->codeProf;
        }
        else{
            return $this->titre="Liste des professeurs ";
        }
    }

    public function putValue(){
        $this->isUser=true;
    }
    public function isFullInformation(){
        $this->codeProf="";
    }
    public function putCodeProfesseur(){
        $this->getListeProfesseurProperty();
    }


    public function render()
    {
        return view('livewire.pages.pdf.documents-professeurs');
    }
}
