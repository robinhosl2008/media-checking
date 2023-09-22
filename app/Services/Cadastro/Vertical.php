<?php

namespace App\Services\Cadastro;

use App\Models\LibVertical;
use App\Services\CRUD;
use Exception;

class Vertical extends CRUD
{

    public function __construct()
    {
        parent::__construct(new LibVertical());
    }

    /**
     * Busca pelos tipos de mídia.
     * 
     * @param array $params Array contendo os parâmetros para a realização de buscas específicas.
     */
    public function buscar($params = [])
    {
        $id          = ($params['id']) ? $params['id'] : '';
        $tipo_midia  = ($params['tipo_midia_id']) ? $params['tipo_midia_id'] : '';
        $descricao   = ($params['descricao']) ? $params['descricao'] : '';

        $this->model = ($id) ? $this->model->where('id', '=', $id) : $this->model;
        $this->model = ($tipo_midia) ? $this->model->where('tipo_midia_id', 'LIKE', "%{$tipo_midia}%") : $this->model;
        $this->model = ($descricao) ? $this->model->where('descricao', 'LIKE', "%{$descricao}%") : $this->model;
        
        return $this->model;
    }

    public function salvarVertical($params = [])
    {
        $nome          = ($params['nome']) ?? throw new Exception('O nome da vertical não foi informado.', 1);
        $tipo_midia_id = ($params['tipo_midia']) ?? throw new Exception('O tipo de mídia não foi informado.', 1);
       
        $this->model->descricao = $nome;
        $this->model->tipo_midia_id = $tipo_midia_id;

        if (!$this->model->save()) {
            throw new Exception('Um erro ocorreu ao tentar salvar a nova vertical.', 1);
        }
    }

    public function editaVertical($params = [])
    {
        $id = ($params['id']) ?? throw new Exception('Não foi possível encontrar a vertical.');

        if (!$id) {
            throw new Exception('Não foi possível encontrar a vertical.');
        }

        $this->model = $this->model->where('id', '=', (int) $id)->get()->first();

        $nome = ($params['nome']) ?? throw new Exception('O nome da vertical não foi informado.', 1);
        $tipo_midia_id = ($params['tipo_midia']) ?? throw new Exception('O tipo de mídia não foi informado.', 1);
        
        $this->model->descricao      = $nome;
        $this->model->tipo_midia_id  = $tipo_midia_id;

        if (!$this->model->save()) {
            throw new Exception('Não foi possível editar esta vertical.');
        }
    }

    public function removeVertical($params = [])
    {
        $id = ($params['id']) ?? throw new Exception('Não foi possível encontrar a vertical.');
        
        if (!$id) {
            throw new Exception('Não foi possível encontrar a vertical.');
        }

        $this->model = $this->model->where('id', '=', (int) $id)->get()->first();
        
        if (!$this->model->delete())
        {
            throw new Exception('Não foi possível remover esta vertical.');
        }
    }
}