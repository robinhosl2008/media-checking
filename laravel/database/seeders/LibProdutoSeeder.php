<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class LibProdutoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::select("
            INSERT INTO lib_produto (
            vertical_id, tipo_midia_id, descricao, area_lar, area_alt,
            visual_lar, visual_alt, palco_lar, palco_alt, status_palco, status
            ) VALUES (4,1,'Bilheteria (Frente)',1.55,2.92,1.55,2.92,0.00,0.00,0,1),
            (4,1,'Bilheteria (Lateral)',3.70,2.92,3.70,2.92,0.00,0.00,0,1),
            (4,1,'Bilheteria (Traseira)',2.92,1.65,2.92,1.65,0.00,0.00,0,1),
            (4,1,'MUB Vertical',1.19,1.79,1.12,1.72,0.00,0.00,0,1),
            (4,1,'Painel Plataforma Vertical / Painel Bilheteria',1.23,2.34,1.15,2.26,0.00,0.00,0,1),
            (4,1,'Painel Plataforma Horizontal',2.34,1.23,2.26,1.15,0.00,0.00,0,1),
            (4,1,'Painel Entrada',2.93,1.43,2.87,1.37,0.00,0.00,0,1),
            (4,1,'Painel Entrada Adesivo',2.93,1.43,2.93,1.43,0.00,0.00,0,1),
            (4,1,'Catracas (Comum)',0.00,0.00,0.00,0.00,0.00,0.00,0,0),
            (4,1,'Catracas (Cadeirante)',0.00,0.00,0.00,0.00,0.00,0.00,0,0),
            (4,1,'Catracas (Estreita)',0.00,0.00,0.00,0.00,0.00,0.00,0,0),
            (4,1,'Mega Coluna',1.36,3.96,1.30,3.90,0.00,0.00,0,1),
            (4,1,'Painel Quadrado (Antigo Painel Muro)',2.35,2.35,2.30,2.30,0.00,0.00,0,1),
            (4,1,'Testeira BB',3.95,0.75,3.90,0.70,0.00,0.00,0,1),
            (4,1,'Painel Aéreo',3.95,1.45,3.90,1.40,0.00,0.00,0,1),
            (4,1,'Painel Placa',3.80,2.50,3.80,2.50,0.00,0.00,0,1),
            (4,1,'Mega Painel 1 e 2',16.83,2.43,16.76,2.36,0.00,0.00,0,1),
            (4,1,'Testeira',4.04,0.49,4.04,0.49,0.00,0.00,0,1),
            (4,1,'Painel Passarela',4.80,3.00,4.80,3.00,0.00,0.00,0,1),
            (4,1,'Painel Externo',3.00,1.00,3.00,1.00,0.00,0.00,0,1),
            (4,1,'Testeiras',3.12,0.84,3.12,0.84,0.00,0.00,0,1),
            (4,1,'Testeira Escada',3.72,0.67,3.72,0.67,0.00,0.00,0,1),
            (4,1,'Painel Subida Escada',2.30,2.15,2.24,2.09,0.00,0.00,0,1),
            (4,1,'Painel Quadrado',2.35,2.35,2.30,2.30,0.00,0.00,0,1),
            (4,1,'Painel Giga',22.78,4.19,22.78,4.19,0.00,0.00,0,1),
            (4,1,'Painel Fundão',5.00,2.50,5.00,2.50,0.00,0.00,0,1),
            (4,1,'Lycra Modelo 1',3.50,4.40,3.50,4.40,0.00,0.00,0,1),
            (4,1,'Lycra Modelo 2',4.40,5.00,4.40,5.00,0.00,0.00,0,1),
            (4,1,'Lycra Modelo 3',2.90,2.60,2.90,2.60,0.00,0.00,0,1),
            (4,1,'Lycra Modelo 4',6.20,4.20,6.20,4.20,0.00,0.00,0,1),
            (4,1,'Lycra Modelo 5',6.90,4.20,6.90,4.20,0.00,0.00,0,1),
            (4,1,'Painel Aéreo',6.00,1.30,6.00,1.30,0.00,0.00,0,1),
            (4,1,'Painel Placa Horizontal Interna',5.00,3.00,5.00,3.00,0.00,0.00,0,1),
            (4,1,'Painel Placa Horizontal Externa',4.00,2.00,4.00,2.00,0.00,0.00,0,1),
            (3,1,'Custo Backseat',0.00,0.00,0.00,0.00,0.00,0.00,0,0),
            (4,1,'Painel Plataforma com Assento Acoplado',2.30,1.00,2.40,1.10,0.00,0.00,0,1),
            (4,1,'Envelopamento Fachada Sala Vip 1',3.10,2.03,3.10,2.03,0.00,0.00,0,1),
            (4,1,'Envelopamento Fachada Sala Vip 2',3.20,2.03,3.20,2.03,0.00,0.00,0,1),
            (4,1,'Envelopamento Fachada Sala Vip 3',1.60,2.03,1.60,2.03,0.00,0.00,0,1),
            (4,1,'Envelopamento Fachada Sala Vip 4',2.96,2.03,2.96,2.03,0.00,0.00,0,1),
            (4,1,'Envelopamento Fachada Sala Vip 5',3.15,2.03,3.15,2.03,0.00,0.00,0,1),
            (4,1,'Envelopamento Fachada Sala Vip 6',3.05,2.03,3.05,2.03,0.00,0.00,0,1),
            (4,1,'Painel de Coluna',0.60,2.70,0.68,2.78,0.00,0.00,0,1),
            (4,1,'Painel Master Backlight',2.86,1.35,2.93,1.43,0.00,0.00,0,1),
            (4,1,'Painel de Coluna Backlight Embarque',0.56,1.10,0.59,1.13,0.00,0.00,0,1),
            (4,1,'Painel de Coluna Clássico',0.72,1.13,0.72,1.13,0.00,0.00,0,1),
            (4,1,'Painel Coluna Backlight',0.70,2.00,0.68,1.98,0.00,0.00,0,1),
            (4,1,'Painel Coluna Desembarque',0.68,1.94,0.68,1.94,0.00,0.00,0,1),
            (4,1,'Painel Master Backlight',2.86,1.35,2.93,1.43,0.00,0.00,0,1),
            (4,1,'Mub',1.10,1.70,1.20,1.80,0.00,0.00,0,1),
            (4,1,'Mub Backlight',1.10,1.70,1.20,1.80,0.00,0.00,0,1),
            (4,1,'Totem de Plataforma',0.61,1.35,0.63,1.37,0.00,0.00,0,1),
            (4,1,'Testeiras Backlight',3.90,0.90,3.98,0.98,0.00,0.00,0,1),
            (1,2,'DOOH (TV Ônibus)',1366.00,768.00,1366.00,768.00,1366,768,0,1),
            (5,2,'Mega Aéreo (Alvorada)',686.00,342.00,686.00,342.00,1366,768,0,1),
            (5,2,'Picolé (Alvorada)',170.00,342.00,170.00,342.00,1366,768,0,1),
            (5,2,'Mega Aéreo (Campo Grande)',550.00,270.00,550.00,270.00,1366,768,0,1),
            (5,2,'Testeiras (Campo Grande)',410.00,140.00,410.00,140.00,1366,768,0,1),
            (5,2,'CDT (Paulo Portela)',1440.00,144.00,1440.00,144.00,1920,1080,0,1),
            (5,2,'Telão P6 (Duque de Caxias)',572.00,304.00,572.00,304.00,1366,768,1,1),
            (5,2,'Painel Marquise P6 (Duque de Caxias)',510.00,204.00,510.00,204.00,1366,768,1,1),
            (5,2,'Totem Digital 42\" e 49\" (Duque de Caxias)',1366.00,768.00,1366.00,768.00,1366,768,0,1),
            (5,2,'Telas 40\" (Duque de Caxias)',1366.00,768.00,1366.00,768.00,1366,768,0,1),
            (5,2,'Dispenser de Álcool em Gel (Duque de Caxias)',1366.00,768.00,1366.00,768.00,1366,768,0,1),
            (5,2,'Telão LED P4 (Nilópolis)',768.00,510.00,768.00,510.00,1366,768,1,1),
            (5,2,'TV 32\" (Nilópolis)',1366.00,768.00,1366.00,768.00,1366,768,0,1),
            (5,2,'TV 40\" (Menezes Cortes)',1366.00,768.00,1366.00,768.00,1366,768,0,1),
            (5,2,'Dispenser de Álcool em Gel (Menezes Cortes)',768.00,1366.00,768.00,1366.00,1366,768,0,1),
            (5,2,'Carregador Digital 32\" (Menezes Cortes)',768.00,1366.00,768.00,1366.00,1366,768,0,1),
            (5,2,'Telão LED P4 Full Color (Nova Iguaçu)',288.00,586.00,288.00,586.00,1366,768,1,1),
            (5,2,'TV 32\" (Nova Iguaçu)',1366.00,768.00,1366.00,768.00,1366,768,0,1),
            (4,1,'Painel Saída da Passarela',2.10,0.85,2.10,0.85,0.00,0.00,0,1);
        ");
    }
}
