<?php

namespace App\Livewire;

use App\Models\annnee_accademiqueModel;
use App\Models\devoirModel;
use App\Models\etudiant_password;
use App\Models\etudiantModel;
use App\Models\personnelsModel;
use App\Models\professeurModel;
use Livewire\Component;

class Welcome extends Component
{
    public $code=null;
    public $userType=null;
    public $kod;

    protected $listeners = [
        'refreshTable'=>'$refresh',
    ];

    public function anneeAccademiqueActive(){
        return annnee_accademiqueModel::where('active', true)->first();
    }


    public function isSecure(){
        return etudiant_password::where('matricule', session('user_code'))
                                  ->exists();
    }

    public function verify()
    {
        $this->validate([
            'kod' => 'required'
        ]);

        $code = $this->kod;

        $this->userType = null;

        // 🔍 ETUDIANT
        $etudiant = etudiantModel::with('faculte')
            ->where('matricule', $code)
            ->first();

        if ($etudiant) {
            $this->userType = 'etudiant';

            session([
                'user_type' => 'etudiant',
                'user_code' => $etudiant->matricule,
                'user_codeFac' => $etudiant->faculte->first()?->codeFac ?? '',
                'user_nomFac' => $etudiant->faculte->first()?->nom ?? '',
                'user_niveau' => $etudiant->niveau,
                'photo' => $etudiant->photo,
            ]);

            $secure =  $this->isSecure();
            if($secure){
                session([
                    'secure'=> 'yes'
                ]);
                return redirect()->route('enterPassword');
            }
            else{
                 return redirect()->route('home'); // 🔥 REDIRECT
            }
           
        }

        // 🔍 PROFESSEUR
        $prof = professeurModel::where('codeProf', $code)->first();

        if ($prof) {
            $this->userType = 'professeur';

            session([
                'user_type' => 'professeur',
                'user_code' => $prof->codeProf,
            ]);

            $secure =  $this->isSecure();
            if($secure){
                return redirect()->route('enterPassword');
            }
            else{
                 return redirect()->route('home'); // 🔥 REDIRECT
            }
        }

        // 🔍 PERSONNEL
        $personnel = personnelsModel::where('code', $code)->first();

        if ($personnel) {
            $this->userType = 'personnel';

            session([
                'user_type' => 'personnel',
                'user_code' => $personnel->code,
            ]);

            return redirect()->route('connexion'); // 🔥 REDIRECT
        }

        // ❌ aucun trouvé
        $this->addError('kod', 'Code invalide ou inexistant');
    }





    public function render()
    {
        return view('livewire.welcome');
    }
}
