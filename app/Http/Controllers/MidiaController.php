<?php

namespace App\Http\Controllers;

use App\Helpers\{
    FFMpegHelper,
    PDF
};
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Services\Proc;
use Exception;

class MidiaController extends Controller
{
    /**
     * Classe de controle e acesso aos serviços.
     */
    private Proc $libProc;
    private FFMpegHelper $ffmpeg;
    private PDF $pdf;

    public function __construct()
    {
        $this->libProc = new Proc();
        $this->ffmpeg = new FFMpegHelper();
    }

    public function validar()
    {
        try {
            $tiposMidia = []; //$this->libProc->buscaTiposMidia()->get();
            $verticais  = $this->libProc->buscaVerticais()->get();
            $produtos   = []; //$this->libProc->buscaProdutos()->get();

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
        $arr = [];
        $file = $request->file;
        $pathName = $file->path();

        $bytes = filesize($file);
        $mBytes = number_format($bytes / (1024 * 1024), 2);

        $arr = $this->ffmpeg->buscarResolucao($request->file);

        $arr['link'] = $this->downloadFile($pathName, "storage/video/arquivo.mp4");
        $arr['size'] = $mBytes;

        return $arr;
	}

    public function buscarInfoArquivoPDF(Request $request)
    {
        $arr = [];

        Log::info('Pegando informações sobre o arquivo PDF.');
        $file = $request->file;
        $pathName = $file->path();

        Log::info('Fazendo o download do arquivo e recuperando seu novo pathname.');
        $arrFileDownloaded = $this->downloadFile($pathName, "storage/pdf/arquivo.pdf");

        if ($arrFileDownloaded['status'] === true) {
            $pdf = new PDF(public_path('storage/pdf/arquivo.pdf'));

            Log::info('***Pegando propriedades do arquivo.***');

            Log::info('Dimensões...');
            $arr['propriedades'] = $pdf->getDimensions();
            Log::info('largura: ' . $arr['propriedades']['largura'] . ' - Altura: ' . $arr['propriedades']['altura']);

            $arr['propriedades']['tamanho'] = $pdf->getTamanho();
            Log::info('Tamanho em MB: ' . $arr['propriedades']['tamanho']);

            Log::info('Removendo arquivo.' . PHP_EOL);
            $this->removePDF($arrFileDownloaded['link']);
        }

        return $arr;
    }

    public function removePDF($pathName)
    {
        // Verifique se o arquivo existe antes de tentar excluí-lo
        if (File::exists($pathName)) {
            // Exclua o arquivo
            File::delete($pathName);
        }
    }

    public function downloadFile($pathName, $targetDir)
    {
        $resposta = [];

        // Move o arquivo para o diretório de destino
        if (move_uploaded_file($pathName, $targetDir)) {
            $resposta['msg'] = "O arquivo foi enviado com sucesso.";
            $resposta['status'] = true;
            chmod($targetDir, 0777);
        } else {
            $resposta['msg'] = "Desculpe, ocorreu um erro durante o upload do arquivo.";
            $resposta['status'] = false;
        }

        $resposta['link'] = $_SERVER['HTTP_ORIGIN'] . '/' . $targetDir;

        return $resposta;
    }
}
