<?php

namespace App\Admin\Repositories;

use App\Models\NewsCategory as Model;
use Dcat\Admin\Repositories\EloquentRepository;

class NewsCategory extends EloquentRepository
{
    /**
     * Model.
     *
     * @var string
     */
    protected $eloquentClass = Model::class;

    /**
     * 激活状态 1
     */
    const STATUS_ACTIVE = 1;

    /**
     * 激活状态 0
     */
    const STATUS_INACTIVE = 0;

    /**
     * 激活状态集合
     */
    public static $activeMap = [
        self::STATUS_ACTIVE => '激活',
        self::STATUS_INACTIVE => '禁用',
    ];

    /**
     * 是否状态 1
     */
    const STATUS_YES = 1;

    /**
     * 是否状态 0
     */
    const STATUS_NO = 0;

    /**
     * 是否状态集合
     */
    public static $statusMap = [
        self::STATUS_YES => '是',
        self::STATUS_NO => '否',
    ];

    /**
     * 状态颜色 1
     */
    const DANGER_STATUS_COLOR = 0;

    /**
     * 状态颜色 0
     */
    const SUCCESS_STATUS_COLOR = 1;

    /**
     * 状态颜色集合
     */
    public static $statusColor = [
        self::DANGER_STATUS_COLOR => 'danger',
        self::SUCCESS_STATUS_COLOR => 'success'
    ];
}
