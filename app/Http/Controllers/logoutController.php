<?php

namespace App\Http\Controllers;

use App\Events\UserLoggedIn;
use App\Events\UserLoggedOut;
use App\Models\notificationModel;
use App\Models\utilisateurModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth ;

class logoutController extends Controller
{
    public function logout(Request $request)
    {
        $codeUser = Auth::user()->personnel->code;
        Auth::user()->update([
            'statut' => 0
        ]);
        $utilisateur = Auth::user();
        Auth::logout(); // déconnecte l'utilisateur

        $action ="Déconnexion de l'utilisateur";
        $audit = audit($codeUser, $action, '-','yes');

            //NOTIFICATION 
            // ->roles->first()->nom ?? ''
            $user =  utilisateurModel::with('roles')->get();
            $message = 'S’est deconnecté au système.';

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

        broadcast(new UserLoggedOut($utilisateur));  //creer plutot un logout 

        $request->session()->invalidate(); // détruit la session
        $request->session()->regenerateToken(); // nouveau token CSRF

        return redirect('/connexion'); // redirige vers la page connexion
    }
}
