<?php

namespace App\Admin\Widgets\Charts;

use App\Models\News;
use Dcat\Admin\Widgets\ApexCharts\Chart;
use Illuminate\Http\Request;

class NewsRecommend extends Chart
{
    protected $month;

    public function __construct($month = null, $containerSelector = null, $options = [])
    {
        parent::__construct($containerSelector, $options);

        $this->setUpOptions();

        $this->$month;
    }

    /**
     * 初始化图表配置
     */
    //初始化方法，主要是调用$this->options()方法，执行整个option的初始化操作。
    public function handle(Request $request)
    {
        $month = $request->get('month');

        $this->options([
            "chart"=>[
                "height" => 600,
                "type"   => "pie",
            ],
            "fill" => [
                "opacity" => 0.8
            ],
        ]);

        // 执行你的数据查询逻辑

        // 查推荐新闻数量
        $news_recommend_count1 = News::where('is_recommend', 1)
            ->when($month, function ($query) use ($month) {
                return $query->where(\DB::raw("date_format(created_at,'%Y-%m')"), $month);
            })
            ->count();

        // 查非推荐新闻数量
        $news_recommend_count0 = News::where('is_recommend', 0)
            ->when($month, function ($query) use ($month) {
                return $query->where(\DB::raw("date_format(created_at,'%Y-%m')"), $month);
            })
            ->count();


        $data = [
            $news_recommend_count1,
            $news_recommend_count0,
        ];

        $label = [
            '推荐',
            '非推荐',
        ];

        //option()方法也定义在Dcat\Admin\Widgets 类中，它负责为options属性，进行设置工作
        $this->option("series", $data);
        $this->option("labels", $label);

    }

    /**
     * 这里返回需要异步传递到 handle 方法的参数
     *
     * @return array
     */
    public function parameters(): array
    {
        return [
            'month' => $this->month,
        ];
    }
}
