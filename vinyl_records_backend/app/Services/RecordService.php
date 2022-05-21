<?php

namespace App\Services;

use App\Repositories\RecordRepository;

class RecordService extends BaseService{

    public function __construct(RecordRepository $repository)
    {
        parent::__construct($repository);
    }
}
