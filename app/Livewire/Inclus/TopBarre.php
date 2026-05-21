<?php

namespace App\Livewire\Inclus;

use App\Models\utilisateurModel;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class TopBarre extends Component
{
    public function toggleModeClairOrSombre(){
        $mode =Auth::user()->theme;
        if($mode =='false'){
            $mode ='true';
        }
        else{
            $mode ='false';
        }
        utilisateurModel::where('codePersonnel', Auth::user()->codePersonnel)->update([
            'theme'=>$mode
        ]);

        // refresh page
        return redirect(request()->header('Referer'));
    }
    public function render()
    {
        return view('livewire.inclus.top-barre');
    }
}
