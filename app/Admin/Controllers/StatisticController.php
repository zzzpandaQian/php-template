<?php
namespace App\Admin\Controllers;

use Dcat\Admin\Layout\Row;
use Dcat\Admin\Widgets\Box;
use Dcat\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use App\Admin\Widgets\Charts\NewsRecommend;

class StatisticController extends Controller
{
    public function recommend(Content $content)
    {
        $title = '新闻推荐总占比';
        
        return $content->title($title)
            ->description('统计')
            ->breadcrumb(['text' => $title])
            ->body(function (Row $row) {
                $bar = NewsRecommend::make()
                    ->fetching('data.month=$("#filter-month").val();$("#month").loading()')
                    ->fetched('$("#month").loading(false)')
                    ->click('#filter-btn');

                $box = Box::make(' ', $bar)
                    ->id('month')
                    ->tool(admin_view('admin.statistics.month'));

                $row->column(12, $box);
            });
    }
}
