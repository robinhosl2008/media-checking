<?php

namespace App\Helpers;

use Howtomakeaturn\PDFInfo\PDFInfo;

class PDF
{
    private string $pdfPath;
    private PDFInfo $pdfInfo;

    public function __construct(string $pdfPath) {
        $this->pdfPath = $pdfPath;
        $this->pdfInfo = new PDFInfo($this->pdfPath);
    }

    public function getTamanho()
    {
        $fileSize = $this->pdfInfo->fileSize;
        $bytes = explode(' ', $fileSize)[0];
        return number_format($bytes / (1024 * 1024), 2);
    }

    public function getDimensions()
    {
        $dimencoesArquivo = explode(' x ', $this->pdfInfo->pageSize);
        
        $arrMedidas = [
            'largura' => $this->convertPtsForMM($dimencoesArquivo[0]) / 10,
            'altura' => $this->convertPtsForMM(explode(' ', $dimencoesArquivo[1])[0]) / 10
        ];

        return $arrMedidas;
    }

    private function convertPtsForMM($medida)
    {
        $numero = $medida * 0.3528;
        return number_format($numero, 0, '.', '');
    }
}