<?php

namespace App\Helpers;
use DateTime;

class Data 
{
    public function usToBr($data)
    {
        return DateTime::createFromFormat('Y-m-d', $data)->format("d/m/Y");
    }

    public function brToUs($data)
    {
        return DateTime::createFromFormat('d/m/Y', $data)->format("Y-m-d");
    }
}