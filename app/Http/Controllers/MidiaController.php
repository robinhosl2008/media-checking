<?php

namespace App\Http\Controllers;

use App\Services\Libs\Proc;
use Illuminate\Http\Request;

class MidiaController extends Controller
{
    private Proc $libProc;

    public function __construct()
    {
        $this->libProc = new Proc();
    }

    public function index()
    {
        $verticais = $this->libProc->buscarVerticais();

        return view('media-checking/validar', [
            'verticais' => $verticais
        ]);
    }
}
