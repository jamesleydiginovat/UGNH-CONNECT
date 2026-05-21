<?php

namespace App\Livewire\Pages\Connexion;

use App\Events\updatedTable;
use App\Events\UserLoggedIn;
use App\Models\notificationModel;
use App\Models\utilisateurModel;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Login extends Component
{
     public $nomUtilisateur;
    public $password;

    public function login()
    {
        $this->validate([
            'nomUtilisateur' => 'required|min:8',
            'password' => 'required'
        ]);

        if (Auth::attempt([
            'nomUtilisateur' => $this->nomUtilisateur,
            'password' => $this->password
        ])) {
            
            Auth::user()->update([
            'statut' => 1
            ]);
            session()->regenerate();
            $action ="Connexion de l'utilisateur";

            $audit = audit(Auth::user()->codePersonnel, $action, '-','yes');

            //NOTIFICATION 
            // ->roles->first()->nom ?? ''
            $user =  utilisateurModel::with('roles')->get();
            $message = 'S’est connecté au système.';

            foreach($user as $u){
                if(($u->roles->first()->nom ?? '')=="Administrateur"){

                    notificationModel::create([
                    'notification_id'=> $audit->id,
                    'user_id'=>$u->id,
                    'message'=>$message
                    ]);
                }
                
            }
            //FIN NOTIFICATION

            broadcast(new UserLoggedIn(Auth::user()));
            session(['login_time' => now()]);
            
            return redirect()->route('dashboard-general');
        }
        $this->dispatch('error', message: 'Nom utilisateur incorrect ou mot de passe incorrect');
        // session()->flash('error', 'Nom utilisateur incorrect ou mot de passe incorrect');
    }

    public function render()
    {
        return view('livewire.pages.connexion.login');
    }
}
