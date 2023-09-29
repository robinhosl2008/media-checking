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
            INSERT INTO `lib_vertical` (descricao, tipo_midia_id)
            VALUES ('DOOH Embarcado', 2),
                ('Navee', 3),
                ('Sinalização Interna', 1),
                ('OOH', 1),
                ('DOOH Terminais', 2),
                ('Serviços e Experiênciais', 3);
        ");
    }
}
