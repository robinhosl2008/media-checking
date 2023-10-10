<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class LibTipoMidiaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::select("
            INSERT INTO lib_tipo_midia (descricao, created_at)
            VALUES ('Imagem',NOW()),
            ('Vídeo',NOW()),
            ('N/A',NOW());
        ");
    }
}
