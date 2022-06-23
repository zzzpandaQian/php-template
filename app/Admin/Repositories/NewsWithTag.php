<?php

namespace App\Admin\Repositories;

use App\Models\NewsWithTag as Model;
use Dcat\Admin\Repositories\EloquentRepository;

class NewsWithTag extends EloquentRepository
{
    /**
     * Model.
     *
     * @var string
     */
    protected $eloquentClass = Model::class;
}
