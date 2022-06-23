<?php

namespace App\Admin\Repositories;

use App\Models\NewsTag as Model;
use Dcat\Admin\Repositories\EloquentRepository;

class NewsTag extends EloquentRepository
{
    /**
     * Model.
     *
     * @var string
     */
    protected $eloquentClass = Model::class;
}
