<?php

namespace App\Admin\Controllers;

use App\Admin\Repositories\Version;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Show;
use Dcat\Admin\Http\Controllers\AdminController;

class VersionController extends AdminController
{
    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Grid::make(new Version(), function (Grid $grid) {
            $grid->column('id')->sortable();
            $grid->column('version');
            $grid->column('disabled')->using(Version::isDisabled());
            $grid->column('created_at');
            $grid->column('updated_at')->sortable();

            $grid->filter(function (Grid\Filter $filter) {
                $filter->equal('id');
                $filter->like('version');
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
        return Show::make($id, new Version(), function (Show $show) {
            $show->field('id');
            $show->field('version');
            $show->field('disabled')->using(Version::isDisabled());
            $show->file('file');

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
        return Form::make(new Version(), function (Form $form) {
            $form->display('id');
            $form->text('version');
            $form->switch('disabled');
            $form->file('file');
            $form->display('created_at');
            $form->display('updated_at');
        });
    }
}
