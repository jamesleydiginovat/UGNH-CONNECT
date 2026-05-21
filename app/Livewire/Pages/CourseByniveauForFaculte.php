<?php

namespace App\Livewire\Pages;

use App\Models\coursModel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class CourseByniveauForFaculte extends Component
{


    public $codeFac=null;
    protected $listeners = [
            'refreshTable'=>'$refresh',
    ];
    public $data = [];

    public function mount()
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

        $this->codeFac = $codeFac;
        $this->loadData();
    }

    public function loadData()
    {
        $this->data = coursModel::select(
                            'niveau',
                            DB::raw('COUNT(*) as total')
                        )
                        ->where('codeFac', $this->codeFac)
                        ->groupBy('niveau')
                        ->pluck('total', 'niveau');
    }
    public function render()
    {
        return view('livewire.pages.course-byniveau-for-faculte');
    }
}
