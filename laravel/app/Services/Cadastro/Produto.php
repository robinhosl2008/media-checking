<?php

namespace App\Services\Cadastro;

use App\Models\LibProduto;
use App\Services\CRUD;
use Exception;
use Illuminate\Support\Facades\DB;

class Produto extends CRUD
{

    public function __construct()
    {
        parent::__construct(new LibProduto());
    }

    /**
     * @param array $params Array contendo os parâmetros para a realização de buscas específicas.
     */
    public function buscar($params = [])
    {
        $id          = ($params['id']) ? $params['id'] : '';
        $vertical_id = ($params['vertical_id']) ? $params['vertical_id'] : '';
        $descricao   = ($params['descricao']) ? $params['descricao'] : '';
        $dt_inicio   = (array_key_exists('dt_inicio', $params) && $params['dt_inicio']) ? $params['dt_inicio'] : '';
        $dt_fim      = (array_key_exists('dt_fim', $params) && $params['dt_fim']) ? $params['dt_fim'] : '';

        if ($dt_inicio) {
            $this->model = ($dt_inicio) ? $this->model->where('created_at', '>=', $dt_inicio) : $this->model;
        }
        
        if ($dt_fim) {
            $this->model = ($dt_fim) ? $this->model->where('created_at', '<=', $dt_fim) : $this->model;
        }
        
        $this->model = ($id) ? $this->model->where('id', '=', $id) : $this->model;
        $this->model = ($vertical_id) ? $this->model->where('vertical_id', '=', "$vertical_id") : $this->model;
        $this->model = ($descricao) ? $this->model->where(DB::raw('lower(descricao)'), 'LIKE', "%$descricao%") : $this->model;
        $this->model = $this->model->orderByDesc('id');

        return $this->model;
    }

    public function salvarProduto($params = [])
    {
        $nome        = ($params['nome']) ?? throw new Exception('O nome do produto não foi informado.', 1);
        $vertical_id = ($params['vertical']) ?? throw new Exception('A vertical não foi informada.', 1);
        $area_lar    = ($params['area_lar']) ?? throw new Exception('A largura total não foi informada.', 1);
        $area_alt    = ($params['area_alt']) ?? throw new Exception('A altura total não foi informada.', 1);
        $visual_lar  = ($params['visual_lar']) ?? throw new Exception('A largura visual não foi informada.', 1);
        $visual_alt  = ($params['visual_alt']) ?? throw new Exception('A altura visual não foi informada.', 1);
       
        $vertical = new Vertical();
        $tipo_midia_id = $vertical->buscar(['id' => $vertical_id])->get()->first()->tipo_midia_id;
        
        $this->model->descricao   = $nome;
        $this->model->vertical_id = $vertical_id;
        $this->model->area_lar    = $area_lar;
        $this->model->area_alt    = $area_alt;
        $this->model->visual_lar  = $visual_lar;
        $this->model->visual_alt  = $visual_alt;
        $this->model->tipo_midia_id = $tipo_midia_id;

        if (!$this->model->save()) {
            throw new Exception('Um erro ocorreu ao tentar salvar o novo produto.', 1);
        }
    }

    public function editaProduto($params = [])
    {
        $id = ($params['id']) ?? throw new Exception('Não foi possível encontrar o produto.');

        if (!$id) {
            throw new Exception('Não foi possível encontrar o produto.');
        }

        $this->model = $this->model->where('id', '=', (int) $id)->get()->first();
        
        $nome        = ($params['nome']) ?? throw new Exception('O nome do produto não foi informado.', 1);
        $vertical_id = ($params['vertical']) ?? throw new Exception('A vertical não foi informada.', 1);
        $area_lar    = ($params['area_lar']) ?? throw new Exception('A largura total não foi informada.', 1);
        $area_alt    = ($params['area_alt']) ?? throw new Exception('A altura total não foi informada.', 1);
        $visual_lar  = ($params['visual_lar']) ?? throw new Exception('A largura visual não foi informada.', 1);
        $visual_alt  = ($params['visual_alt']) ?? throw new Exception('A altura visual não foi informada.', 1);
        
        $this->model->descricao   = $nome;
        $this->model->vertical_id = $vertical_id;
        $this->model->area_lar    = $area_lar;
        $this->model->area_alt    = $area_alt;
        $this->model->visual_lar  = $visual_lar;
        $this->model->visual_alt  = $visual_alt;

        if (!$this->model->save()) {
            throw new Exception('Não foi possível editar este produto.');
        }
    }

    public function removeProduto($params = [])
    {
        $id = ($params['id']) ?? throw new Exception('Não foi possível encontrar o produto.');
        
        if (!$id) {
            throw new Exception('Não foi possível encontrar o produto.');
        }

        $this->model = $this->model->where('id', '=', (int) $id)->get()->first();
        
        if (!$this->model->delete()) {
            throw new Exception('Não foi possível remover este produto.');
        }
    }
}