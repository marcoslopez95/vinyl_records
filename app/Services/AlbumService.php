<?php

namespace App\Services;

use App\Repositories\AlbumRepository;

class AlbumService extends BaseService{

    public function __construct(AlbumRepository $repository)
    {
        parent::__construct($repository);
    }
}
