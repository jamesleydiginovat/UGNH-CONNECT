<?php

namespace App\Livewire\Pages;

use App\Models\annnee_accademiqueModel;
use App\Models\bultinEtudiantModel;
use App\Models\etudiantModel;
use App\Models\faculteModel;
use App\Models\paimentEtudiantModel;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ValidationNotes extends Component
{
    protected $listeners = [
        'refreshTable'=>'$refresh',
    ];

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


    public $isNotAdmis;
    public function getlisteDesBultinProperty(){
        if($this->isNotAdmis ==null){
            if($this->byFaculte !="" && $this->byNiveau !=""){
                return etudiantModel::with('faculte')->where('admisOrNot', 'yes')
                                    ->where('codeFac', $this->byFaculte)
                                    ->where('niveau', $this->byNiveau)
                                    ->get();
            }
            else{
                return etudiantModel::with('faculte')->where('admisOrNot', 'yes')->get();
            }
        }
        elseif($this->isNotAdmis == "yes"){

            if($this->byFaculte !="" && $this->byNiveau !=""){
                return etudiantModel::with('faculte')->where('admisOrNot', 'no')
                                    ->where('codeFac', $this->byFaculte)
                                    ->where('niveau', $this->byNiveau)
                                    ->get();
            }
            else{
                return etudiantModel::with('faculte')->where('admisOrNot', 'no')->get();
            }
        }
        
        
    }

    public $byFaculte;
    public $byNiveau;
    public function voirLePdf($matricule)
    {   
        $fichier = bultinEtudiantModel::where('matricule', $matricule)->value('pdf');
        $path = asset('storage/pdf/' . $fichier);
        $this->dispatch('oppen-df', url: $path);
        
    }

    public function admissionValidee($matricule)
    {
        $anneeActive = annnee_accademiqueModel::where('active', true)->first();

        $anneeAcademiqueSuivant = annnee_accademiqueModel::where('date_debut', '>', $anneeActive->date_fin)
            ->orderBy('date_debut', 'asc')
            ->first();

    if (!$anneeAcademiqueSuivant) {

        $this->dispatch(
            'erreur',
            message: "Aucune année académique suivante n'a été trouvée."
        );

        return;
    }
        $etudiant = etudiantModel::with('faculte')
                        ->where('matricule', $matricule)
                        ->first();

        // Vérifier si l'étudiant existe
        if (!$etudiant) {
            return;
        }

        // Nombre maximum de niveaux de la faculté
        $nombreNiveau = optional($etudiant->faculte->first())->nombreNiveau;

        // Vérifier si l'étudiant peut passer au niveau suivant
        if ($etudiant->niveau < $nombreNiveau) {

            etudiantModel::where('matricule', $matricule)
                ->update([
                    'admisOrNot' => null,
                    'niveau' => $etudiant->niveau + 1
                ]);


            paimentEtudiantModel::create([
                    'matriculeEtudiant' => $matricule,
                    'codeFaculte' => optional($etudiant->faculte->first())->codeFac,
                    'anneAccademique'=>$anneeAcademiqueSuivant->libelle,
                    'niveau' => $etudiant->niveau + 1,
                    'session' => 1,
                    'premierVersement' => 0,
                    'deuxiemeVersement' => 0,
                    'troisiemeVersement' => 0,
                    'total' => 0,
                    'statut' => 'Valide'
            ]);
            
            paimentEtudiantModel::create([
                    'matriculeEtudiant' => $matricule,
                    'codeFaculte' => optional($etudiant->faculte->first())->codeFac,
                    'anneAccademique'=>$anneeAcademiqueSuivant->libelle,
                    'niveau' => $etudiant->niveau + 1,
                    'session' => 2,
                    'premierVersement' => 0,
                    'deuxiemeVersement' => 0,
                    'troisiemeVersement' => 0,
                    'total' => 0,
                    'statut' => 'Valide'
            ]);

        } else {

            // Étudiant terminé
            etudiantModel::where('matricule', $matricule)
                ->update([
                    'admisOrNot' => 'Termine',
                    'status' =>'Etudiant terminer'
                ]);
        }
    }




    public function admissionEchouee($matricule)
    {
         $anneeActive = annnee_accademiqueModel::where('active', true)->first();

        $anneeAcademiqueSuivant = annnee_accademiqueModel::where('date_debut', '>', $anneeActive->date_fin)
            ->orderBy('date_debut', 'asc')
            ->first();

        if (!$anneeAcademiqueSuivant) {

            $this->dispatch(
                'erreur',
                message: "Aucune année académique suivante n'a été trouvée."
            );

            return;
        }
        $etudiant = etudiantModel::with('faculte')
                        ->where('matricule', $matricule)
                        ->first();

        // Vérifier si l'étudiant existe
        if (!$etudiant) {
            return;
        }

        // Nombre maximum de niveaux de la faculté
        $nombreNiveau = optional($etudiant->faculte->first())->nombreNiveau;

        // Vérifier si l'étudiant peut passer au niveau suivant
        if ($etudiant->niveau < $nombreNiveau) {

            etudiantModel::where('matricule', $matricule)
                ->update([
                    'admisOrNot' => null,
                    'niveau' => $etudiant->niveau
                ]);


            paimentEtudiantModel::create([
                    'matriculeEtudiant' => $matricule,
                    'codeFaculte' => optional($etudiant->faculte->first())->codeFac,
                    'anneAccademique'=>$anneeAcademiqueSuivant->libelle,  //  a arranger 
                    'niveau' => $etudiant->niveau,
                    'session' => 1,
                    'premierVersement' => 0,
                    'deuxiemeVersement' => 0,
                    'troisiemeVersement' => 0,
                    'total' => 0,
                    'statut' => 'Valide'
            ]);
            
            paimentEtudiantModel::create([
                    'matriculeEtudiant' => $matricule,
                    'codeFaculte' => optional($etudiant->faculte->first())->codeFac,
                    'anneAccademique'=>$anneeAcademiqueSuivant->libelle,
                    'niveau' => $etudiant->niveau,
                    'session' => 2,
                    'premierVersement' => 0,
                    'deuxiemeVersement' => 0,
                    'troisiemeVersement' => 0,
                    'total' => 0,
                    'statut' => 'Valide'
            ]);

        }
    }



    public function reinscriptionMassive()
    {
        $etudiants = $this->getlisteDesBultinProperty();
        if($this->isNotAdmis ==""){
            foreach ($etudiants as $etudiant) {

                $this->admissionValidee($etudiant->matricule);
            }
        }
        elseif($this->isNotAdmis == 'yes'){
            foreach ($etudiants as $etudiant) {

                $this->admissionEchouee($etudiant->matricule);
            }
        }
        

        $this->dispatch('erreur', [
            'message' => 'Réinscription effectuée avec succès pour tous les étudiants.'
        ]);
    }


    public function render()
    {
        return view('livewire.pages.validation-notes');
    }



}
