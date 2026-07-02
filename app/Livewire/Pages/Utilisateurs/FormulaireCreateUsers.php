<?php

namespace App\Livewire\Pages\Utilisateurs;

use App\Events\updatedTable;
use App\Models\faculteModel;
use App\Models\personnelsModel;
use App\Models\roleModel;
use App\Models\roleUtilisateur;
use App\Models\utilisateurModel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Psy\Util\Str;

class FormulaireCreateUsers extends Component
{
    // public function save(){
    //     dd("ceci es le livewire des utilisateur et cela marche tres bien!");
    // }
    public $id;
    public $codePersonnel; 
    public $nom;
    public $prenom;
    public $adresse;
    public $sexe;
    public $email;
    public $telephone;
    public $fonction;
    public $conditionMatrimonial;
    public $role_id;

    public personnelsModel $personnel;

    public $motDePasse;
    public $statut ='0';
    public $nomUtilisateur;
    public $codeFac;

    protected $listeners = [
        'success' => '$refresh',
        'success-user' => '$refresh',
        'success-delete'=> '$refresh',
        'refreshTable'=>'$refresh',
    ];


    private function generateNomUtilisateur(){
            $nomUtilisateur = explode(" ", $this->nom)[0].explode(" ", $this->prenom)[0]. mt_rand(0, 9);
            if(utilisateurModel::where('nomUtilisateur', $nomUtilisateur)->exists()){
                $nomUtilisateur.='1';
            }

            return $nomUtilisateur;
    }

    private function generateMotDePasse(){
        do{
            $motDePasse = explode(" ",$this->nom)[0].explode(" ",$this->prenom)[0]. mt_rand(0, 999);
            return $motDePasse;
        }while(strlen($motDePasse)>=8);
            
    }

    public function getNomRole(){
        if($this->role_id!=""){
            return roleModel::where('id' ,$this->role_id)->value('nom');
        }
        
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


    public function remplirForm(){
        if($this->id !=null){
            $this->personnel = personnelsModel::findOrFail($this->id);
            $this->fill([
                'codePersonnel' => $this->personnel->code,
                'nom' => $this->personnel->nom,
                'prenom' => $this->personnel->prenom,
                'sexe' => $this->personnel->sexe,
                'telephone' => $this->personnel->telephone,
                'adresse' => $this->personnel->adresse,
                'email' => $this->personnel->email,
                'fonction' => $this->personnel->fonction,
                'conditionMatrimonial' => $this->personnel->conditionMatrimoniale
            ]);
        }
           

            // dd($this->id);
    }
        
        public function resetForm(){

            $this->reset([
            'nom',
            'prenom',
            'id',
            'sexe',
            'adresse',
            'telephone',
            'email',
            'fonction',
            'conditionMatrimonial',
            'role_id'
            
        ]);

    }

    public function save(){
    try {
       // $validatedData = $this->validate();
        $this->nomUtilisateur= $this->generateNomUtilisateur();
        $this->motDePasse=$this->generateMotDePasse();

            utilisateurModel::create([
            'codePersonnel' => $this->codePersonnel,
            'nomUtilisateur' => $this->nomUtilisateur,
            'motDePasse' => Hash::make($this->motDePasse),
            'statut' => $this->statut,
        ]);

        roleUtilisateur::create([
            'nomUtilisateur' => $this->nomUtilisateur,
            'role_id' => $this->role_id,
            'codeFac'=>$this->codeFac
        ]);

        
        $this->dispatch('success-user', message: "Utilisateur cree avec succes");
        broadcast(new updatedTable(''));
        $action ="Creation d'un compte utilisateur";
        audit(Auth::user()->personnel->code, $action, $this->codePersonnel);
        $this->resetForm();
    } catch (\Throwable $th) {
        // $this->dispatch('success-user', message: "Utilisateur cree avec succes");
    }
    
    }

    public function mount(){
        
    }
    public function getPersonnelsProperty(){
         return personnelsModel::all();
    }
    
    public function getRolesProperty(){
        return roleModel::all();
    }
    public function render()
    {
        return view('livewire.pages.utilisateurs.formulaire-create-users');
    }
}
