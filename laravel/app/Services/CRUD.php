<?php

namespace App\Services;

use App\Helper\LogOnbus;
use Exception;
use Illuminate\Database\Eloquent\Model;

abstract class CRUD {

    protected $has_with = true;
    protected $renew_model;
    protected $arr_columns;
    protected $model;

    // Número total de registros que serão exibidos por página
    protected $limit = 30;

    /**
     * ServiceCRUD constructor.
     * @param $model
     */
    public function __construct($model){
        $this->model        = $model;
        $this->renew_model  = $model;
    }

    /**
     * @param $arr_param
     * @return mixed
     * @throws Exception
     */
    public function adicionar($arrForm){
        try {
            return $this->model->create($arrForm);
        } catch(Exception $e){
            throw new Exception($e->getMessage());
        }
    }

    /**
     *
     * @throws Exception
     */
    public function adicionar_editar($arr_param){
        try {

            $arrForm = array_get($arr_param, 'arrForm');

            // 1. Tenta localizar o registro com base nos parametros informados
            // 1.1 Habilita o withTrashed para trazer registros deletados
             $this->model    = (!is_array($this->arr_columns)) ? $this->model->withTrashed() : $this->model;

            // 1. Tenta localizar o registro com base nos parametros informados
            $Model = $this->exibir($arr_param);

            if ($Model){
                // 2. Se localizarmos registro, edita-lo
                return tap($Model)->update($arrForm);
            } else {
                // 3. Se não localizarmos, adiciona-loA
                return $this->adicionar($arrForm);
            }

        } catch(Exception $e){
            throw new Exception($e->getMessage());
        }
    }

    public function adicionar_multiplo(){
        try {

        } catch (Exception $e){
            throw new Exception($e->getMessage());
        }
    }

    /**
     * @param array $arr_param
     * @return mixed
     * @throws Exception
     */
    public function exibir($arr_param=[]){
        try {
            return $this->buscar($arr_param)->first();
        } catch(Exception $e){
            throw new Exception($e->getMessage());
        }
    }

    /**
     * @param $arr_param
     * @return mixed
     * @throws Exception
     */
    public function editar($arr_param){
        try {

            $Model      = $this->exibir($arr_param);
            $arrForm    = array_get($arr_param, 'arrForm');

            if (!$Model){
                throw new \Exception("Não foi possível localizar o registro para edição");
            } else {
                return tap($Model)->update($arrForm);
            }

        } catch(Exception $e){
            //LogOnbus::error($e->getMessage());
            throw new Exception($e->getMessage());
        }
    }

    /**
     * @param array $arr_param
     * @return mixed
     * @throws Exception
     */
    public function listar($arr_param=[]){
        try {
            return $this->buscar($arr_param)->paginate($this->limit)->appends(\Request::all());
        } catch(Exception $e){
            throw new Exception($e->getMessage());
        }
    }

    /**
     * @param array $arr_param
     * @return mixed
     * @throws Exception
     */
    public function excluir($arr_param=[]){
        try {
            return $this->buscar($arr_param)->toBase()->delete();
        } catch(Exception $e){
            throw new Exception($e->getMessage());
        }
    }

    /**
     * @param array $arr_param
     * @return mixed
     * @throws Exception
     */
    public function excluir_soft_delete($arr_param=[]){
        try {
            return $this->buscar($arr_param)->delete();
        } catch(Exception $e){
            throw new Exception($e->getMessage());
        }
    }

    public function set_columns($arr_columns){
        $this->arr_columns  = $arr_columns;
        $this->model        = $this->model->select($arr_columns);
        return $this;
    }

    public function set_order($column, $order="ASC"){
        $this->model = $this->model->orderBy($column, $order);
        return $this;
    }

    /**
     * Define o limite de resultados
     * @param $limit
     */
    public function set_limit($limit){
        $this->limit = $limit;
        return $this;
    }

    public function no_limit(){
        $this->limit = null;
        return $this;
    }

    public function set_with($with_name){
        $this->model = $this->model->with($with_name);
        return $this;
    }

    public function renew_model(){
        $this->model = $this->renew_model;
        return $this;
    }

    public function has_with($bool){
        $this->has_with = $bool;
        return $this;
    }

    /**
     * @param array $arr_param
     * @return Model
     */
    protected abstract function buscar($arr_param=[]);

}
