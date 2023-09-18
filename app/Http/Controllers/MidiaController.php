<?php

namespace App\Http\Controllers;

use App\Helpers\FFMpegHelper;
use App\Services\Proc;
use Exception;
use Illuminate\Http\Request;
use Illuminate\View\View;

class MidiaController extends Controller
{
    /**
     * Classe de controle e acesso aos serviços.
     */
    private Proc $libProc;
    private FFMpegHelper $ffmpeg;

    public function __construct()
    {
        $this->libProc = new Proc();
        $this->ffmpeg = new FFMpegHelper();
    }

    public function validar()
    {
        try {
            $tiposMidia = $this->libProc->buscaTiposMidia()->get();
            $verticais  = []; //$this->libProc->buscaVerticais()->get();
            $produtos   = []; //$this->libProc->buscaProdutos()->get();

            // session([
            //     'msg-alert' => 'A instalação foi removida do sistema.', 
            //     'tipo-msg-alert' => 'success'
            // ]);

            return view('midia-checking/validar', [
                'tiposMidia'    => $tiposMidia,
                'verticais'     => $verticais,
                'produtos'      => $produtos
            ]);
        } catch(Exception $e) {
            return $e->getMessage();
        }
    }

    public function converter(Request $request): View
    {
        return view('midia-checking/converter');
    }

    public function buscarResolucao(Request $request)
	{
        return $this->ffmpeg->buscarResolucao($request->file);
	}
}
