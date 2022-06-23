<?php

namespace App\Admin\Controllers;

use App\Admin\Repositories\NewsTag;
use App\Admin\Repositories\NewsCategory;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Show;
use Dcat\Admin\Http\Controllers\AdminController;

class NewsTagController extends AdminController
{
    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Grid::make(new NewsTag(), function (Grid $grid) {
            $grid->column('id')->sortable();
            $grid->column('title');
            $grid->column('status');
            $grid->column('created_at');
            $grid->column('updated_at')->sortable();
            $grid->filter(function (Grid\Filter $filter) {
                $filter->like('title');
                $filter->equal('status', '状态')->radio(NewsCategory::$activeMap);
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
        return Show::make($id, new NewsTag(), function (Show $show) {
            $show->field('title');
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
        return Form::make(new NewsTag(), function (Form $form) {
            $form->text('title')->required();
            $form->switch('status');
            $form->display('created_at');
            $form->display('updated_at');
        });
    }
}
