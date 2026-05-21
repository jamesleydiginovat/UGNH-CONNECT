<?php

namespace App\Livewire\Pages\Personnels;

use App\Events\createdPersonnel;
use App\Events\modificationPersonnel;
use App\Events\updatedTable;
use App\Models\etudiantModel;
use App\Models\notificationModel;
use App\Models\personnelsModel;
use App\Models\roleModel;
use App\Models\utilisateurModel;
use Barryvdh\Snappy\Facades\SnappyPdf as PDF;
use Illuminate\Broadcasting\Channel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Auth as FacadesAuth;
use Livewire\Attributes\On;
use Livewire\Component;

class FormulaireCreatePersonnel extends Component
{
    public $id=null;
    public $code;
    public $nom;
    public $prenom;
    public $adresse;
    public $sexe;
    public $email;
    public $telephone;
    public $fonction;
    public $conditionMatrimonial;
    public $status;



    
    public personnelsModel $personnel;
    public $formVar;
    public function titreForm(){
        if($this->formVar==1){
            return "Modifier un personnel";
           
        }
        else{
            return "Ajouter un nouveau personnel";
        }
    }


    public function getRolesProperty(){
        return roleModel::all();
    }

    // fonksyon pour mete kontrent sou champ yo nan formulaire lan
    public function rules(){
        return [
        'nom' => 'required|min:3|regex:/^[A-Za-zÀ-ÿ\s]+$/',
        'prenom' => 'required|min:3|regex:/^[A-Za-zÀ-ÿ\s]+$/',
        'sexe' => 'required',
        // 'adresse' => 'min:5',
        'telephone' => 'required|min:8',
        'email'=>'required|min:8',
        'fonction'=>'required',
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
        'email.required' => "L'email est obligatoire",
        'email.min' => "L'email est trop court",
    ];

    private function generateMatricule()
    {
        do {
            $code = 'PRS-' . mt_rand(100000, 999999); // ⚡ 6 chiffres
        } while (personnelsModel::where('code', $code)->exists());

        return $code;
    }


    public function mount()
    {
            $this->code = $this->generateMatricule();
    }

    public function resetForm(){

            $this->reset([
            'nom',
            'prenom',
            'code',
            'sexe',
            'adresse',
            'telephone',
            'email',
            'fonction',
            'conditionMatrimonial',
            'status',
            
        ]);
        $this->resetErrorBag();
        $this->code = $this->generateMatricule();

        $this->formVar=0;
        $this->id=null;
    }
        

    public function updated($property)
    {
        $this->validateOnly($property);
    }

    public function save(){

        $validatedData = $this->validate();

        if($this->id==null){
        
        try {
            // $this->jamesle();
            $personnel = personnelsModel::create([
            'code' => $this->code,
            'nom' => $this->nom,
            'prenom' => $this->prenom,
            'sexe' => $this->sexe,
            'telephone' => $this->telephone,
            'adresse' => $this->adresse,
            'email' => $this->email,
            'fonction' => $this->fonction,
            'conditionMatrimoniale' => $this->conditionMatrimonial,
            'status'=>'Active'
            ]);

            
            // event(new NouveauDocument("Un nouveau document est disponible"));
            // event(new updatedTable('Personne ajouter avec succes dans la base de donnees! '));
            broadcast(new updatedTable(''));
            broadcast(new createdPersonnel($personnel, Auth::user()));
            $this->dispatch('success', message: 'Personnel ajouté avec succès!');


            $action ="Ajout d'un personnel";
            $audit = audit(Auth::user()->personnel->code, $action, $this->code);

            //NOTIFICATION 
            $user =  utilisateurModel::with('roles')->get();
            $message = 'Ajoute le personnel ('.$this->code.') dans le système.';

            foreach($user as $u){
                if(($u->roles->first()->nom ?? '')=="Administrateur" || ($u->roles->first()->nom ?? '')=="Secrétaire générale"){

                    notificationModel::create([
                    'notification_id'=> $audit->id,
                    'user_id'=>$u->id,
                    'message'=>$message
                    ]);
                }
                
            }
            //FIN NOTIFICATION


            $this->resetForm();
            // session()->forget('success');
            $this->code = $this->generateMatricule();

        } catch (\Throwable $th) {
            //throw $th;
            // $th->getMessage();
            $this->dispatch('erreur', message: 'Une erreur est servenue, veuillez reessayer.' );
            $this->resetForm();
        }
        }
        else{
            $personnelUpdate = personnelsModel::find($this->id);

            // remplir les nouvelles valeurs
            $personnelUpdate->fill([
                'nom' => $this->nom,
                'prenom' => $this->prenom,
                'sexe' => $this->sexe,
                'telephone' => $this->telephone,
                'adresse' => $this->adresse,
                'email' => $this->email,
                'fonction' => $this->fonction,
                'conditionMatrimoniale' => $this->conditionMatrimonial,
                'status'=>$this->status,
            ]);

            // vérifier si au moins un champ a changé
            if ($personnelUpdate->isDirty()) {

                if($personnelUpdate->isDirty('status')){

                        $codePersonnel = personnelsModel::where('id', $this->id)->value('code');
                        $statut = utilisateurModel::where('codePersonnel', $codePersonnel)->value('statut');

                        if($this->status =="Retraité" || $this->status =="Renvoyé" ){
                            
                        
                            if($statut != "1"){

                                $personnelUpdate->save();
                                utilisateurModel::where('codePersonnel', $codePersonnel)->delete();
                                broadcast(new updatedTable(''));
                                broadcast(new modificationPersonnel($personnelUpdate, Auth::user()));
                                $this->dispatch('success', message: 'Personnel '. $this->status.' avec succès!');

                                $action ="Changement de status en".$this->status."d'un personnel";
                                $audit = audit(Auth::user()->personnel->code, $action, $codePersonnel);
                                //NOTIFICATION 
                                $user =  utilisateurModel::with('roles')->get();
                                $message = 'Modifie le status du personnel ('.$codePersonnel.') en '. $this->status.' dans le système.';

                                foreach($user as $u){
                                    if(($u->roles->first()->nom ?? '')=="Administrateur" || ($u->roles->first()->nom ?? '')=="Secrétaire générale"){

                                        notificationModel::create([
                                        'notification_id'=> $audit->id,
                                        'user_id'=>$u->id,
                                        'message'=>$message
                                        ]);
                                    }
                                    
                                }
                                //FIN NOTIFICATION
                            }
                            else{
                                return $this->dispatch('erreur', message: 'Une erreur est servenue, ce personnel est un utilisateur en ligne, donc vous pouvez pas changer.');
                            }
                            
                        }
                        else{

                            $personnelUpdate->save();
                            utilisateurModel::where('codePersonnel', $codePersonnel)->update([
                                'etat' => $this->status
                            ]);
                            broadcast(new updatedTable(''));
                            broadcast(new modificationPersonnel($personnelUpdate, Auth::user()));
                            $this->dispatch('success', message: 'Personnel '. $this->status.' avec succès!');

                            $action ="Changement de status en".$this->status."d'un personnel";
                            $audit =audit(Auth::user()->personnel->code, $action, $codePersonnel);
                            //NOTIFICATION 
                            $user =  utilisateurModel::with('roles')->get();
                            $message = 'Modifie le status du personnel ('.$codePersonnel.') en '. $this->status.' dans le système.';

                            foreach($user as $u){
                                if(($u->roles->first()->nom ?? '')=="Administrateur" || ($u->roles->first()->nom ?? '')=="Secrétaire générale"){

                                    notificationModel::create([
                                    'notification_id'=> $audit->id,
                                    'user_id'=>$u->id,
                                    'message'=>$message
                                    ]);
                                }
                                
                            }
                            //FIN NOTIFICATION
                            
                        }

                }
                else{
                    $personnelUpdate->save();
                    broadcast(new updatedTable(''));
                    broadcast(new modificationPersonnel($personnelUpdate, Auth::user()));
                    $this->dispatch('success', message: 'Personnel modifié avec succès!');

                    $action ="Modification d'un personnel";
                    $audit= audit(Auth::user()->personnel->code, $action, $this->code);

                    //NOTIFICATION 
                    // ->roles->first()->nom ?? ''
                    $user =  utilisateurModel::with('roles')->get();
                    $message = 'Modifie le personnel ('.$this->code.') dans le système.';

                    foreach($user as $u){
                        if(($u->roles->first()->nom ?? '')=="Administrateur" || ($u->roles->first()->nom ?? '')=="Secrétaire générale"){

                            notificationModel::create([
                            'notification_id'=> $audit->id,
                            'user_id'=>$u->id,
                            'message'=>$message
                            ]);
                        }
                        
                    }
                    //FIN NOTIFICATION
                }


            } else {

                $this->dispatch('info', message: 'Aucune modification détectée.');
            }
        }
        
    }




    #[On('edit-personnel')]  
    public function edit($id){
            $this->id=$id;
            $this->personnel = personnelsModel::findOrFail($id);

            $this->fill([
                'code' => $this->personnel->code,
                'nom' => $this->personnel->nom,
                'prenom' => $this->personnel->prenom,
                'sexe' => $this->personnel->sexe,
                'telephone' => $this->personnel->telephone,
                'adresse' => $this->personnel->adresse,
                'email' => $this->personnel->email,
                'fonction' => $this->personnel->fonction,
                'conditionMatrimonial' => $this->personnel->conditionMatrimoniale,
                'status'=> $this->personnel->status
            ]);

            $this->formVar=1;
            // $this->isEdit = true;
            // $this->id = $this->eleve->id;    

    }


    // public function pdf(){
    //     return PDF::loadHTML('<h1>Je suis jamesley PHILIPPE</h1>')->download('test.pdf');
    // }




    public function render()
    {
        return view('livewire.pages.personnels.formulaire-create-personnel');
    }
}
