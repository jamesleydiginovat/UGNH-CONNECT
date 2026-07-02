<?php

namespace App\Livewire\Pages\Profile;

use App\Models\utilisateurModel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class Profile extends Component
{
    public $nom, $prenom, $sexe, $telephone, $adresse, $email, $fonction, $conditionMatrimoniale, $motDePasse, $nomUtilisateur;

    public $old_password;
    public $new_password;
    public $new_password_confirmation;

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
        $this->nomUtilisateur= Auth::user()->nomUtilisateur;
        
        if(Auth::user()->motDePasse !=null){
             $this->motDePasse =  "*********";
        }
        else{
             $this->motDePasse = "Aucun Mode de passe"; 
        }
    }



    public function saveProfile()
    {
        $personnel = Auth::user()->personnel;

        $personnel->update([
            // 'nom' => $this->nom,
            // 'prenom' => $this->prenom,
            // 'sexe' => $this->sexe,
            'telephone' => $this->telephone,
            'adresse' => $this->adresse,
            'email' => $this->email,
            // 'fonction' => $this->fonction,
            'conditionMatrimoniale' => $this->conditionMatrimoniale,
        ]);

        if($this->nomUtilisateur != Auth::user()->nomUtilisateur){
            $isExiste = utilisateurModel::where('nomUtilisateur', $this->nomUtilisateur)->exists();
            if($isExiste){

                session()->flash('success', 'Ce nom utilisateur est deja pris');
                return;
            }
            Auth::user()->update([
                'nomUtilisateur'=>$this->nomUtilisateur
            ]);
        }
        // dd('je suis jamesley philippe');
        // $this->dispatch('success', message: 'Profil mis à jour avec succès');

         session()->flash('success', 'Profil mis à jour avec succès');
    }
    
    public function clearFlash()
    {
        session()->forget('success');
    }

    public function updatePassword()
    {
        $this->validate([
            'old_password' => 'required',
            'new_password' => 'required|min:8|confirmed',
        ]);

        $user = Auth::user();

        if (!Hash::check($this->old_password, $user->motDePasse)) {
            $this->addError('old_password', 'Ancien mot de passe incorrect.');
            return;
        }

        $user->update([
            'motDePasse' => Hash::make($this->new_password)
        ]);

        $this->reset(['old_password','new_password','new_password_confirmation']);

        session()->flash('success', 'Mot de passe modifié avec succès.');
    }

    public function render()
    {
        return view('livewire.pages.profile.profile');
    }
}
