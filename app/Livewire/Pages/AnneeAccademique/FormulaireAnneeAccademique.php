<?php

namespace App\Livewire\Pages\AnneeAccademique;

use App\Events\updatedTable;
use App\Models\annnee_accademiqueModel;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class FormulaireAnneeAccademique extends Component
{
        public $dateDebut;
        public $dateFin;
        public $libelle;
        public $active = false;

        public function resetForm(){
            // reset([
            //     'dateDebut',
            //     'dateFin',
            //     'libelle',
            // ]);
        }

        public function remplirLibelle(){
            if($this->dateDebut !=""  && $this->dateFin !=""){
                $dateDebut = Carbon::parse($this->dateDebut);
                $dateFin = Carbon::parse($this->dateFin);

                $this->libelle= $dateDebut->year."-".$dateFin->year;
            }
        }
    public function rules()
    {
        return [
            'libelle' => 'required|string|max:100',

            'dateDebut' => [
                'required',
                'date',
                function ($attribute, $value, $fail) {

                    $maxDateFin = annnee_accademiqueModel::max('date_fin');

                    if ($maxDateFin) {

                        $lastEnd = Carbon::parse($maxDateFin);
                        $newStart = Carbon::parse($value);

                        // ❌ écart max 5 mois entre ancienne fin et nouvelle début
                        if ($lastEnd->diffInMonths($newStart) > 5) {
                            $fail("L'écart entre la dernière année académique et la nouvelle ne doit pas dépasser 5 mois.");
                        }

                        // ❌ la nouvelle année doit être après la dernière
                        if ($newStart <= $lastEnd) {
                            $fail("La date de début doit être supérieure à la dernière date de fin enregistrée.");
                        }
                    }
                }
            ],

            'dateFin' => [
                'required',
                'date',
                'after:dateDebut',

                function ($attribute, $value, $fail) {

                    $dateDebut = Carbon::parse($this->dateDebut);
                    $dateFin   = Carbon::parse($value);

                    // ❌ année fin > année début
                    if ($dateFin->year <= $dateDebut->year) {
                        $fail("L'année de la date de fin doit être supérieure à celle de la date de début.");
                    }

                    // ❌ durée max 12 mois (1 an)
                    if ($dateDebut->diffInMonths($dateFin) > 12) {
                        $fail("La durée de l'année académique ne doit pas dépasser 12 mois.");
                    }

                    // ❌ durée minimum 10 mois (tu avais déjà cette règle)
                    if ($dateDebut->diffInMonths($dateFin) < 10) {
                        $fail("L'écart entre la date de début et la date de fin doit être d'au moins 10 mois.");
                    }
                }
            ],
        ];
    }

    public function save(){

        $validatedData = $this->validate();

        // if($this->id==null){
            annnee_accademiqueModel::create([
            'libelle' => $this->libelle,
            'date_debut' => $this->dateDebut,
            'date_fin' => $this->dateFin,
            'active' => $this->active
        ]);

        $this->resetForm();
        $this->dispatch('success', message: 'Annee accademique ajouté avec succès!');
        $action ="Ajout d'une annee academique";
        audit(Auth::user()->personnel->code, $action, $this->libelle);
        broadcast(new updatedTable(''));
        // }
        // else{
        //     $personnelUpdate = personnelsModel::find($this->id);

       
        //     $personnelUpdate->fill([
        //         'nom' => $this->nom,
        //         'prenom' => $this->prenom,
        //         'sexe' => $this->sexe,
        //         'telephone' => $this->telephone,
        //         'adresse' => $this->adresse,
        //         'email' => $this->email,
        //         'fonction' => $this->fonction,
        //         'conditionMatrimoniale' => $this->conditionMatrimonial
        //     ]);

        //     // vérifier si au moins un champ a changé
        //     if ($personnelUpdate->isDirty()) {

        //         $personnelUpdate->save();

        //         $this->dispatch('success', message: 'Personnel modifié avec succès!');
        //     } else {

        //         $this->dispatch('info', message: 'Aucune modification détectée.');
        //     }
        // }
        
    }
    public function render()
    {
        return view('livewire.pages.annee-accademique.formulaire-annee-accademique');
    }
}
