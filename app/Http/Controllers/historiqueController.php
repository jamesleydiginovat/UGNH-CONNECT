<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class historiqueController extends Controller
{
     public function show(){
        
        return view('tamplate.gestion-des-historique');
    }
}
