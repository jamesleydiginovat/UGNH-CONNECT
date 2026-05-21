<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class professeursController extends Controller
{
    public function show(){
        return view('tamplate.gestion-des-professeurs');
    }
}
