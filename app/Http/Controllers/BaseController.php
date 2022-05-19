<?php

namespace App\Http\Controllers;

use App\Interfaces\CrudInterfaz;
use App\Services\BaseService;
use Exception;
use Illuminate\Support\Facades\Log;

class BaseController extends Controller implements CrudInterfaz {
    protected $service;
    protected $object;

    public function __construct(BaseService $service)
    {
        $this->service = $service;
    }

    public function _index(array $data = []){
        try{

            $this->object = $this->service->_index($data);

            return custom_response(true,'Index',$this->object);
        }catch(Exception $e){
            $error = [
                'line'    => $e->getLine(),
                'file'    => $e->getFile(),
                'message' => $e->getMessage()
            ];

            Log::alert($error);
            return custom_response(false);
        }
    }

    public function _store(array $data){
        try{

            $this->object = $this->service->_store($data);

            return custom_response(true,'Creado con éxito',$this->object);
        }catch(Exception $e){
            $error = [
                'line'    => $e->getLine(),
                'file'    => $e->getFile(),
                'message' => $e->getMessage()
            ];

            Log::alert($error);
            return custom_response(false);
        }
    }

    public function _show(int $id){
        try{

            $this->object = $this->service->_show($id);

            return custom_response(true,'Mostrar Registro',$this->object);
        }catch(Exception $e){
            $error = [
                'line'    => $e->getLine(),
                'file'    => $e->getFile(),
                'message' => $e->getMessage()
            ];

            Log::alert($error);
            return custom_response(false);
        }
    }

    public function _update(int $id, array $data){
        try{

            $this->object = $this->service->_update($id,$data);

            return custom_response(true,'Actualizado con éxito',$this->object);
        }catch(Exception $e){
            $error = [
                'line'    => $e->getLine(),
                'file'    => $e->getFile(),
                'message' => $e->getMessage()
            ];

            Log::alert($error);
            return custom_response(false);
        }
    }

    public function _delete(int $id){
        try{

            $this->object = $this->service->_delete($id);

            return custom_response(true,'Eliminado con éxito',$this->object);
        }catch(Exception $e){
            $error = [
                'line'    => $e->getLine(),
                'file'    => $e->getFile(),
                'message' => $e->getMessage()
            ];

            Log::alert($error);
            return custom_response(false);
        }
    }

}
