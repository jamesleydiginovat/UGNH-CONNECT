<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class anneesAccademiques extends Controller
{
    public function show(){
        return view('tamplate.gestion-des-annnees-accademiques');
    }
}
