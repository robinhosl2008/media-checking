<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class LibVerticalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::select("
            INSERT INTO `lib_vertical` (descricao)
            VALUES ('DOOH Embarcado'),
            ('Navee'),
            ('Sinalização Interna'),
            ('OOH'),
            ('DOOH Terminais'),
            ('Serviços e Experiênciais');
        ");
    }
}
