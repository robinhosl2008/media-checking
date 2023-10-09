<?php

namespace App\Services\Cadastro;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Services\CRUD;
use App\Models\LibTipoMidia;
use Exception;

class TipoMidia extends CRUD
{
    public function __construct()
    {
        parent::__construct(new LibTipoMidia());
    }

    /**
     * Busca pelos tipos de mídia.
     * 
     * @param array $params Array contendo os parâmetros para a realização de buscas específicas.
     */
    public function buscar($params = [])
    {
        $id          = (array_key_exists('id', $params) && $params['id']) ? $params['id'] : '';
        $descricao   = (array_key_exists('nome', $params) && $params['nome']) ? $params['nome'] : '';
        $dt_inicio   = (array_key_exists('dt_inicio', $params) && $params['dt_inicio']) ? $params['dt_inicio'] : '';
        $dt_fim      = (array_key_exists('dt_fim', $params) && $params['dt_fim']) ? $params['dt_fim'] : '';

        if ($dt_inicio) {
            $this->model = ($dt_inicio) ? $this->model->where('created_at', '>=', $dt_inicio) : $this->model;
        }
        
        if ($dt_fim) {
            $this->model = ($dt_fim) ? $this->model->where('created_at', '<=', $dt_fim) : $this->model;
        }
        
        $this->model = ($id) ? $this->model->where('id', '=', $id) : $this->model;
        $this->model = ($descricao)   ? $this->model->where(DB::raw('lower(descricao)'), 'LIKE', "%$descricao%") : $this->model;
        $this->model = $this->model->orderByDesc('id');
        
        return $this->model;
    }

    public function salvarTipoMidia($params = [])
    {
        $nome = ($params['nome']) ?? throw new Exception('O nome do tipo de mídia não foi informado.', 1);
       
        $this->model->descricao = $nome;

        if (!$this->model->save()) {
            throw new Exception('Um erro ocorreu ao tentar salvar o novo tipo de mídia.', 1);
        }
    }

    public function editaTipoMidia($params = [])
    {
        $id = ($params['id']) ?? throw new Exception('Não foi possível encontrar o tipo de mídia.');

        if (!$id) {
            throw new Exception('Não foi possível encontrar o usuário.');
        }

        $this->model = $this->model->where('id', '=', (int) $id)->get()->first();

        $nome   = ($params['nome']) ?? throw new Exception('O nome do tipo de mídia não foi informado.', 1);
        
        $this->model->descricao  = $nome;

        if (!$this->model->save()) {
            throw new Exception('Não foi possível editar este tipo de mídia.');
        }
    }

    public function removeTipoMidia($params = [])
    {
        $id = ($params['id']) ?? throw new Exception('Não foi possível encontrar o tipo de mídia.');
        
        if (!$id) {
            throw new Exception('Não foi possível encontrar o tipo de mídia.');
        }

        $this->model = $this->model->where('id', '=', (int) $id)->get()->first();
        
        if (!$this->model->delete())
        {
            throw new Exception('Não foi possível remover este tipo de mídia.');
        }
    }
}