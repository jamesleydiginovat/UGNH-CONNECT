<?php

namespace App\Livewire\Pages\Utilisateurs;

use App\Events\updatedTable;
use App\Models\personnelsModel;
use App\Models\utilisateurModel;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class TableauUtilisateurs extends Component
{
        use WithPagination; 

        protected $listeners = [
            'success' => '$refresh',
            'success-user' => '$refresh',
            'success-delete'=> '$refresh',
            'refreshTable'=>'$refresh',
        ];

        public string $search="";
        public string $filterSexe="";
        public string $filterFonction="";
        public string $filterStatut;


        public function getUtilisateursProperty(){
        if($this->search!=""){
            return DB::table('utilisateurs_tb')
                        ->join('personnels_tb', 'utilisateurs_tb.codePersonnel', '=', 'personnels_tb.code')
                        ->when($this->search, function ($query) {
                            $query->where(function ($q) {
                                $q->where('personnels_tb.nom', 'ILIKE', "%{$this->search}%")
                                ->orWhere('personnels_tb.prenom', 'ILIKE', "%{$this->search}%")
                                ->orWhere('utilisateurs_tb.nomUtilisateur', 'ILIKE', "%{$this->search}%")
                                ->orWhere('personnels_tb.code', 'ILIKE', "%{$this->search}%");
            });
        })
        ->orderBy('utilisateurs_tb.id', 'ASC')
        ->paginate(8);           
        }
        else{
            if($this->filterSexe==""){
                return  DB::table('utilisateurs_tb')
                            ->join('personnels_tb', 'utilisateurs_tb.codePersonnel', '=', 'personnels_tb.code')
                            ->paginate(8);
            }
            elseif($this->filterSexe!=""){

                return DB::table('utilisateurs_tb')
                        ->join('personnels_tb', 'utilisateurs_tb.codePersonnel', '=', 'personnels_tb.code')
                        ->when($this->filterSexe, function ($query) {
                            $query->where(function ($q) {
                                $q->where('personnels_tb.sexe', 'ILIKE', "%{$this->filterSexe}%");
                    });
                })
                ->orderBy('utilisateurs_tb.id', 'ASC')
                ->paginate(8);           
            }
            elseif($this->filterStatut!=""){
                // dd("jjamesley hpilippe0");
                return DB::table('utilisateurs_tb')
                        ->join('personnels_tb', 'utilisateurs_tb.codePersonnel', '=', 'personnels_tb.code')
                        ->when($this->filterStatut, function ($query) {
                            $query->where(function ($q) {
                                $q->where('personnels_tb.statut', '=', $this->filterStatut);
                    });
                })
                ->orderBy('utilisateurs_tb.id', 'ASC')
                ->paginate(8);           
            }
            
           
        }

    }

    public $utilisateurSelectionner;
    public function selectionUtilisateur($id){
         $this->utilisateurSelectionner=$id;
    }
    public function deleteUser($id = null)
    {
       $utilisateur = utilisateurModel::where('nomUtilisateur',$this->utilisateurSelectionner)->first();
        if (!$this->utilisateurSelectionner) {
            return;
        }

        if (!$utilisateur) {

            $this->dispatch('error-delete', [
                'message' => 'Utilisateur introuvable'
            ]);

            return;
        }

        // Pour afficher les données
        // dd($utilisateur);

        // Supprimer l'utilisateur
        $utilisateur->delete();

        broadcast(new updatedTable(''));

        // Message succès
        $this->dispatch('success-delete', [
            'message' => 'Utilisateur supprimé avec succès'
        ]);
    }


    public function sessionEdit($id){
        $this->dispatch('edit-utilisateur', id: $id);
    }

    public function render()
    {
        return view('livewire.pages.utilisateurs.tableau-utilisateurs');
    }
}
