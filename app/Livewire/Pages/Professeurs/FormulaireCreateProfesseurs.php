<?php

namespace App\Livewire\Pages\Professeurs;

use App\Events\updatedTable;
use App\Models\professeurModel;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithFileUploads;

// use function Symfony\Component\Clock\now;

class FormulaireCreateProfesseurs extends Component
{
    use WithFileUploads;
    public $codeProf;
    public $nom;
    public $prenom;
    public $adresse;
    public $telephone;
    public $email;
    public $sexe;
    public $specialite;
    public $conditionMatrimoniale;
    public $dateNaissance;
    public $dateEmbauche;
    public $photo;
    public $status;

    public $photoAfficher=null;

    public $id = null;

    public professeurModel $professeurs;



    // fonksyon pour mete kontrent sou champ yo nan formulaire lan
    public function rules(){
        return [
        'nom' => 'required|min:3|regex:/^[A-Za-zÀ-ÿ\s]+$/',
        'prenom' => 'required|min:3|regex:/^[A-Za-zÀ-ÿ\s]+$/',
        'sexe' => 'required',
        // 'adresse' => 'min:5',
        'telephone' => 'required|min:8',
        'email'=>'required|min:8',
        'specialite'=>'required',
        'conditionMatrimoniale'=>'required',
        // 'dateNaissance'=>'required',
        // 'dateEmbauche'=>'required',
        'adresse'=>'required|min:5'

        ];
    }
    // se isi a mwen personalize message erreur yo pou le gn yon erreur ki fet nn programme lan pou tel ou tel erreur afficher
     protected $messages = [
        'nom.min' => 'Le nom est trop court',
        'nom.required' => 'Le nom est obligatoire',
        'prenom.min' => 'Le prenom est trop court',
        'prenom.required' => 'Le prenom est obligatoire',
        'sexe.required' => 'Le sexe est obligatoire',
        'fonction.required' => 'La fonction est obligatoire',
        'specialite.required' => "Le specialite est obligatoire",
        'email.required' => "L'Email est obligatoire",
        'email.min' => "L'Email est trop court",
        'adresse.required'=>"l'adresse est obligatoire",
        'adresse.min' => "L'adresse est trop courte",
        'telephone.min'=>"Entrez un vrai numero telephone",
        'conditionMatrimoniale.required'=>"La condition matrimoniale est obligatoire"
    ];


    public function resetForm(){
         $this->reset([
                'codeProf',
                'nom',
                'prenom',
                'adresse',
                'telephone',
                'email',
                'sexe',
                'specialite',
                'conditionMatrimoniale',
                'dateNaissance',
                'dateEmbauche',
                'photo',
                'status'
            ]);

    $this->resetErrorBag();
    $this->codeProf = $this->generateCodeProf();
    }

    private function generateCodeProf()
    {
        do {
            $code = mt_rand(10, 99) . 'PROF' . mt_rand(1000, 9999); 
        } while (professeurModel::where('codeProf', $code)->exists());

        return $code;
    }


    public function mount()
    {
            $this->codeProf = $this->generateCodeProf();
    }

    #[On('edit-professeur')]  
    public function edit($id){
            $this->id=$id;
            $this->professeurs = professeurModel::findOrFail($id);
            $this->photoAfficher =$this->professeurs->photo;
            $this->fill([
                'codeProf' => $this->professeurs->codeProf,
                'nom' => $this->professeurs->nom,
                'prenom' => $this->professeurs->prenom,
                'sexe' => $this->professeurs->sexe,
                'adresse' => $this->professeurs->adresse,
                'telephone' => $this->professeurs->telephone,
                'specialite' => $this->professeurs->specialite,
                'dateNaissance' => $this->professeurs->dateNaissance,
                'lieuNaissance' => $this->professeurs->lieuNaissance,
                'conditionMatrimoniale' => $this->professeurs->conditionMatrimoniale,
                'email' => $this->professeurs->email,
            ]);
    }


    public function save(){
         $validatedData = $this->validate();
         $photoName = null;
        if ($this->photo) {

            // récupérer l'extension
            $extension = $this->photo->getClientOriginalExtension();

            // nom de la photo = matricule
            $photoName = $this->codeProf . '.' . $extension;
            
        }

        if($this->id==null){
            // dd('jamesley');
            $this->dateEmbauche = now()->format('Y-m-d');
            $this->dateNaissance = now()->format('Y-m-d');
            professeurModel::create([
            'codeProf' => $this->codeProf,
            'nom' => $this->nom,
            'prenom' => $this->prenom,
            'adresse' => $this->adresse,
            'telephone' => $this->telephone,
            'email' => $this->email,
            'sexe' => $this->sexe,
            'specialite' => $this->specialite,
            'conditionMatrimoniale' => $this->conditionMatrimoniale,
            'dateNaissance' => $this->dateNaissance,
            'dateEmbauche' => $this->dateEmbauche,
            'photo' => $photoName ? : null,
            'status' => $this->status ?? 'Actif', // valeur par défaut Actif
            
        ]);


        if($photoName!=null){

            // enregistrer dans storage/app/public/photosEtudiants
            $this->photo->storeAs('photosProfesseurs', $photoName, 'public');

        }

        
        // session()->forget('success');
        $this->dispatch('success', message: 'Professeur ajouté avec succès!');
        broadcast(new updatedTable(''));
        $action ="Ajout d'un professeur";
        audit(Auth::user()->personnel->code, $action, $this->codeProf);
        $this->resetForm();
        $this->codeProf = $this->generateCodeProf();
        }
        else{

            // gérer la photo
            if ($this->photo) {
                $extension = $this->photo->getClientOriginalExtension();
                $photoName = $this->codeProf . '.' . $extension;
            } else {
                $photoName = $this->photoAfficher;
            }

            // remplir le modèle sans sauvegarder
            $this->professeurs->fill([
                // 'codeProf' => $this->codeProf,
                'nom' => $this->nom,
                'prenom' => $this->prenom,
                'adresse' => $this->adresse,
                'telephone' => $this->telephone,
                'email' => $this->email,
                'sexe' => $this->sexe,
                'specialite' => $this->specialite,
                'conditionMatrimoniale' => $this->conditionMatrimoniale,
                'dateNaissance' => $this->dateNaissance,
                // 'dateEmbauche' => $this->dateEmbauche,
                'photo' => $photoName ?: null,
                // 'status' => $this->status ?? 'Actif',
            ]);

            if ($this->professeurs->isDirty()) {

                $this->professeurs->save();

                if ($this->photo) {
                    $this->photo->storeAs('photosProfesseurs', $photoName, 'public');
                }

                $this->dispatch('success', message: 'Professeur modifié avec succès!');
                broadcast(new updatedTable(''));
                $action ="Modification d'un professeur";
                audit(Auth::user()->personnel->code, $action, $this->codeProf);
            } else {
                $this->dispatch('info', message: 'Aucune modification détectée.');
            }
        }
    }


    public function makeIdNull(){
        $this->id=null;
        $this->resetForm();
    }

    public function render()
    {
        return view('livewire.pages.professeurs.formulaire-create-professeurs');
    }
}
