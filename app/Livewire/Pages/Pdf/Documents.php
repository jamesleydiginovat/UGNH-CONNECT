<?php

namespace App\Livewire\Pages\Pdf;

use App\Models\annnee_accademiqueModel;
use App\Models\documentsModel;
use App\Models\personnelsModel;
use Livewire\Component;
use Barryvdh\Snappy\Facades\SnappyPdf as PDF;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Documents extends Component
{
    public $type;
    public $date;
    public $filterStatus;
    public $filterSexe;
    public $filterConditionMatrimoniale;
    public $titre;
    public $isUser=false;
    public $codePersonnel;
    public $fullInformation;
    public $cheminPDF;

    public function export()
    {
        // 🔹 1. Récupération sécurisée des données
        $personnels = $this->getListePersonnelProperty();
        $titres = $this->getTitreProperty();
        $codePersonnels = $this->codePersonnel;

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

        $pdf = PDF::loadView('tamplate.liste-personnel', [
        'personnels' => $personnels,
        'titre' => $titres,
        'codePersonnel' => $codePersonnels,
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

    public function getListePersonnelProperty(){

        if($this->filterStatus !="" && $this->filterSexe =="" && $this->filterConditionMatrimoniale ==""){
            // $this->titre="Liste des personnels"." ".$this->filterStatus;
            return personnelsModel::where('status', $this->filterStatus)->get();
        }
        elseif($this->filterStatus =="" && $this->filterSexe !="" && $this->filterConditionMatrimoniale ==""){
            // $this->titre="Liste des personnels "." ".$this->filterSexe;
            return personnelsModel::where('sexe', $this->filterSexe)
                                    ->where('status', "Active")
                                    ->get();
        }
        elseif($this->filterStatus =="" && $this->filterSexe =="" && $this->filterConditionMatrimoniale !=""){
            // $this->titre="Liste des personnels "." ".$this->filterConditionMatrimoniale;
            return personnelsModel::where('conditionMatrimoniale', $this->filterConditionMatrimoniale)
                                    ->where('status', "Active")
                                    ->get();
        }
        elseif($this->filterStatus !="" && $this->filterSexe !="" && $this->filterConditionMatrimoniale ==""){
            // $this->titre="Liste des personnels ";
            return personnelsModel::where('sexe', $this->filterSexe)
                                    ->where('status', "Active")
                                    ->get();
        }
        elseif($this->filterStatus !="" && $this->filterSexe =="" && $this->filterConditionMatrimoniale !=""){
            // $this->titre="Liste des personnels ";
            return personnelsModel::where('conditionMatrimoniale', $this->filterConditionMatrimoniale)
                                    ->where('status', $this->filterStatus)
                                    ->get();
        }
        elseif($this->filterStatus !="" && $this->filterSexe !="" && $this->filterConditionMatrimoniale !=""){
            // $this->titre="Liste des personnels ";
            return personnelsModel::where('conditionMatrimoniale', $this->filterConditionMatrimoniale)
                                    ->where('status', $this->filterStatus)
                                    ->where('sexe', $this->filterSexe)
                                    ->get();
        }
        elseif($this->isUser){
            return  DB::table('utilisateurs_tb')
                            ->join('personnels_tb', 'utilisateurs_tb.codePersonnel', '=', 'personnels_tb.code')
                            ->get();
        }
        elseif($this->codePersonnel !=""){
            return personnelsModel::where('code', $this->codePersonnel)
                                    ->get();
        }
        else{
            // $this->titre="Liste des personnels ";
            return personnelsModel::where('status', "Active")->get();
        }
        
    }

    public function getTitreProperty(){
        if($this->filterStatus !="" && $this->filterSexe =="" && $this->filterConditionMatrimoniale ==""){
           return $this->titre="Liste des personnels"." ".$this->filterStatus;
        }
        elseif($this->filterStatus =="" && $this->filterSexe !="" && $this->filterConditionMatrimoniale ==""){
           return $this->titre="Liste des personnels "." ".$this->filterSexe;
        }
        elseif($this->filterStatus =="" && $this->filterSexe =="" && $this->filterConditionMatrimoniale !=""){
            return $this->titre="Liste des personnels "." ".$this->filterConditionMatrimoniale;
        }
        elseif($this->isUser){
             return $this->titre="Liste des personnels utilisateurs";
        }
        elseif($this->codePersonnel !=""){
            return $this->titre="Information Personnelle de "." ".$this->codePersonnel;
        }
        else{
            return $this->titre="Liste des personnels ";
        }
    }

    public function putValue(){
        $this->isUser=true;
    }
    public function isFullInformation(){
        $this->codePersonnel="";
    }
    public function putCodePersonnel(){
        $this->getListePersonnelProperty();
    }

    public function render()
    {
        return view('livewire.pages.pdf.documents');
    }
}
