<?php

namespace App\Livewire\Pages;

use Livewire\Component;
use App\Events\TestEvent;
use App\Models\annnee_accademiqueModel;
use App\Models\auditsModel;
use App\Models\etudiantModel;
use App\Models\faculteModel;
use App\Models\horaireFaculesModel;
use App\Models\personnelsModel;
use App\Models\professeurModel;
use App\Models\utilisateurModel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardGeneral extends Component
{
    public $codeFac;
    public $status;
    public $sexe;

    protected $listeners = [
            'refreshTable'=>'$refresh',
    ];
    
    public function send()
    {
        broadcast(new TestEvent('Bonjour depuis Livewire'));
    }
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

    public function anneeAccademiqueActive(){
        return annnee_accademiqueModel::where('active', true)->first();
    }

    public function getnombreEtudiantProperty(){

        return etudiantModel::where('status', 'Etudiant')
        ->when($this->codeFac != "", function ($query) {
            $query->where('codeFac', $this->codeFac);
        })
        ->whereExists(function ($q) {
            $q->select(DB::raw(1))
            ->from('paiement_etudiants')
            ->whereColumn('paiement_etudiants.matriculeEtudiant', 'etudiants_tb.matricule')
            ->where('paiement_etudiants.anneAccademique', $this->anneeAccademiqueActive()->libelle);
        })
        ->count('id');
        
    }

    public function getnombreUtilisateurProperty(){
        if($this->status ==""){
             return utilisateurModel::count('id');
        }
        else{
             return utilisateurModel::where('statut', $this->status)->count('id');
            // dd('james');
        }
       
    }


    public function getnombreProfesseurProperty(){

        if($this->sexe ==""){
              return professeurModel::count('id');
        }
        else{
              return professeurModel::where('sexe',$this->sexe)->count('id');
            // dd('james');
        }
       
    }

    public function getnombreFaculteProperty(){
        return faculteModel::count('id');
    }


    public function getActionRecentesProperty(){
        return auditsModel::latest()->take(5)->get();
    }

    public function okok(){
        return utilisateurModel::all();
    }

    public function isOnlineOrNot($code)
    {
        $status = utilisateurModel::where('codePersonnel', $code)
            ->value('statut');
        return $status;
        // dd($status);
    }

        public function Fonction($code)
    {
        $status = personnelsModel::where('code', $code)
            ->value('fonction');
        return $status;
        // dd($status);
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

    public function getCoursDuJoursProperty()
    {
        $jours = [
            'Monday' => 'Lundi',
            'Tuesday' => 'Mardi',
            'Wednesday' => 'Mercredi',
            'Thursday' => 'Jeudi',
            'Friday' => 'Vendredi',
            'Saturday' => 'Samedi',
            'Sunday' => 'Dimanche',
        ];

        $today = $jours[now()->format('l')];

        $query = horaireFaculesModel::with(['faculte', 'prof'])
            ->where('jour', $today);

        // 🔐 filtre automatique par faculté (doyen, etc.)
        $query->when($this->getCodeFac(), function ($q) {
            $q->where('codeFac', $this->getCodeFac());
        });

        return $query->get();
    }


    public function nomProf($codeProf){
        $prof = professeurModel::where('codeProf', $codeProf)->first();
        return $prof->nom." ".$prof->prenom;
    }

    public $loginTime;

    public function mount()
    {
        $this->loginTime = session('login_time');
    }

    public function render()
    {
        return view('livewire.pages.dashboard-general');
    }
}
