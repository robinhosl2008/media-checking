<?php

namespace App\Http\Controllers;

use App\Services\Libs\Proc;
use Exception;
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
        try {
            $tiposMidia = $this->libProc->buscaTiposMidia();
            $verticais  = $this->libProc->buscaVerticais();
            $produtos   = $this->libProc->buscaProdutos();

            // session([
            //     'msg-alert' => 'A instalação foi removida do sistema.', 
            //     'tipo-msg-alert' => 'success'
            // ]);

            return view('media-checking/validar', [
                'tiposMidia'    => $tiposMidia,
                'verticais'     => $verticais,
                'produtos'      => $produtos
            ]);
        } catch(Exception $e) {
            return $e->getMessage();
        }
    }
}
