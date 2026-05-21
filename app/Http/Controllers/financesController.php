<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class financesController extends Controller
{
    public function show(){
        return view('tamplate.gestion-des-finances');
    }
}
