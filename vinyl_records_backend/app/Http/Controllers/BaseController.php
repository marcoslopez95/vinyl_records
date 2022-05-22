<?php

namespace App\Http\Controllers;

use App\Interfaces\CrudInterfaz;
use App\Services\BaseService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class BaseController extends Controller implements CrudInterfaz {
    protected $service;
    protected $object;

    public function __construct(BaseService $service)
    {
        $this->service = $service;
    }

    public function _index(Request $data){
        try{

            $this->object = $this->service->_index($data);

            return custom_response(true,'Index',$this->object);
        }catch(Exception $e){
            return custom_error($e);
        }
    }

    public function _store(array $data){
        DB::beginTransaction();
        try{

            $this->object = $this->service->_store($data);
            DB::commit();
            return custom_response(true,'Creado con éxito',$this->object);
        }catch(Exception $e){
            DB::rollback();
            return custom_error($e);
        }
    }

    public function _show(int $id){
        try{

            $this->object = $this->service->_show($id);

            return custom_response(true,'Mostrar Registro',$this->object);
        }catch(Exception $e){
            return custom_error($e);
        }
    }

    public function _update(int $id, array $data){
        DB::beginTransaction();
        try{

            $this->object = $this->service->_update($id,$data);
            DB::commit();
            return custom_response(true,'Actualizado con éxito',$this->object);
        }catch(Exception $e){
            DB::rollback();
            return custom_error($e);
        }
    }

    public function _delete(int $id){
        DB::beginTransaction();
        try{

            $this->object = $this->service->_delete($id);
            DB::commit();
            return custom_response(true,'Eliminado con éxito',$this->object);
        }catch(Exception $e){
            DB::rollback();
            return custom_error($e);
        }
    }

}
