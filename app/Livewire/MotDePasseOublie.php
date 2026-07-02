<?php

namespace App\Livewire;

use App\Models\personnelsModel;
use App\Models\utilisateurModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Illuminate\Support\Facades\Mail;

class MotDePasseOublie extends Component
{
    public $step = 1;

    public $code_personnel;
    public $email;
    public $otp;
    public $password;
    public $password_confirmation;

    public $generatedOtp;

    public $user;

    // STEP 1
    public function checkCode()
    {
        $this->user = utilisateurModel::where('codePersonnel', $this->code_personnel)->first();

        if (!$this->user) {
            $this->addError('code_personnel', 'Code incorrect');
            return;
        }

        $this->step = 2;
    }

    // STEP 2
    public function checkEmail()
    {
        $emailUser = personnelsModel::where('code', $this->code_personnel)->first();
        if ($emailUser->email !== $this->email) {
            $this->addError('email', 'Email incorrect');
            return;
        }

        $this->generatedOtp = rand(100000, 999999);

        session(['otp' => $this->generatedOtp]);

        Mail::raw("Votre code OTP est : " . $this->generatedOtp, function ($m) {
            $m->to($this->email)
              ->subject('Code de vérification');
        });

        $this->step = 3;
    }

    // STEP 3
    public function verifyOtp()
    {
        if ($this->otp != session('otp')) {
            $this->addError('otp', 'Code invalide');
            return;
        }

        $this->step = 4;
    }

    // STEP 4
    public function resetPassword()
    {
        $this->validate([
            'password' => 'required|min:6|confirmed',
        ]);

        $this->user->motDePasse = Hash::make($this->password);
        $this->user->save();

        session()->forget('otp');

        session()->flash('success', 'Mot de passe modifié avec succès');

        return redirect('/connexion');
    }


    public function render()
    {
        return view('livewire.mot-de-passe-oublie');
    }
}
