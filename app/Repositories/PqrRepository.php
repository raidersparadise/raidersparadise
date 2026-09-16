<?php

namespace App\Repositories;

use App\Models\Pqr;

class PqrRepository extends BaseRepository
{
    public function __construct(Pqr $model)
    {
        parent::__construct($model);
    }
}
