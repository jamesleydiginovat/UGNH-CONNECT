<?php

namespace App\Http\Controllers;

use App\Models\etudiantModel;
use Illuminate\Http\Request;

class etudiantController extends Controller
{
    public function show(){
        // $etudiants = etudiantModel::with('faculte')->get();
        // dd($etudiants);
        return view('tamplate.gestion-des-etudiants');
    }
}
