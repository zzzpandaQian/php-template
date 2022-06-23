<?php

namespace App\Admin\Repositories;

use App\Models\Slider as Model;
use Dcat\Admin\Repositories\EloquentRepository;

class Slider extends EloquentRepository
{
    /**
     * Model.
     *
     * @var string
     */
    protected $eloquentClass = Model::class;

    /**
     * 位置：1=>居左，2=>居中，3=>居左=右
     */
    const POSITION_LEFT   = 1;
    const POSITION_CENTER = 2;
    const POSITION_RIGHT  = 3;

    /**
     * 位置：1=>居左，2=>居中，3=>居左=右
     *
     * @var array
     */
    public static $positionMap = [
        self:: POSITION_LEFT    => '居左',
        self:: POSITION_CENTER    => '居中',
        self:: POSITION_RIGHT    => '居右',
    ];

    /**
     * 明暗显示：0=>暗，1=>明
     */
    const LIGHT_DARK  = 0;
    const LIGHT_LIGHT = 1;

    /**
     * 明暗显示：0=>暗，1=>明
     *
     * @var array
     */
    public static $lightMap = [
        self:: LIGHT_LIGHT    => '明',
        self:: LIGHT_DARK    => '暗',
    ];


    /**
     * 按钮是否显示：1=>显示，0=>隐藏
     */
    const BUTTON_YES = 1;
    const BUTTON_NO  = 0;

    /**
     * 按钮是否显示：1=>显示，0=>隐藏
     *
     * @var array
     */
    public static $buttonMap = [
        self:: BUTTON_YES => '显示',
        self:: BUTTON_NO  => '隐藏',
    ];

    /**
     * 状态颜色
     */
    const SUCCESS_SLIDER_STATUS_COLOR = 1;
    const DANGER_SLIDER_STATUS_COLOR = 0;

    /**
     * 状态颜色集合
     */
    public static $sliderStatusColor = [
        self::DANGER_SLIDER_STATUS_COLOR => 'danger',
        self::SUCCESS_SLIDER_STATUS_COLOR => 'success'
    ];
}
