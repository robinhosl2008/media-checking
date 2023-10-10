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
            INSERT INTO lib_vertical (
            tipo_midia_id, descricao, status, created_at
            ) VALUES (2,'DOOH Embarcado',1,NOW()),
            (3,'Navee',0,NOW()),
            (1,'Sinalização Interna',0,NOW()),
            (1,'OOH',1,NOW()),
            (2,'DOOH Terminais',1,NOW()),
            (3,'Serviços e Experiênciais',0,NOW());
        ");
    }
}
