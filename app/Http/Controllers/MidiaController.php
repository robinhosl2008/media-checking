<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MidiaController extends Controller
{
    public function index()
    {
        return view('media-checking/validar');
    }
}
