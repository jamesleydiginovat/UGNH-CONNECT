<?php

namespace App\Livewire\Pages\Profile;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Profile extends Component
{
    public $nom, $prenom, $sexe, $telephone, $adresse, $email, $fonction, $conditionMatrimoniale, $motDePasse;

    public function mount()
    {
        $user = Auth::user()->personnel;

        $this->nom = $user->nom;
        $this->prenom = $user->prenom;
        $this->sexe = $user->sexe;
        $this->telephone = $user->telephone;
        $this->adresse = $user->adresse;
        $this->email = $user->email;
        $this->fonction = $user->fonction;
        $this->conditionMatrimoniale = $user->conditionMatrimoniale;
        $this->motDePasse =  $user->motDePasse;
    }



    public function saveProfile()
    {
        $personnel = Auth::user()->personnel;

        $personnel->update([
            'nom' => $this->nom,
            'prenom' => $this->prenom,
            'sexe' => $this->sexe,
            'telephone' => $this->telephone,
            'adresse' => $this->adresse,
            'email' => $this->email,
            'fonction' => $this->fonction,
            'conditionMatrimoniale' => $this->conditionMatrimoniale,
        ]);

        $this->dispatch('success', message: 'Profil mis à jour avec succès');
    }
    public function render()
    {
        return view('livewire.pages.profile.profile');
    }
}
