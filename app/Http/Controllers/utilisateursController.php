<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class utilisateursController extends Controller
{
    public function show(){
        return view('tamplate.gestion-des-utilisateurs-et-roles');
    }
}
