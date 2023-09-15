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
            INSERT INTO lib_produto (vertical_id, descricao, area_lar, area_alt, visual_lar, visual_alt)
            VALUES 
                (4, 'Bilheteria (Frente)', '1.55', '2.92', '1.55', '2.92'),
                (4, 'Bilheteria (Lateral)', '3.70', '2.92', '3.70', '2.92'),
                (4, 'Bilheteria (Traseira)', '2.92', '1.65', '2.92', '1.65'),
                (4, 'MUB Vertical', '1.19', '1.79', '1.12', '1.72'),
                (4, 'Painel Plataforma Vertical / Painel Bilheteria', '1.23', '2.34', '1.15', '2.26'),
                (4, 'Painel Plataforma Horizontal', '2.34', '1.23', '2.26', '1.15'),
                (4, 'Painel Entrada', '2.93', '1.43', '2.87', '1.37'),
                (4, 'Painel Entrada Adesivo', '2.93', '1.43', '2.93', '1.43'),
                (4, 'Catracas (Comum)', '0', '0', '0', '0'),
                (4, 'Catracas (Cadeirante)', '0', '0', '0', '0'),
                (4, 'Catracas (Estreita)', '0', '0', '0', '0'),
                (4, 'Mega Coluna', '1.36', '3.96', '1.30', '3.90'),
                (4, 'Painel Quadrado (Antigo Painel Muro)', '2.35', '2.35', '2.30', '2.30'),
                (4, 'Testeira BB', '3.95', '0.75', '3.90', '0.70'),
                (4, 'Painel Aéreo', '3.95', '1.45', '3.90', '1.40'),
                (4, 'Painel Placa', '3.80', '2.50', '3.80', '2.50'),
                (4, 'Mega Painel 1 e 2', '16.83', '2.43', '16.76', '2.36'),
                (4, 'Testeira', '4.04', '0.49', '4.04', '0.49'),
                (4, 'Painel Passarela', '4.80', '3.00', '4.80', '3.00'),
                (4, 'Painel Externo', '3.00', '1.00', '3.00', '1.00'),
                (4, 'Testeiras', '3.12', '0.84', '3.12', '0.84'),
                (4, 'Testeira Escada', '3.72', '0.67', '3.72', '0.67'),
                (4, 'Painel Subida Escada', '2.30', '2.15', '2.24', '2.09'),
                (4, 'Painel Quadrado', '2.35', '2.35', '2.30', '2.30'),
                (4, 'Painel Giga', '22.78', '4.19', '22.78', '4.19'),
                (4, 'Painel Fundão', '5.00', '2.50', '5.00', '2.50'),
                (4, 'Lycra Modelo 1', '3.50', '4.40', '3.50', '4.40'),
                (4, 'Lycra Modelo 2', '4.40', '5.00', '4.40', '5.00'),
                (4, 'Lycra Modelo 3', '2.90', '2.60', '2.90', '2.60'),
                (4, 'Lycra Modelo 4', '6.20', '4.20', '6.20', '4.20'),
                (4, 'Lycra Modelo 5', '6.90', '4.20', '6.90', '4.20'),
                (4, 'Painel Aéreo', '6.00', '1.30', '6.00', '1.30'),
                (4, 'Painel Placa Horizontal Interna', '5.00', '3.00', '5.00', '3.00'),
                (4, 'Painel Placa Horizontal Externa', '4.00', '2.00', '4.00', '2.00'),
                (3, 'Custo Backseat', '0', '0', '0', '0'),
                (4, 'Painel Plataforma com Assento Acoplado', '2.30', '1.00', '2.40', '1.10'),
                (4, 'Envelopamento Fachada Sala Vip 1', '3.10', '2.03', '3.10', '2.03'),
                (4, 'Envelopamento Fachada Sala Vip 2', '3.20', '2.03', '3.20', '2.03'),
                (4, 'Envelopamento Fachada Sala Vip 3', '1.60', '2.03', '1.60', '2.03'),
                (4, 'Envelopamento Fachada Sala Vip 4', '2.96', '2.03', '2.96', '2.03'),
                (4, 'Envelopamento Fachada Sala Vip 5', '3.15', '2.03', '3.15', '2.03'),
                (4, 'Envelopamento Fachada Sala Vip 6', '3.05', '2.03', '3.05', '2.03'),
                (4, 'Painel de Coluna', '0.60', '2.70', '0.68', '2.78'),
                (4, 'Painel Master Backlight', '2.86', '1.35', '2.93', '1.43'),
                (4, 'Painel de Coluna Backlight Embarque', '0.56', '1.10', '0.59', '1.13'),
                (4, 'Painel de Coluna Clássico', '0.72', '1.13', '0.72', '1.13'),
                (4, 'Painel Coluna Backlight', '0.70', '2.00', '0.68', '1.98'),
                (4, 'Painel Coluna Desembarque', '0.68', '1.94', '0.68', '1.94'),
                (4, 'Painel Master Backlight', '2.86', '1.35', '2.93', '1.43'),
                (4, 'Mub', '1.10', '1.70', '1.20', '1.80'),
                (4, 'Mub Backlight', '1.10', '1.70', '1.20', '1.80'),
                (4, 'Totem de Plataforma', '0.61', '1.35', '0.63', '1.37'),
                (4, 'Testeiras Backlight', '3.90', '0.90', '3.98', '0.98'),
                (1, 'DOOH (TV Ônibus)', '1366', '768', '1366', '768'),
                (5, 'Mega Aéreo (Alvorada)', '686', '342', '686', '342'),
                (5, 'Picolé (Alvorada)', '170', '342', '170', '342'),
                (5, 'Mega Aéreo (Campo Grande)', '550', '270', '550', '270'),
                (5, 'Testeiras (Campo Grande)', '410', '140', '410', '140'),
                (5, 'CDT (Paulo Portela)', '1440', '144', '1440', '144'),
                (5, 'Telão P6 (Duque de Caxias)', '572', '304', '572', '304'),
                (5, 'Painel Marquise P6 (Duque de Caxias)', '510', '204', '510', '204'),
                (5, 'Totem Digital 42\" e 49\" (Duque de Caxias)', '1366', '768', '1366', '768'),
                (5, 'Telas 40\" (Duque de Caxias)', '1366', '768', '1366', '768'),
                (5, 'Dispenser de Álcool em Gel (Duque de Caxias)', '1366', '768', '1366', '768'),
                (5, 'Telão LED P4 (Nilópolis)', '768', '510', '768', '510'),
                (5, 'TV 32\" (Nilópolis)', '1366', '768', '1366', '768'),
                (5, 'TV 40\" (Menezes Cortes)', '1366', '768', '1366', '768'),
                (5, 'Dispenser de Álcool em Gel (Menezes Cortes)', '768', '1366', '768', '1366'),
                (5, 'Carregador Digital 32\" (Menezes Cortes)', '768', '1366', '768', '1366'),
                (5, 'Telão LED P4 Full Color (Nova Iguaçu)', '288', '586', '288', '586'),
                (5, 'TV 32\" (Nova Iguaçu)', '1366', '768', '1366', '768');
        ");
    }
}
