<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class validationNotesController extends Controller
{
    public function show(){
        return view('tamplate.gestion-validationNotes');
    }
}
