<?php

namespace App\Services;

use App\Repositories\RolRepository;

class RolService extends BaseService{

    public function __construct(RolRepository $repository)
    {
        parent::__construct($repository);
    }
}
