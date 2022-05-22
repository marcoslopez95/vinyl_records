<?php

namespace App\Repositories;

use App\Models\Genre;
use App\Models\Rol;
use App\Models\User;

class UserRepository extends BaseRepository{

    public function __construct(User $model)
    {
        parent::__construct($model);
    }

    public function _index(array $data = [])
    {
        $users = $this->model::addSelect([
                        'rol_name' => Rol::select('name')->whereColumn('users.rol_id','rols.id')->limit(1),
                    ])
                    ->get();
        return $users;
    }

    public function _show(int $id)
    {
        $user = parent::_show($id);
        $tastes = $user->load('tastes')->tastes->modelKeys();
        unset($user['tastes']);
        $user['tastes'] = $tastes;
        return $user;
    }

}
