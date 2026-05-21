<?php

namespace App\Livewire\Pages\Cours;

use App\Models\coursModel;
use App\Models\faculteModel;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class CountCours extends Component
{
    public $byFaculte;
    protected $listeners = [
         'refreshTable'=>'$refresh',
         'success'=>'$refresh',
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

    public function getCountCoursProperty()
    {
        return coursModel::where('status', 'Actif')
            // 🎯 filtre manuel
            ->when($this->byFaculte != "", function ($q) {
                $q->where('codeFac', $this->byFaculte);
            })
            // 🔐 filtre automatique (doyen, vice, etc.)
            ->when($this->getCodeFac(), function ($q) {
                $q->where('codeFac', $this->getCodeFac());
            })
            ->count();
    }
    public function render()
    {
        return view('livewire.pages.cours.count-cours');
    }
}
