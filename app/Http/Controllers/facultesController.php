<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class facultesController extends Controller
{
    public function show(){
        return view('tamplate.gestion-des-facultes');
    }
}
