<?php

namespace App\Admin\Controllers;

use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Show;
use App\Admin\Repositories\User;
use App\Admin\Repositories\NewsCategory;
use Dcat\Admin\Http\Controllers\AdminController;

class UserController extends AdminController
{
    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Grid::make(new User(), function (Grid $grid) {
            $grid->column('id')->sortable();
            $grid->column('nickname');
            $grid->column('mobile');
            $grid->column('email');
            $grid->column('status')->using(NewsCategory::$activeMap)->badge(NewsCategory::$statusColor);
            $grid->filter(function (Grid\Filter $filter) {
                $filter->panel();
                $filter->like('name')->width(6);
                $filter->like('mobile')->width(6);
                $filter->between('created_at')->datetime()->width(3);
                $filter->between('updated_at')->datetime()->width(3);
                $filter->equal('status', '状态')
                    ->radio(['' => '全部'] + NewsCategory::$activeMap)
                    ->default(1)
                    ->width(3);
            });

            $grid->quickSearch('id', 'name', 'mobile')
                ->placeholder('输入用户ID或用户名或手机号以搜索')
                ->auto(false);
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
        return Show::make($id, new User(), function (Show $show) {
            $show->field('id');
            $show->field('name');
            $show->field('email');
            $show->field('gender')->using(User::gender());
            $show->field('birthdate');
            $show->field('avatar')->image();
            $show->field('address');
            $show->field('nickname');
            $show->field('language')->using(['zh'=>'中文','en'=>'英文']);
            $show->field('wx_nickname');
            $show->field('wx_avatar')->image();
            $show->field('wx_openid');
            $show->field('xcx_openid');
            $show->field('unionid');
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
        return Form::make(new User(), function (Form $form) {
            $form->text('name')->required();
            $form->text('mobile');
            $form->text('email');
            $form->password('password');
            $form->radio('gender')->options(User::gender());
            $form->date('birthdate');
            $form->image('avatar')->autoUpload();
            $form->text('address');
            $form->display('nickname');
            $form->select('language', '语言')->options(['zh'=>'中文','en'=>'英文']);
            $form->display('wx_nickname');
            $form->display('wx_avatar');
            $form->display('wx_openid');
            $form->display('xcx_openid');
            $form->display('unionid');
            $form->switch('status');
            $form->saving(function (Form $form) {
                if (request('password')) {
                    $form->password = bcrypt(request('password'));
                }
            });
        });
    }
}
