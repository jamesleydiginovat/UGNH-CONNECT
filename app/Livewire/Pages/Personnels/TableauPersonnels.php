<?php

namespace App\Livewire\Pages\Personnels;

use App\Events\createdPersonnel;
use App\Events\deletePersonnel;
use App\Events\updatedTable;
use App\Models\notificationModel;
use App\Models\personnelsModel;
use App\Models\utilisateurModel;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;
use Whoops\Run;

// use PhpParser\Node\Stmt\Echo_;
// use Barryvdh\DomPDF\Facade\Pdf;

class TableauPersonnels extends Component
{

    use WithPagination;

    protected $listeners = [
        'refreshTable'=>'$refresh',
        'success' => '$refresh',
        'success-delete'=> '$refresh',
        // 'refreshDocuments'=>'$refresh',
    ];

    public $search="";
    public $filterSexe="";

        // public function downloadPdf()
        // {
        //     $personnels = personnelsModel::all();
        //     $total = $personnels->count();

        //     $pdf = ::loadView('pdf.personnels-report', compact(
        //         'personnels',
        //         'total'
        //     ))->setPaper('A4', 'portrait');

        //     return response()->streamDownload(
        //         fn () => print($pdf->output()),
        //         "rapport-personnels.pdf"
        //     );
        // }
    //afficher tous les personnels
    public function getPersonnelsProperty(){
        if($this->search!=""){
            return personnelsModel::where('status', 'Active')
            ->where(function ($query) {
            $query->where('nom', 'ILIKE', "%{$this->search}%")
                    ->orWhere('prenom', 'ILIKE', "%{$this->search}%")
                    ->orWhere('code', 'ILIKE', "%{$this->search}%");
            })
            ->orderBy('id', 'ASC')
            ->paginate(12);
            
        }
        else{
            if($this->filterSexe==""){
                return personnelsModel::where('status', 'Active')->orderBy('id','DESC')->paginate(12);
            }
            else{
                return personnelsModel::where('status', 'Active')->when($this->filterSexe, function ($query) {
                $query->where('sexe', 'ILIKE', "%{$this->filterSexe}%");
                })
                ->orderBy('id', 'ASC')
                ->paginate(12);
            }
           
        }

    }


    //Supprimer un personnel dans le tableau d'affichage
    public function deletePersonnel($id){
        try {
            // $this->jamesley();
            //verification 
            $codePersonnel = personnelsModel::where('id', $id)->value('code');
            $statut = utilisateurModel::where('codePersonnel', $codePersonnel)->value('statut');

            if($statut != "1"){
                $personnel = personnelsModel::find($id);
                personnelsModel::find($id)->update([
                    'status' => 'Supprimer'
                ]);
                 
                $this->dispatch('success-delete', message: 'Personnel supprimé avec succès!');
                
                utilisateurModel::where('codePersonnel', personnelsModel::find($id))->delete();

                broadcast(new updatedTable(''));
                broadcast(new deletePersonnel($personnel, Auth::user()));
                $this->dispatch('success', message: 'Personnel ajouté avec succès!');


                $action ="Suppression d'un personnel";
                $audit = audit(Auth::user()->personnel->code, $action, $codePersonnel );

                //NOTIFICATION 
                $user =  utilisateurModel::with('roles')->get();
                $message = 'Supprime le personnel ('.$codePersonnel.') dans le système.';

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
                 return $this->dispatch('erreur', message: 'Une erreur est servenue, ce personnel est un utilisateur en ligne.');
            }
            
        } catch (\Throwable $th) {
            //throw $th;
            return $this->dispatch('erreur', message: 'Une erreur est servenue, veuillez reessayer.');
        }
        
    }   
    public $personnelSelectionner;
    public function selectionPersonnel($id){
         $this->personnelSelectionner=$id;
    }
    public function sessionEdit($id){
        $this->dispatch('edit-personnel', id: $id);
    }
    public function render()
    {
        return view('livewire.pages.personnels.tableau-personnels');
    }
}
