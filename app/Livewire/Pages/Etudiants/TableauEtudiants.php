<?php

namespace App\Livewire\Pages\Etudiants;

use App\Events\statusChangedEtudiant;
use App\Events\updatedTable;
use App\Http\Controllers\anneesAccademiques;
use App\Models\annnee_accademiqueModel;
use App\Models\etudianFaculteModel;
use App\Models\etudiantModel;
use App\Models\faculteModel;
use App\Models\notificationModel;
use App\Models\paimentEtudiantModel;
use App\Models\utilisateurModel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class TableauEtudiants extends Component
{   
    public $search;
    public $filterSexe;
    public $niveau;
    public $faculte;
    public $status;
    public $anneeAccademique;
    use WithPagination;

    protected $listeners = [
    'success' => '$refresh',
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

    public function anneeAccademiqueActive(){
        return annnee_accademiqueModel::where('active', true)->first();
    }

    public function mount(){
        $this->anneeAccademique = $this->anneeAccademiqueActive()->libelle;
    }

    // public function getLesEtudiantsProperty(){
    //     if($this->search!=""){
    //         return etudiantModel::with('faculte')
    //         ->where('status', 'Etudiant') // toujours filtrer les étudiants
    //         ->where(function($query) {
    //             $query->where('nom', 'ILIKE', "%{$this->search}%")
    //                 ->orWhere('prenom', 'ILIKE', "%{$this->search}%")
    //                 ->orWhere('matricule', 'ILIKE', "%{$this->search}%");
    //         })
    //         ->orderBy('id', 'ASC')
    //         ->paginate(10);
            
    //     }
    //     else{
    //         if($this->filterSexe!="" && $this->niveau=="" && $this->faculte=="" && $this->status==""){
    //             $this->reset(['search']);
    //             return etudiantModel::with('faculte')
    //             ->where('status', 'Etudiant') 
    //             ->where(function($query) {
    //                 $query->where('sexe', 'ILIKE', "%{$this->filterSexe}%");
    //             })
    //             ->orderBy('id', 'ASC')
    //             ->paginate(10);
    //         }
    //         elseif($this->niveau!=""  && $this->filterSexe=="" && $this->faculte=="" && $this->status==""){
    //             return etudiantModel::with('faculte')
    //             ->where('status', 'Etudiant') 
    //             ->where(function($query) {
    //                 $query->where('niveau', 'ILIKE', "%{$this->niveau}%");
    //             })
    //             ->orderBy('id', 'ASC')
    //             ->paginate(10);
    //         }
    //         elseif($this->faculte!=""  && $this->niveau=="" && $this->filterSexe=="" && $this->status==""){
    //             return etudiantModel::with('faculte')
    //             ->where('status', 'Etudiant') // toujours les étudiants
    //             ->when($this->faculte, function($query) {
    //                 $query->whereHas('faculte', function($q) {
    //                     $q->where('codeFac', 'ILIKE', "%{$this->faculte}%");
    //                 });
    //             })
    //             ->orderBy('id', 'ASC')
    //             ->paginate(10);
    //         }
    //         elseif($this->faculte == "" && $this->niveau != ""  && $this->filterSexe !=""  && $this->status=="")
    //         {
                
    //             return etudiantModel::with('faculte')
    //                 ->where('status', 'Etudiant')
    //                 ->where('niveau', 'ILIKE', "%{$this->niveau}%")
    //                 ->where('sexe', 'ILIKE', "%{$this->filterSexe}%")
    //                 ->orderBy('id', 'ASC')
    //                 ->paginate(10);
    //         }
    //         elseif($this->faculte != "" && $this->niveau != ""  && $this->filterSexe=="" && $this->status=="")
    //         {
                
    //             return etudiantModel::with('faculte')
    //                 ->where('status', 'Etudiant')
    //                 ->where('niveau', 'ILIKE', "%{$this->niveau}%")
    //                 ->whereHas('faculte', function ($q) {
    //                     $q->where('codeFac', 'ILIKE', "%{$this->faculte}%");
    //                 })
    //                 ->orderBy('id', 'ASC')
    //                 ->paginate(10);
    //         }
    //         elseif($this->faculte != "" && $this->niveau != ""  && $this->filterSexe!="" && $this->status=="")
    //         {
                
    //             return etudiantModel::with('faculte')
    //                 ->where('status', 'Etudiant')
    //                 ->where('niveau', 'ILIKE', "%{$this->niveau}%")
    //                 ->where('sexe', 'ILIKE', "%{$this->filterSexe}%")
    //                 ->whereHas('faculte', function ($q) {
    //                     $q->where('codeFac', 'ILIKE', "%{$this->faculte}%");
    //                 })
    //                 ->orderBy('id', 'ASC')
    //                 ->paginate(10);
    //         }
    //         elseif($this->faculte == "" && $this->niveau == ""  && $this->filterSexe=="" && $this->status!="")
    //         {
                
    //             return etudiantModel::with('faculte')
    //                 ->where('status', $this->status)
    //                 ->orderBy('id', 'ASC')
    //                 ->paginate(10);
    //         }
    //         else{

    //             $user = Auth::user();

    //             $role = $user->roles()
    //                 ->where('nom', Auth::user()->roles->first()->nom ?? '')
    //                 ->first();

    //             $query = etudiantModel::with('faculte')
    //                 ->where('status', 'Etudiant')
    //                 ->orderBy('id', 'DESC');

    //             if ($role && $role->pivot->codeFac !="") {
    //                 $query->whereHas('faculte', function ($q)  use ($role) {
    //                                 $q->where('codeFac', 'ILIKE', "%{$role->pivot->codeFac}%");
    //                           });
    //             }

    //             $data = $query->paginate(10);
    //             if (
    //                 $role->pivot->codeFac &&
    //                 $role->pivot->codeFac !== 'null' &&
    //                 $role->pivot->codeFac !== '[null]'
    //             ) {
    //                 dd($role->pivot->codeFac);
    //             }
    //             else {
    //                 return etudiantModel::with('faculte')
    //                     ->where('status','Etudiant')
    //                     ->orderBy('id','DESC')
    //                     ->paginate(10);
    //             }
               

                
    //         }
            
    //     }
        
    // }


    public function getLesEtudiantsProperty()
    {
        $user = Auth::user();

        // 🔐 récupérer le rôle
        $role = $user->roles()->first();

        // 🧹 nettoyer codeFac (IMPORTANT)
        $codeFac = null;

        if ($role && $role->pivot) {
            $value = trim($role->pivot->codeFac);

            if (!empty($value) && !in_array($value, ['null', '[null]'])) {
                $codeFac = $value;
            }
        }

        // 📦 requête de base
        // $query = etudiantModel::with('faculte')
        //     ->where('status', $this->status != "" ? $this->status : 'Etudiant');

        $query = etudiantModel::with('faculte')
        ->where('status', $this->status != "" ? $this->status : 'Etudiant')
        ->whereExists(function ($q) {
            $q->select(DB::raw(1))
            ->from('paiement_etudiants')
            ->whereColumn('paiement_etudiants.matriculeEtudiant', 'etudiants_tb.matricule')
            ->where('paiement_etudiants.anneAccademique', $this->anneeAccademiqueActive()->libelle);
        });

        // 🔎 recherche globale
        if ($this->search != "") {
            $query->where(function ($q) {
                $q->where('nom', 'ILIKE', "%{$this->search}%")
                ->orWhere('prenom', 'ILIKE', "%{$this->search}%")
                ->orWhere('matricule', 'ILIKE', "%{$this->search}%");
            });
        }

        // 🎯 filtre sexe
        $query->when($this->filterSexe != "", function ($q) {
            $q->where('sexe', 'ILIKE', "%{$this->filterSexe}%");
        });

        // 🎯 filtre niveau
        $query->when($this->niveau != "", function ($q) {
            $q->where('niveau', 'ILIKE', "%{$this->niveau}%");
        });

        // 🎯 filtre faculté (manuel)
        $query->when($this->faculte != "", function ($q) {
            $q->whereHas('faculte', function ($sub) {
                $sub->where('codeFac', 'ILIKE', "%{$this->faculte}%");
            });
        });

        // 🔐 FILTRE AUTOMATIQUE PAR FACULTÉ (DOYEN / VICE / SECRETAIRE)
        $query->when($codeFac, function ($q) use ($codeFac) {
            $q->whereHas('faculte', function ($sub) use ($codeFac) {
                $sub->where('codeFac', 'ILIKE', "%{$codeFac}%");
            });
        });

        // 📊 retour final
        return $query->orderBy('id', 'DESC')->paginate(10);
    }

    public function remplirFromModifier($id){
         $this->dispatch('edit-etudiant', id: $id);
    }

    public function deletePostulant($id){
         etudiantModel::find($id)->delete();
        $action ="Admission echoue d'un postulant";
            
        audit(Auth::user()->personnel->code, $action, '-');
        
        broadcast(new updatedTable(''));
    }

    public function RecupererEtudiant($status, $id){
         $etudiant = etudiantModel::with('faculte')->where('id',$id)->first();
         if($status =="Etudiant"){
             
            $etudiant::find($id)->update([
            'status'=>$status
            ]);

            $this->dispatch('success',message:"Action reusit" );
            
            $action ="recuperation d'un etudiant";
            
            audit(Auth::user()->personnel->code, $action, $etudiant->matricule);
            
            broadcast(new updatedTable(''));
         }
    }
    public function changerStatus($status, $id){
        $etudiant = etudiantModel::with('faculte')->where('id',$id)->first();

        if($status =="Etudiant"){
             
            $etudiant::find($id)->update([
            'status'=>$status
            ]);
            
            etudianFaculteModel::create([
                'matriculeEtudiant'=>$etudiant->matricule,
                'codeFaculte'=>$etudiant->codeFac
            ]);
            
            paimentEtudiantModel::create([
                    'matriculeEtudiant' => $etudiant->matricule,
                    'codeFaculte' => $etudiant->codeFac,
                    'anneAccademique'=>$this->anneeAccademique,
                    'niveau' => $etudiant->niveau,
                    'session' => 1,
                    'premierVersement' => 0,
                    'deuxiemeVersement' => 0,
                    'troisiemeVersement' => 0,
                    'total' => 0,
                    'statut' => 'Valide'
            ]);
            
            paimentEtudiantModel::create([
                    'matriculeEtudiant' => $etudiant->matricule,
                    'codeFaculte' => $etudiant->codeFac,
                    'anneAccademique'=>$this->anneeAccademique,
                    'niveau' => $etudiant->niveau,
                    'session' => 2,
                    'premierVersement' => 0,
                    'deuxiemeVersement' => 0,
                    'troisiemeVersement' => 0,
                    'total' => 0,
                    'statut' => 'Valide'
            ]);
            
            $this->dispatch('success',message:"Action reusit" );
            
            $action ="Chagement de status d'un postulant";
            
            audit(Auth::user()->personnel->code, $action, $etudiant->matricule);
            
            broadcast(new updatedTable(''));
        }
        else{
             
            $etudiant::find($id)->update([
            'status'=>$status
            ]);
            $etudiants =etudiantModel::find($id);
            $matricule = etudiantModel::where('id', $id)->value('matricule');
            
            $this->dispatch('success',message:"Action reusit" );
            
            $action ="Chagement de status d'un etudiant";
            
            $audit = audit(Auth::user()->personnel->code, $action, $etudiant->matricule);
            
            broadcast(new updatedTable(''));
            broadcast(new statusChangedEtudiant(Auth::user(), $etudiants,$status));

            //NOTIFICATION 
            $user =  utilisateurModel::with('roles')->get();
            $message = 'A '.$status ." l'etudiant (".$matricule.") dans le système.";

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
    
    public function render()
    {
        return view('livewire.pages.etudiants.tableau-etudiants');
    }
}
