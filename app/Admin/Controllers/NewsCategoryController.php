<?php

namespace App\Admin\Controllers;

use App\Admin\Repositories\NewsCategory;
use App\Models\NewsCategory as CategoryModels;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Show;
use Dcat\Admin\Http\Controllers\AdminController;

class NewsCategoryController extends AdminController
{
    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Grid::make(new NewsCategory(), function (Grid $grid) {
            $grid->column('id')->sortable();
            $grid->column('title');
            $grid->column('sort_order');
            $grid->column('status')->using(NewsCategory::$activeMap)->badge(NewsCategory::$statusColor);
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
        return Show::make($id, new NewsCategory(), function (Show $show) {
            $show->parent_id()->as(function () {
                $show_text = '顶级';
                if($this->parent_id){
                    $find_parent = NewsCategory::find($this->parent_id);
                    if($find_parent){
                        $show_text = json_decode($find_parent, true)['title'];
                    }
                }
                return $show_text;
            });
            $show->field('title');
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
        return Form::make(new NewsCategory(), function (Form $form) {
            $form->select('parent_id', '父级')->options(CategoryModels::selectOptions())->required();
            $form->text('title')->required();
            $form->number('sort_order');
            $form->switch('status');
            $form->display('created_at');
            $form->display('updated_at');
        });
    }
}
