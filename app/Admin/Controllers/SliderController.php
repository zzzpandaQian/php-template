<?php

namespace App\Admin\Controllers;

use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Show;
use App\Admin\Repositories\Slider;
use App\Admin\Repositories\NewsCategory;
use Dcat\Admin\Http\Controllers\AdminController;

class SliderController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = '滑块列表';
    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Grid::make(new Slider(), function (Grid $grid) {
            $grid->column('id')->sortable();
            $grid->column('title');
            $grid->column('has_button')->using(Slider::$buttonMap)->badge(NewsCategory::$statusColor);
            $grid->column('button_link_url');
            $grid->column('is_light')->using(Slider::$lightMap)->badge(NewsCategory::$statusColor);
            $grid->column('position')->using(Slider::$positionMap);
            $grid->column('sort_order');
            $grid->column('status')->using(NewsCategory::$activeMap)->badge(NewsCategory::$statusColor);

            $grid->quickSearch('id', 'title')
            ->placeholder('输入ID或类型名称以搜索')
            ->auto(false);

            $grid->filter(function (Grid\Filter $filter) {
                $filter->panel();
                $filter->like('title', '标题')->width(2);
                $filter->equal('has_button')->radio(['' => '全部'] + Slider::$buttonMap)->width(2);
                $filter->equal('is_light')->radio(['' => '全部'] + Slider::$lightMap)->width(2);
                $filter->equal('position')->radio(['' => '全部'] + Slider::$positionMap)->width(3);
                $filter->equal('status', '状态')->radio(['' => '全部'] + NewsCategory::$activeMap)->default(1)->width(2);

            });
        });
    }

    /**
     * Make a show builder.
     *
     * @param mixed $id
     *
     * @return Show
     */
    protected function detail($id)
    {
        return Show::make($id, new Slider(), function (Show $show) {
            $show->field('id');
            $show->field('title');
            $show->field('image_url')->image();
            $show->field('description');
            $show->field('has_button')->using(Slider::$buttonMap)->dot(NewsCategory::$statusColor);
            $show->field('button_link_url');
            $show->field('is_light')->using(NewsCategory::$statusMap)->dot(NewsCategory::$statusColor);
            $show->field('position')->using(Slider::$positionMap);
            $show->field('sort_order');
            $show->field('status')->using(NewsCategory::$activeMap)->dot(NewsCategory::$statusColor);
            $show->field('created_at');
            $show->field('updated_at');
        });
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        return Form::make(new Slider(), function (Form $form) {
            $form->display('id');
            $form->text('title')->required();
            $form->image('image_url')->move('images/slider')->help("建议尺寸：1920x600");
            $form->url('button_link_url');
            $form->textarea('description');
            $form->radio('has_button')->options(Slider::$buttonMap)->required();
            $form->radio('is_light')->options(Slider::$lightMap)->required();
            $form->radio('position')->options(Slider::$positionMap)->required();
            $form->number('sort_order');
            $form->radio('status')->options(NewsCategory::$activeMap)->default(0);

            $form->display('created_at');
            $form->display('updated_at');
        });
    }
}
