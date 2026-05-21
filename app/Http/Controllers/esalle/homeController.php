<?php

namespace App\Http\Controllers\esalle;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class homeController extends Controller
{
    public function show(){
        return view('tamplate.esalle.home-template');
    }


    public function showInformations(){
        return view('tamplate.esalle.informations-template');
    }

    public function showcoursHoraire(){
        return view('tamplate.esalle.coursHoraire-template');
    }


    public function showNotes(){
        return view('tamplate.esalle.notes-template');
    }


    public function showChat(){
        return view('tamplate.esalle.chatGroup-template');
    }

    public function enterPassword(){
        return view('tamplate.esalle.enterMotDePasse');
    }

    
    
    public function logout()
    {
        // 🔥 Supprimer les infos de session
        session()->forget(['user_type', 'user_id']);

        // 🔐 Sécurité (recommandé)
        session()->invalidate();
        session()->regenerateToken();

        return redirect('/');
    }

    public function showsitutionsFinancier(){
         return view('tamplate.esalle.situationFinancier-template');
    }
}
