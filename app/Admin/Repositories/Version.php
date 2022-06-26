<?php

namespace App\Admin\Repositories;

use App\Models\Version as Model;
use Dcat\Admin\Repositories\EloquentRepository;

class Version extends EloquentRepository
{
    /**
     * Model.
     *
     * @var string
     */
    protected $eloquentClass = Model::class;
    public static function isDisabled()
    {
        return [
            '0' => '否',
            '1' => '是',
        ];
    }
}
