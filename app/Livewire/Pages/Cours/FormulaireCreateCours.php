<?php

namespace App\Livewire\Pages\Cours;

use App\Events\addedCours;
use App\Models\coursModel;
use App\Models\faculteModel;
use App\Models\professeurModel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Livewire\Attributes\On;
use Livewire\Component;
use App\Events\DataUpdated;
use App\Events\updatedTable;
use App\Models\notificationModel;
use App\Models\utilisateurModel;

class FormulaireCreateCours extends Component
{
    public $codeCours;
    public $nom;
    public $codeFac;
    public $niveau;
    public $session;
    public $codeProf;
    public $formVar;
    public $id;
    public ?coursModel $cours=null;

    protected $listeners = [
         'refreshTable'=>'$refresh',
         'success'=>'$refresh',
    ];

    public function titreForm(){
        if($this->formVar==1){
            return "Modifier un cours";
           
        }
        else{
            return "Ajouter un nouveau cours";
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

    public function getProfesseursProperty(){
        return professeurModel::all();
    }


    protected function rules()
    {
        return [
            // 'codeCours' => 'required|max:15|unique:cours_tb,codeCours',
            'codeCours' => [
                'required',
                Rule::unique('cours_tb', 'codeCours')
                    ->ignore($this->cours?->id)
            ],
            'nom'       => 'required|string|max:255',
            'codeFac'   => 'required|max:10',
            'niveau'    => 'required',
            'session'   => 'required|in:1,2',
            'codeProf'  => 'required|max:15',
        ];
    }



    protected $messages = [
        'codeCours.required' => 'Le code du cours est obligatoire.',
        'codeCours.max'      => 'Le code du cours ne peut pas dépasser 15 caractères.',
        'codeCours.unique'   => 'Ce code de cours existe déjà.',

        'nom.required'       => 'Veuillez saisir le nom du cours.',
        'nom.string'         => 'Le nom du cours doit être du texte.',
        'nom.max'            => 'Le nom du cours est trop long.',

        'codeFac.required'   => 'Le code de la faculté est obligatoire.',
        // 'codeFac.string'     => 'Le code de la faculté doit être du texte.',
        'codeFac.max'        => 'Le code de la faculté est trop long.',

        'niveau.required'    => 'Le niveau est requis.',
        // 'niveau.integer'     => 'Le niveau doit être un nombre.',
        // 'niveau.between'     => 'Le niveau doit être entre 1 et 5.',

        'session.required'   => 'La session est obligatoire.',
        // 'session.string'     => 'La session doit être un texte.',
        'session.in'         => 'La session doit être 1 ou 2.',

        'codeProf.required'  => 'Le code du professeur est obligatoire.',
        // 'codeProf.string'    => 'Le code du professeur doit être du texte.',
        'codeProf.max'       => 'Le code du professeur est trop long.',
    ];

    private function generateCodeCours()
    {
        do {
            $code = 'CRS-' . mt_rand(1000, 9999);
        } while (coursModel::where('codeCours', $code)->exists());

        return $code;
    }


    public function mount(){
        $this->codeCours=$this->generateCodeCours();
    }

    public function resetForm(){

        $this->reset([
            'codeCours',
            'nom',
            'codeFac',
            'niveau',
            'session',
            'codeProf'
        ]);

        $this->codeCours=$this->generateCodeCours();
        $this->resetErrorBag();
    }

    public function save(){
        
        $validatedData = $this->validate();

        if($this->id==null){
        try {
          $cours = coursModel::create([
                'codeCours'=> $this->codeCours,
                'nom'=>$this->nom,
                'codeFac'=>$this->codeFac,
                'niveau'=>$this->niveau,
                'session'=>$this->session,
                'codeProf'=>$this->codeProf,
                'status'=>'Actif'
          ]);
          $this->dispatch('success', message: 'Cours ajouté avec succès!');
          $audit = audit(Auth::user()->personnel->code, "Creation d'un cours", $this->codeCours, request()->ip());
          broadcast(new updatedTable(''));
          broadcast(new addedCours(Auth::user(), $cours));

          //NOTIFICATION 
            // ->roles->first()->nom ?? ''
            $user =  utilisateurModel::with('roles')->get();
            $message = 'Ajoute un nouveau cours ( '.$cours->nom.' ) dans la faculte: '.faculteModel::where('codeFac',$this->codeFac)->value('nom');
            // 🧹 nettoyer codeFac (IMPORTANT)
            $codeFacUser = null;
            foreach($user as $u){
                $role = $u->roles()->first();
                

                if ($role && $role->pivot) {
                    $value = trim($role->pivot->codeFac);

                    if (!empty($value) && !in_array($value, ['null', '[null]'])) {
                        $codeFacUser = $value;
                    }
                }

                if(($u->roles->first()->nom ?? '')=="Administrateur" || ($u->roles->first()->nom ?? '')=="Secrétaire générale" || (($u->roles->first()->nom ?? '')=="Doyen de faculté" && ($codeFacUser)== $this->codeFac )   || (($u->roles->first()->nom ?? '')=="Vice-doyen de faculté" && ($codeFacUser)== $this->codeFac )  || (($u->roles->first()->nom ?? '')=="Secretaire faculte" && ($codeFacUser)== $this->codeFac ) ) {

                    notificationModel::create([
                    'notification_id'=> $audit->id,
                    'user_id'=>$u->id,
                    'message'=>$message
                    ]);
                }
                
            }
            //FIN NOTIFICATION

          $this->resetForm();

          } catch (\Throwable $th) {
            //throw $th;
            // $th->getMessage();
            $this->dispatch('erreur', message: 'Une erreur est servenue, veuillez reessayer.' );
            $this->resetForm();
        }
          
        }
        else{
            $coursUpdate = coursModel::find($this->id);

            // remplir les nouvelles valeurs
            $coursUpdate->fill([
                'codeCours'=> $this->codeCours,
                'nom'=>$this->nom,
                'codeFac'=>$this->codeFac,
                'niveau'=>$this->niveau,
                'session'=>$this->session,
                'codeProf'=>$this->codeProf
            ]);

            // vérifier si au moins un champ a changé
            if ($coursUpdate->isDirty()) {

                $coursUpdate->save();
                $this->dispatch('success', message: 'Cours modifié avec succès!');
                audit(Auth::user()->personnel->code, "Modification d'un cours", $this->codeCours, request()->ip());
                broadcast(new updatedTable(''));

            } else {

                $this->dispatch('info', message: 'Aucune modification détectée.');
            }
        }
    }


    #[On('edit-cours')]  
    public function edit($id){
            $this->id=$id;
            $this->cours = coursModel::findOrFail($id);

            $this->fill([
                'codeCours' => $this->cours->codeCours,
                'codeProf' => $this->cours->codeProf,
                'codeFac' => $this->cours->codeFac,
                'nom' => $this->cours->nom,
                'niveau' => $this->cours->niveau,
                'session' => $this->cours->session,
            ]);

            $this->formVar=1;
            // $this->isEdit = true;
            // $this->id = $this->eleve->id;    
    }


    public function render()
    {
        return view('livewire.pages.cours.formulaire-create-cours');
    }
}
