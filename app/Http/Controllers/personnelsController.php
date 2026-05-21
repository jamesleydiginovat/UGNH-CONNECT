<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class personnelsController extends Controller
{
     public function show(){
        return view('tamplate.gestion-des-personnels');
    }
}
