<?php

namespace App\Services\Libs;

use App\Services\Libs\LibVertical;

class Proc
{
    private LibVertical $libVertical;

    public function __construct()
    {
        $this->libVertical = new LibVertical();
    }

    public function buscarVerticais($params = [])
    {
        return $this->libVertical->buscar($params);
    }
}