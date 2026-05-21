<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class pdfController extends Controller
{
    public function listepdf(){
        return view('tamplate.liste-personnel');
    }
}
