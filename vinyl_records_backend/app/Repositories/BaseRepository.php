<?php

namespace App\Repositories;

use App\Interfaces\CrudInterfaz;
use Illuminate\Database\Eloquent\Model;

class BaseRepository implements CrudInterfaz {
    protected $model;
    protected $object;
    protected $all;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    public function _index($data){
        $this->all = count($data->all()) === 0 ? $this->model::all() : $this->model::Filter($data);
        return $this->all;
    }

    public function _store(array $data){
        $this->object = $this->model::create($data);
        return $this->object;
    }

    public function _show(int $id){
        $this->object = $this->model::find($id);
        return $this->object;
    }
    public function _update(int $id, array $data){
        self::_show($id);
        $this->object->update($data);
        $this->object->refresh();
        return $this->object;
    }

    public function _delete(int $id){
        self::_show($id);
        return $this->object->delete();
    }

}
