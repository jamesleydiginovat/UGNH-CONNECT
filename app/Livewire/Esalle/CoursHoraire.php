<?php

namespace App\Livewire\Esalle;

use App\Models\coursModel;
use App\Models\horaireFaculesModel;
use App\Models\professeurModel;
use Livewire\Component;

class CoursHoraire extends Component
{
    public $bySession ='1';
    public function getHorairesProperty()
    {
        $query = horaireFaculesModel::with(['faculte', 'prof']);

        $query->when(session('user_codeFac') != "", function ($q) {
            $q->where('codeFac', session('user_codeFac'));
        });

        $query->when(session('user_niveau') != "", function ($q) {
            $q->where('niveau', session('user_niveau'));
        });

        $query->when($this->bySession != "", function ($q) {
            $q->where('session', $this->bySession);
        });

        // 🎯 groupement par horaire (clé du tableau)
        return $query->get()->groupBy(function ($item) {
            return $item->heure_debut . ' - ' . $item->heure_fin;
        });
    }


    public function coursBySession()
    {
        return coursModel::where('codeFac', session('user_codeFac'))
            ->where('niveau', session('user_niveau'))
            ->get()
            ->groupBy('session');
    }

    
    public function nomProf($codeProf){
    $prof = professeurModel::where('codeProf', $codeProf)->first();
        return $prof->nom." ".$prof->prenom;
    }
        public function render()
        {
            return view('livewire.esalle.cours-horaire');
        }
    }
