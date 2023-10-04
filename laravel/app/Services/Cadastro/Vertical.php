<?php

namespace App\Services\Cadastro;

use App\Models\LibVertical;
use App\Services\CRUD;
use Exception;
use Illuminate\Support\Facades\DB;

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
        $id          = (array_key_exists('id', $params) && $params['id']) ? $params['id'] : '';
        $tipo_midia  = (array_key_exists('tipo_midia_id', $params) && $params['tipo_midia_id']) ? $params['tipo_midia_id'] : '';
        $descricao   = (array_key_exists('descricao', $params) && $params['descricao']) ? $params['descricao'] : '';
        $dt_inicio   = (array_key_exists('dt_inicio', $params) && $params['dt_inicio']) ? $params['dt_inicio'] : '';
        $dt_fim      = (array_key_exists('dt_fim', $params) && $params['dt_fim']) ? $params['dt_fim'] : '';

        if ($dt_inicio) {
            $this->model = ($dt_inicio) ? $this->model->where('created_at', '>=', $dt_inicio) : $this->model;
        }
        
        if ($dt_fim) {
            $this->model = ($dt_fim) ? $this->model->where('created_at', '<=', $dt_fim) : $this->model;
        }
        
        $this->model = ($id) ? $this->model->where('id', '=', $id) : $this->model;
        $this->model = ($tipo_midia) ? $this->model->where('tipo_midia_id', '=', "$tipo_midia") : $this->model;
        $this->model = ($descricao) ? $this->model->where(DB::raw('lower(descricao)'), 'LIKE', "%$descricao%") : $this->model;
        $this->model = $this->model->orderByDesc('id');

        return $this->model;
    }

    public function salvarVertical($params = [])
    {
        $nome          = ($params['nome']) ?? throw new Exception('O nome da vertical não foi informado.', 1);
        $tipo_midia_id = ($params['tipo_midia']) ?? throw new Exception('O tipo de mídia não foi informado.', 1);
        $ativo_inativo = ($params['ativo_inativo']) ?? throw new Exception('Não foi informado se essa vertical deve ser exibida.', 1);
       
        $this->model->descricao     = $nome;
        $this->model->tipo_midia_id = $tipo_midia_id;
        $this->model->status        = $ativo_inativo;

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
        $ativo_inativo = ($params['ativo_inativo']) ?? 0;
       
        $this->model->descricao      = $nome;
        $this->model->tipo_midia_id  = $tipo_midia_id;
        $this->model->status         = $ativo_inativo;

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