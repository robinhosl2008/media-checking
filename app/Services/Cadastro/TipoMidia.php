<?php

namespace App\Services\Cadastro;

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
        $descricao   = (array_key_exists('descricao', $params) && $params['descricao']) ? $params['descricao'] : '';
        
        $this->model = $this->model->where('id', '<>', 3);
        $this->model = ($id) ? $this->model->where('id', '=', $id) : $this->model;
        $this->model = ($descricao)   ? $this->model->where('descricao', 'LIKE', "%{$descricao}%") : $this->model;
        
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