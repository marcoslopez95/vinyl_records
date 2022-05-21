<?php

namespace App\Repositories;

use App\Models\Rol;

class RolRepository extends BaseRepository{

    public function __construct(Rol $model)
    {
        parent::__construct($model);
    }
}
