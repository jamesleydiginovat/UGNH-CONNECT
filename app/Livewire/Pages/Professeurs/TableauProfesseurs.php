<?php

namespace App\Livewire\Pages\Professeurs;

use App\Models\professeurModel;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class TableauProfesseurs extends Component
{
    use WithPagination;
    protected $listeners = [
    'success'=>'$refresh',
    'refreshTable'=>'$refresh',
    ];

    public $search;
    public $filterSexe;
    public $filterStatus;

    public function getLesProfesseursProperty(){
        if($this->search!=""){
            return professeurModel::where('status',"Actif")->when($this->search, function ($query) {
            $query->where('nom', 'ILIKE', "%{$this->search}%")
                    ->orWhere('prenom', 'ILIKE', "%{$this->search}%")
                    ->orWhere('codeProf', 'ILIKE', "%{$this->search}%");
            })
            ->orderBy('id', 'ASC')
            ->paginate(8);
            
        }
        else{
            if($this->filterSexe=="" && $this->filterStatus ==""){
                return professeurModel::where('status',"Actif")->orderBy('id','DESC')->paginate(8);
            }
            elseif($this->filterSexe=="" && $this->filterStatus !=""){
                return professeurModel::where('status',$this->filterStatus)
                                        ->orderBy('id', 'ASC')
                                        ->paginate(8);
            }
            else{
                return professeurModel::where('status',"Actif")->when($this->filterSexe, function ($query) {
                $query->where('sexe', 'ILIKE', "%{$this->filterSexe}%");
                })
                ->orderBy('id', 'ASC')
                ->paginate(8);
            }
           
        }
    }


    public function changerStatus($status, $id){

            return 
            professeurModel::where('id',$id)->update([
            'status'=>$status
            ])
            and
            $this->dispatch('success',message:"Action reusit" );
            $action ="Changement de status en ".$this->status." d'un professeur";
            audit(Auth::user()->personnel->code, $action, $this->codeProf);
    }

    public function remplirFromModifier($id){
        $this->dispatch('edit-professeur', id: $id);
    }

    public function render()
    {
        return view('livewire.pages.professeurs.tableau-professeurs');
    }
}
