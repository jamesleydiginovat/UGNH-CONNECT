<?php

namespace App\Livewire\Pages\Pdf;

use App\Models\annnee_accademiqueModel;
use App\Models\documentsModel;
use App\Models\etudianFaculteModel;
use App\Models\etudiantModel;
use App\Models\faculteModel;
use Livewire\Component;
use Barryvdh\Snappy\Facades\SnappyPdf as PDF;
use Illuminate\Support\Facades\Auth;

class DocumentEtudiant extends Component
{
    public $sexe;
    public $status;
    public $faculte;
    public $niveau;
    public $titre;
    public $isUser=false;
    public $matricule;
    public $fullInformation;
    public $cheminPDF;

    public function export()
    {
        // 🔹 1. Récupération sécurisée des données
        $etudiants = $this->getListeEtudiantsProperty();
        $titres = $this->getTitreProperty();
        $matricule = $this->matricule;

        // 🔹 2. Génération du PDF + téléchargement
        // return response()->streamDownload(function () use ($etudiants, $titres, $matricule) {

        //     echo PDF::loadView('tamplate.pdf.documentEtudiant', [
        //         'etudiants' => $etudiants,
        //         'titre'=> $titres,
        //         'matricule'=>$matricule,

        //     ])
        //     ->setOption('enable-local-file-access', true)
        //     ->output();

        // }, 'liste_etudiants.pdf');



        $pdf = Pdf::loadView('tamplate.pdf.documentEtudiant', [
                'etudiants' => $etudiants,
                'titre'=> $titres,
                'matricule'=>$matricule,
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


    public function getListeEtudiantsProperty(){
        if($this->sexe !="" && $this->status =="" && $this->faculte =="" && $this->niveau ==""){
            return etudiantModel::with('faculte')
                                  ->where('status','Etudiant')
                                  ->where('sexe', $this->sexe)
                                  ->orderBy('id','DESC')
                                  ->get();
        }
        elseif($this->sexe =="" && $this->status =="" && $this->faculte !="" && $this->niveau ==""){
            return etudiantModel::with('faculte')
                ->where('status', 'Etudiant') // toujours les étudiants
                ->when($this->faculte, function($query) {
                    $query->whereHas('faculte', function($q) {
                        $q->where('codeFac', 'ILIKE', "%{$this->faculte}%");
                    });
                })
                ->orderBy('id', 'ASC')
                ->get();
        }
        elseif($this->sexe =="" && $this->status =="" && $this->faculte =="" && $this->niveau !=""){
            return etudiantModel::with('faculte')
                                  ->where('status','Etudiant')
                                  ->where('niveau', $this->niveau)
                                  ->orderBy('id','DESC')
                                  ->get();
        }
        elseif($this->sexe =="" && $this->status !="" && $this->faculte =="" && $this->niveau ==""){
            return etudiantModel::with('faculte')
                                  ->where('status',$this->status)
                                  ->orderBy('id','DESC')
                                  ->get();
        }
        elseif($this->sexe =="" && $this->status =="" && $this->faculte !="" && $this->niveau !=""){
            return etudiantModel::with('faculte')
                                  ->where('status','Etudiant')
                                  ->when($this->faculte, function($query) {
                                        $query->whereHas('faculte', function($q) {
                                            $q->where('codeFac', 'ILIKE', "%{$this->faculte}%");
                                        });
                                    })
                                  ->where('niveau', $this->niveau)
                                  ->orderBy('id','DESC')
                                  ->get();
        }
        else{
             return etudiantModel::with('faculte')->where('status','Etudiant')->orderBy('id','DESC')->get();
        }
       
    }

    public function getTitreProperty(){
        if($this->sexe !="" && $this->status =="" && $this->faculte =="" && $this->niveau ==""){
            return $this->titre="Liste des etudiants"." ".$this->sexe;
        }
        elseif($this->sexe =="" && $this->status =="" && $this->faculte !="" && $this->niveau ==""){
            return $this->titre="Liste des etudiants de la faculte"." ".$this->faculte;
        }
        elseif($this->sexe =="" && $this->status =="" && $this->faculte =="" && $this->niveau !=""){
           return $this->titre="Liste des etudiants du nivau"." ".$this->niveau; 
        }
        elseif($this->sexe =="" && $this->status =="" && $this->faculte !="" && $this->niveau !=""){
            return $this->titre="Liste des etudiants de la faculte"." ".$this->faculte." "."du niveau"." ".$this->niveau;
        }
        elseif($this->sexe =="" && $this->status !="" && $this->faculte =="" && $this->niveau ==""){
            if($this->status !="Etudiant"){
                if($this->status=="Postulant"){
                    return $this->titre="Liste des postulants";
                }
                else{
                    return $this->titre="Liste des etudiants"." ".$this->status; 
                }
                
            }
            else{
                return $this->titre="Liste des etudiants";
            }
        }
        else{
          return $this->titre="Liste des etudiants";   
        }
    }


    public function putValue(){
        $this->isUser=true;
    }
    public function isFullInformation(){
        $this->matricule="";
    }
    public function putMatrcule(){
        $this->getListeEtudiantsProperty();
    }


    public function render()
    {
        return view('livewire.pages.pdf.document-etudiant');
    }
}
