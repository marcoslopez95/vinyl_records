<?php

namespace App\Repositories;

use App\Models\User;

class UserRepository extends BaseRepository{

    public function __construct(User $model)
    {
        parent::__construct($model);
    }

    public function _index(array $data = [])
    {
        $users = $this->model::select(['users.*','rols.name as rol_name'])->join('rols','users.rol_id','rols.id')->get();
        return $users;
    }

}
