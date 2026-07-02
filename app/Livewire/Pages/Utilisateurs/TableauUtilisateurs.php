<?php

namespace App\Livewire\Pages\Utilisateurs;

use App\Events\updatedTable;
use App\Models\faculteModel;
use App\Models\personnelsModel;
use App\Models\roleUtilisateur;
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


        public function getUtilisateursProperty()
        {
            $query = DB::table('utilisateurs_tb')
                        ->join(
                            'personnels_tb',
                            'utilisateurs_tb.codePersonnel',
                            '=',
                            'personnels_tb.code'
                        );

            // Recherche
            if (!empty($this->search)) {
                $query->where(function ($q) {
                    $q->where('personnels_tb.nom', 'ILIKE', "%{$this->search}%")
                    ->orWhere('personnels_tb.prenom', 'ILIKE', "%{$this->search}%")
                    ->orWhere('utilisateurs_tb.nomUtilisateur', 'ILIKE', "%{$this->search}%")
                    ->orWhere('personnels_tb.code', 'ILIKE', "%{$this->search}%");
                });
            }

            // Filtre par sexe
            if (!empty($this->filterFonction)) {
                $query->where('personnels_tb.fonction', 'ILIKE', "%{$this->filterFonction}%");
            }


            // Filtre par role
            if (!empty($this->filterSexe)) {
                $query->where('personnels_tb.sexe', 'ILIKE', "%{$this->filterSexe}%");
            }

            // Filtre par statut
            if (!empty($this->filterStatut)) {
                if($this->filterStatut =="Horsligne"){
                    $query->where('utilisateurs_tb.statut', 0);
                }
                else{
                    $query->where('utilisateurs_tb.statut', $this->filterStatut);
                }

                
            }

            return $query
                    ->orderBy('utilisateurs_tb.id', 'ASC')
                    ->paginate(8);
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

    public function nomFacRole($nomUtilisateur){
        $codeFac = roleUtilisateur::where('nomUtilisateur', $nomUtilisateur)->value('codeFac');

        if($codeFac){
            return faculteModel::where('codeFac', $codeFac)->value('nom');
        }
        else{
            return "";
        }
    }

    public function render()
    {
        return view('livewire.pages.utilisateurs.tableau-utilisateurs');
    }
}
