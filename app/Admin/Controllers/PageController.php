<?php

namespace App\Admin\Controllers;

use App\Admin\Repositories\Page;
use App\Models\Page as PageModels;
use App\Admin\Repositories\NewsCategory;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Show;
use Dcat\Admin\Http\Controllers\AdminController;

class PageController extends AdminController
{
    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Grid::make(new Page(), function (Grid $grid) {
            $grid->setActionClass(Grid\Displayers\Actions::class);
            $grid->showColumnSelector();
            $grid->column('title');
            $grid->order->orderable();
            $grid->column('permalink')->label('default');
            $grid->column('status')->using(NewsCategory::$activeMap)->badge(NewsCategory::$statusColor);
            $grid->column('updated_at')->sortable();
            $grid->column('添加子页面')->display(function () {
                return ' <a href="' . admin_route('pages.create', ['page_id' => $this->id]) . '" class="btn btn-sm btn-outline-info" target="_blank">添加</a>';
            });
            // 筛选
            $grid->filter(function (Grid\Filter $filter) {
                $filter->disableIdFilter();
                $filter->like('title');
                $filter->equal('permalink');
                $filter->equal('status', '状态')->radio(NewsCategory::$activeMap);
            });
            // 导出数据
            $exportDataColumn = [
                'title'      => '标题',
                'permalink'  => '链接',
                'content'    => '内容',
                'sort_order' => '排序',
                'status'     => '状态',
                'created_at' => '创建时间',
                'updated_at' => '更新时间'
            ];
            $grid->export($exportDataColumn)->rows(function(array $rows){
                foreach ($rows as $index => &$row) {
                    $row['status'] = config('array.active')[$row['status']];
                }
                return $rows;
            })->filename('页面列表')->xlsx();
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
        return Show::make($id, new Page(), function (Show $show) {
            $show->field('title');
            $show->parent_id()->as(function () {
                if($this->parent_id){
                    $find_parent = PageModels::find($this->parent_id);
                    $show_text = '';
                    if($find_parent){
                        $show_text = json_decode($find_parent, true)['title'];
                    }
                    return $show_text;
                }
            });
            $show->field('permalink')->label('default');
            $show->field('content')->unescape();
            $show->field('seo_title');
            $show->field('seo_keywords');
            $show->field('seo_description');
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
        return Form::make(new Page(), function (Form $form) {
            if (request('page_id')) {
                $page = PageModels::find(request('page_id'));
                $form->display('parent_id', '父级')->default($page->title);
                $form->hidden('parent_id')->default(request('page_id'));
            } else {
                $form->select('parent_id', '父级ID')->options(PageModels::selectOptions())->required();
            }
            $form->text('title')->required();
            $form->text('permalink')->required();
            $form->editor('content')->imageDirectory('editor/images')->height('600');
            $form->number('sort_order')->default(0);
            $form->text('seo_title');
            $form->text('seo_keywords');
            $form->textarea('seo_description');
            $form->switch('status');
        });
    }
}
