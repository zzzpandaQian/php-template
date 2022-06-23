<?php

namespace App\Admin\Repositories;

use App\Models\UsersWithPwd as Model;
use Dcat\Admin\Repositories\EloquentRepository;

class UsersWithPwd extends EloquentRepository
{
    /**
     * Model.
     *
     * @var string
     */
    protected $eloquentClass = Model::class;
}
