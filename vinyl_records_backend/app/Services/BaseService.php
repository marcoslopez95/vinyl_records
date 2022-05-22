<?php

namespace App\Services;

use App\Interfaces\CrudInterfaz;
use App\Repositories\BaseRepository;
use Illuminate\Http\Client\Request;

class BaseService implements CrudInterfaz {
    protected $repository;

    public function __construct(BaseRepository $repository)
    {
        $this->repository = $repository;
    }

    public function _index($data){
        return $this->repository->_index($data);
    }

    public function _store(array $data){
        return $this->repository->_store($data);
    }

    public function _show(int $id){
        return $this->repository->_show($id);
    }

    public function _update(int $id, array $data){
        return $this->repository->_update($id,$data);
    }

    public function _delete(int $id){
        return $this->repository->_delete($id);
    }

}
