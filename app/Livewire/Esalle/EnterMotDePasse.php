<?php

namespace App\Livewire\Esalle;

use App\Models\etudiant_password;
use Livewire\Component;

class EnterMotDePasse extends Component
{
    public $password;

    public function connecter(){
       $exPassword = etudiant_password::where('matricule', session('user_code'))->value('password');

       if($exPassword == $this->password){
         session([
            'isGood'=>'yes'
         ]);
         return redirect()->route('home');
       }
       else{
        return redirect()->route('esalle.logout');
       }
    }
    public function render()
    {
        return view('livewire.esalle.enter-mot-de-passe');
    }
}
