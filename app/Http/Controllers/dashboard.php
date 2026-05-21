<?php

namespace App\Http\Controllers;

// use Illuminate\Container\Attributes\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class dashboard extends Controller
{
    public function show(){
        // dd(Auth::user());
        return view('tamplate.dashboard-general');
    }
}
