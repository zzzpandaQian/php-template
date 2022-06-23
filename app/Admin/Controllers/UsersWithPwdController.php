<?php

namespace App\Admin\Controllers;

use App\Admin\Repositories\UsersWithPwd;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Show;
use Dcat\Admin\Http\Controllers\AdminController;

class UsersWithPwdController extends AdminController
{
    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Grid::make(new UsersWithPwd(), function (Grid $grid) {
            $grid->column('id')->sortable();
            $grid->column('username');
            $grid->column('password');
            $grid->column('gender');
            $grid->column('nickname');
            $grid->column('email');
            $grid->column('mobile');
            // $grid->column('user_id');
            $grid->column('birth');
            $grid->column('created_at');
            $grid->column('updated_at')->sortable();

            $grid->filter(function (Grid\Filter $filter) {
                $filter->equal('id');
                $filter->equal('mobile');
                $filter->like('nickname');
                $filter->between('created_at', '创建时间')->datetime();
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
        return Show::make($id, new UsersWithPwd(), function (Show $show) {
            $show->field('id');
            $show->field('username');
            $show->field('gender');
            $show->field('nickname');
            $show->field('email');
            $show->field('mobile');
            $show->field('user_id');
            $show->field('birth');
            $show->field('avatar');
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
        return Form::make(new UsersWithPwd(), function (Form $form) {
            $form->display('id');
            $form->text('username');
            $form->text('password');
            $gender = [
                0 => '男',
                1 => '女'
            ];
            $form->select('gender', '性别')->options($gender);
            $form->text('nickname');
            $form->text('email');
            $form->text('mobile');
            $form->text('user_id');
            $form->datetime('birth', '生日');
            $form->image('avatar');
            $form->display('created_at');
            $form->display('updated_at');
        });
    }
}
