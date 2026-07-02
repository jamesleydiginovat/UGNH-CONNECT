<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class motDePasseOublieController extends Controller
{
    public function show(){
        return view('tamplate.motDePasseOublie');
    }
}
