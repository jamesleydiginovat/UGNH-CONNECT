<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfileUtilisateurController extends Controller
{
    public function show(){
        return view('tamplate.gestion-myProfile');
    }
}
