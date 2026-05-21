<?php

namespace App\Livewire\Pages\Cours;

use App\Events\addedCours;
use App\Events\deletedCours;
use App\Events\updatedTable;
use App\Models\coursModel;
use App\Models\faculteModel;
use App\Models\horaireFaculesModel;
use App\Models\notificationModel;
use App\Models\utilisateurModel;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class TableauCours extends Component
{

    public $search;
    public $byFaculte;
    public $byNiveau;
    public $bySession;

    use WithPagination;

    protected $listeners = [
    'success' => '$refresh',
    'success-delete'=> '$refresh',
    'refresh-table' => '$refresh',
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

    private function getCodeFac()
    {
        $user = Auth::user();
        $role = $user->roles()->first();

        $value = $role?->pivot?->codeFac;

        if (!empty($value) && !in_array($value, ['null', '[null]'])) {
            return trim($value);
        }

        return null;
    }

    public function getLesCoursProperty()
    {
        $query = coursModel::with(['faculte', 'professeur'])
            ->where('status', 'Actif');

        // 🔎 recherche globale
        if ($this->search != "") {
            $query->where(function ($q) {
                $q->where('nom', 'ILIKE', "%{$this->search}%")
                ->orWhere('codeCours', 'ILIKE', "%{$this->search}%")
                ->orWhere('codeProf', 'ILIKE', "%{$this->search}%");
            });
        }

        // 🎯 filtre faculté manuel
        $query->when($this->byFaculte != "", function ($q) {
            $q->where('codeFac', 'ILIKE', "%{$this->byFaculte}%");
        });

        // 🎯 filtre niveau
        $query->when($this->byNiveau != "", function ($q) {
            $q->where('niveau', 'ILIKE', "%{$this->byNiveau}%");
        });

        // 🎯 filtre session
        $query->when($this->bySession != "", function ($q) {
            $q->where('session', 'ILIKE', "%{$this->bySession}%");
        });

        // 🔐 FILTRE AUTOMATIQUE PAR FACULTÉ (DOYEN / VICE / ETC.)
        $query->when($this->getCodeFac(), function ($q) {
            $q->where('codeFac', 'ILIKE', "%{$this->getCodeFac()}%");
        });

        return $query->orderBy('id', 'DESC')->paginate(10);
    }

     //Supprimer un personnel dans le tableau d'affichage
    public function deleteCours($id){
        
        try {
                // dd($id);
                $codeCours = coursModel::find($id)->codeCours;
                $codeFac = coursModel::find($id)->codeFac;
                $cours = coursModel::find($id);
                coursModel::find($id)->update([
                    'status'=>'Supprimer'
                ]);
                
                horaireFaculesModel::where('codeCours', coursModel::find($id)->codeCours)->delete();
                
                $this->dispatch('success-delete', message: 'Cours supprimé avec succès!');
                $audit = audit(Auth::user()->personnel->code, "Suppression d'un cours", $codeCours, request()->ip());
                broadcast(new updatedTable(''));
                broadcast(new deletedCours(Auth::user(), $cours));

                //NOTIFICATION 
                    // ->roles->first()->nom ?? ''
                    $user =  utilisateurModel::with('roles')->get();
                    $message = 'Supprime le cours ( '.$cours->nom.' ) dans la faculte: '.faculteModel::where('codeFac',$codeFac)->value('nom');
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

                        if(($u->roles->first()->nom ?? '')=="Administrateur" || ($u->roles->first()->nom ?? '')=="Secrétaire générale" || (($u->roles->first()->nom ?? '')=="Doyen de faculté" && ($codeFacUser)== $codeFac )   || (($u->roles->first()->nom ?? '')=="Vice-doyen de faculté" && ($codeFacUser)== $codeFac )  || (($u->roles->first()->nom ?? '')=="Secretaire faculte" && ($codeFacUser)== $codeFac ) ) {

                            notificationModel::create([
                            'notification_id'=> $audit->id,
                            'user_id'=>$u->id,
                            'message'=>$message
                            ]);
                        }
                        
                    }
                    //FIN NOTIFICATION
            
        } catch (\Throwable $th) {
                //throw $th;
                return $this->dispatch('erreur', message: 'Une erreur est servenue, veuillez reessayer.');
        }
        
    }  

    public $CoursSelectionner;
    public function selectionCours($id){
         $this->CoursSelectionner=$id;
    }

    public function sessionEdit($id){
        $this->dispatch('edit-cours', id: $id);
    }

    public function render()
    {
        return view('livewire.pages.cours.tableau-cours');
    }
}
