<?php

namespace App\Repositories;

use App\Models\Artist;

class ArtistRepository extends BaseRepository
{

    public function __construct(Artist $model)
    {
        parent::__construct($model);
    }
}
