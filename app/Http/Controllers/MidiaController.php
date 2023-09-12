<?php

namespace App\Http\Controllers;

use App\Services\Proc;
use Exception;
use Illuminate\Http\Request;

class MidiaController extends Controller
{
    /**
     * Classe de controle e acesso aos serviços.
     * 
     * @var Proc
     */
    private Proc $libProc;

    public function __construct()
    {
        $this->libProc = new Proc();
    }

    public function index()
    {
        try {
            $tiposMidia = $this->libProc->buscaTiposMidia()->get();
            $verticais  = []; //$this->libProc->buscaVerticais()->get();
            $produtos   = []; //$this->libProc->buscaProdutos()->get();

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
