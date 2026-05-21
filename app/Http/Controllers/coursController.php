<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class coursController extends Controller
{
    public function show(){
        return view('tamplate.gestion-des-cours');
    }
}
