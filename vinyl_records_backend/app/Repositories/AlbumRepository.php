<?php

namespace App\Repositories;

use App\Models\Album;

class AlbumRepository extends BaseRepository{

    public function __construct(Album $model)
    {
        parent::__construct($model);
    }
}
