<?php

namespace App\Services;

use App\Repositories\ArtistRepository;

class ArtistService extends BaseService{

    public function __construct(ArtistRepository $repository)
    {
        parent::__construct($repository);
    }
}
