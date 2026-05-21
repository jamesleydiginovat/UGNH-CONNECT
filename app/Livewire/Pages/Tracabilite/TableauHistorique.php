<?php

namespace App\Livewire\Pages\Tracabilite;

use App\Models\auditsModel;
use Livewire\Component;
use Livewire\WithPagination;

class TableauHistorique extends Component
{
    protected $listeners = [
    'success' => '$refresh',
    'refreshTable'=>'$refresh',
    ];

    use WithPagination;
    
    public $dateHistorique;
    public $search;
    public $typeAction;
    public $codeUtilisateur;
    public function getHistoriqueProperty()
    {
        $query = auditsModel::query();

        // 🔍 Recherche globale
        $query->when($this->search != "", function ($q) {

            $q->where(function ($subQuery) {

                $subQuery->where('code', 'ILIKE', '%' . $this->search . '%')
                        ->orWhere('action', 'ILIKE', '%' . $this->search . '%')
                        ->orWhere('record_code', 'ILIKE', '%' . $this->search . '%');

            });

        });

        // 🎯 Filtre type d'action
        $query->when($this->typeAction != "", function ($q) {

            $q->where('action', 'ILIKE', '%' . $this->typeAction . '%');

        });

        // 🎯 Filtre date
        $query->when($this->dateHistorique != "", function ($q) {

            $q->whereDate('created_at', $this->dateHistorique);

        });

        // 🎯 Filtre utilisateur
        $query->when($this->codeUtilisateur != "", function ($q) {

            $q->where('code', 'ILIKE', '%' . $this->codeUtilisateur . '%');

        });

        return $query
                ->latest()
                ->paginate(20);
    }

    public function resetFiltre()
    {
        $this->reset([
            'search',
            'typeAction',
            'dateHistorique',
            'codeUtilisateur',
        ]);
    }
    public function render()
    {
        return view('livewire.pages.tracabilite.tableau-historique');
    }
}
