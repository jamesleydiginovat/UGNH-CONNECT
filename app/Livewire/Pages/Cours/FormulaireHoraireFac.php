<?php

namespace App\Livewire\Pages\Cours;

use App\Events\updatedTable;
use App\Models\coursModel;
use App\Models\faculteModel;
use App\Models\horaireFaculesModel;
use App\Models\professeurModel;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class FormulaireHoraireFac extends Component
{
    public $codeFac;
    public $niveau;
    public $session;

    public $jour;
    public $cours;
    public $heure_debut;
    public $heure_fin;
    public $salle;
    
    protected $listeners = [
         'refreshTable'=>'$refresh',
         'success'=>'$refresh',
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
    

    public function getProfesseursProperty(){
        return professeurModel::all();
    }


    public function getCoursByFaculteProperty(){
        return coursModel::where('status', 'Actif')->where('codeFac', $this->codeFac)->where('niveau', $this->niveau)->where('session',$this->session)->get();
    }

    public function rules()
    {
        return [
            'codeFac'      => 'required',
            'niveau'       => 'required|min:1|max:5',
            'session'      => 'required|in:1,2',

            'cours'        => 'required|max:255',
            'jour'         => 'required|in:Lundi,Mardi,Mercredi,Jeudi,Vendredi,Samedi,Dimanche',

            'heure_debut'  => 'required|date_format:H:i',
            'heure_fin'    => 'required|date_format:H:i|after:heure_debut',

            'salle'        => 'nullable|string|max:50',
        ];
    }


    protected $messages = [
        'codeFac.required'     => 'Faculté requise.',
        'niveau.required'      => 'Niveau requis.',
        'session.required'     => 'Session obligatoire.',
        'cours.required'       => 'Nom du cours manquant.',
        'jour.required'        => 'Sélectionner un jour.',
        'heure_debut.required' => 'Heure de début requise.',
        'heure_fin.required'   => 'Heure de fin requise.',
        'heure_fin.after'      => 'L’heure de fin doit être après l’heure de début.',
        'conflit'              => 'Ce créneau est déjà pris.',
    ];


    public function verifierConflit()
    {
        return horaireFaculesModel::where('codeFac', $this->codeFac)
            ->where('niveau', $this->niveau)
            ->where('session', $this->session)
            ->where('jour', $this->jour)
            ->where(function ($query) {
                $query->whereBetween('heure_debut', [$this->heure_debut, $this->heure_fin])
                    ->orWhereBetween('heure_fin', [$this->heure_debut, $this->heure_fin])
                    ->orWhere(function ($q) {
                        $q->where('heure_debut', '<=', $this->heure_debut)
                            ->where('heure_fin', '>=', $this->heure_fin);
                    });
            })
            ->exists();
    }


    public function rechercherNomCours(){
        return coursModel::where('codeCours', $this->cours)->first();
    }

    public function save()
    {
        // Validation
        $validatedData = $this->validate();

        // Vérification decs onflits d'horaires
        if ($this->verifierConflit()) {
            $this->addError('conflit', $this->messages['conflit']);
            return;
        }

        // Enregistrement
        horaireFaculesModel::create([
            'codeFac'      => $this->codeFac,
            'niveau'       => $this->niveau,
            'session'      => $this->session,
            
            'cours'        => $this->rechercherNomCours()->nom,
            'codeCours'    => $this->cours,
            'jour'         => $this->jour,

            'heure_debut'  => $this->heure_debut,
            'heure_fin'    => $this->heure_fin,

            'salle'        => $this->salle ?? null,
        ]);

        // Message succès
        $this->dispatch('success', message: 'Horaire ajouté avec succès.');

        audit(Auth::user()->personnel->code, "Ajour d'un horaire", $this->codeCours, request()->ip());
        broadcast(new updatedTable(''));

        // Reset des champs (optionnel mais recommandé)
        $this->reset([
            'cours',
            'jour',
            'heure_debut',
            'heure_fin',
            'salle',
        ]);
    }


    public function render()
    {
        return view('livewire.pages.cours.formulaire-horaire-fac');
    }
}
