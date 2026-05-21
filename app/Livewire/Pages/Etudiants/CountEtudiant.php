<?php

namespace App\Livewire\Pages\Etudiants;

use App\Models\etudiantModel;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class CountEtudiant extends Component
{
    protected $listeners = [
        'success' => '$refresh',
        'refreshTable'=>'$refresh',
    ];
    
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

    public function getTotalEtudiantsProperty()
    {
        return etudiantModel::where('status', 'Etudiant')
            ->when($this->getCodeFac(), function ($q) {
                $q->whereHas('faculte', function ($sub) {
                    $sub->where('codeFac', 'ILIKE', "%{$this->getCodeFac()}%");
                });
            })
            ->count();
    }

    public function getTotalPostulantsProperty()
    {
        return etudiantModel::where('status', 'Postulant')
            ->when($this->getCodeFac(), function ($q) {
                $q->whereHas('faculte', function ($sub) {
                    $sub->where('codeFac', 'ILIKE', "%{$this->getCodeFac()}%");
                });
            })
            ->count();
    }

    public function getTotalEtudiantsFilleProperty()
    {
        return etudiantModel::where('status', 'Etudiant')
            ->where('sexe', 'F')
            ->when($this->getCodeFac(), function ($q) {
                $q->whereHas('faculte', function ($sub) {
                    $sub->where('codeFac', 'ILIKE', "%{$this->getCodeFac()}%");
                });
            })
            ->count();
    }

    public function getTotalEtudiantsGarconsProperty()
    {
        return etudiantModel::where('status', 'Etudiant')
            ->where('sexe', 'M')
            ->when($this->getCodeFac(), function ($q) {
                $q->whereHas('faculte', function ($sub) {
                    $sub->where('codeFac', 'ILIKE', "%{$this->getCodeFac()}%");
                });
            })
            ->count();
    }


    public function render()
    {
        return view('livewire.pages.etudiants.count-etudiant');
    }
}
