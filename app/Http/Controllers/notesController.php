<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class notesController extends Controller
{
    public function show(){
        return view('tamplate.gestion-des-evaluations-resultat');
    }
}
