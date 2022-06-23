<?php

namespace App\Admin\Controllers;

use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Show;
use App\Models\NewsTag;
use App\Admin\Repositories\News;
use App\Models\News as NewsModels;
use App\Admin\Repositories\NewsCategory;
use App\Models\NewsCategory as CategoryModels;
use App\Admin\Actions\Modal\NewsModal;
use Dcat\Admin\Http\Controllers\AdminController;

class NewsController extends AdminController
{
    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Grid::make(News::with(['category', 'tags']), function (Grid $grid) {
            $grid->column('id')->sortable();
            $grid->column('title');
            $grid->column('category.title', '新闻分类');
            $grid->tags('新闻标签')->pluck('title')->label();
            $grid->column('read_count');
            $grid->column('is_recommend')->using(NewsCategory::$statusMap)->badge(NewsCategory::$statusColor);
            $grid->column('status')->using(NewsCategory::$activeMap)->badge(NewsCategory::$statusColor);
            $grid->column('created_at');
            $grid->column('updated_at')->sortable();
            $grid->filter(function (Grid\Filter $filter) {
                $filter->like('title');
                $filter->equal('news_category_id', '新闻分类')->select(CategoryModels::all()->pluck('title', 'id'));
                $filter->where('tag_title', function ($query) {
                    $query->whereHas('tags', function ($query) {
                        $query->whereIn('tags.id', $this->input);
                    });
                }, '标签')->multipleSelect(NewsTag::all()->pluck('title', 'id'));
                $filter->equal('is_recommend', '推荐')->radio(NewsCategory::$statusMap);
                $filter->equal('status', '状态')->radio(NewsCategory::$activeMap);
            });

            // 导出数据
            $exportDataColumn = [
                'title'        => '标题',
                'category'     => '分类',
                'tags'         => '标签',
                'banner_url'   => '头图',
                'excerpt'      => '简介',
                'content'      => '内容',
                'read_count'   => '阅读量',
                'is_recommend' => '是否推荐',
                'status'       => '状态',
                'created_at'   => '创建时间',
                'updated_at'   => '更新时间'
            ];
            $grid->export($exportDataColumn)->rows(function (array $rows) {
                foreach ($rows as $index => &$row) {
                    $current = NewsModels::find($row['id']);
                    $row['category'] = implode(',', $current->category()->pluck('title')->toArray());
                    $row['tags'] = implode(',', $current->tags()->pluck('title')->toArray());
                    $row['is_recommend'] = NewsCategory::$statusMap[$row['is_recommend']];
                    $row['status'] = NewsCategory::$activeMap[$row['status']];
                }
                return $rows;
            })->filename('新闻列表')->xlsx();

            // 导入数据
            $grid->tools(function (Grid\Tools $tools) {
                $tools->append(new NewsModal());
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
        return Show::make($id, new News(['category', 'tags']), function (Show $show) {
            $show->field('title');
            $show->field('category.title', '新闻分类');
            $show->tags('新闻标签')->pluck('title')->explode()->label();
            $show->field('banner_url')->image();
            $show->field('excerpt');
            $show->field('content')->unescape();
            $show->field('read_count');
            $show->field('is_recommend')->using(NewsCategory::$statusMap)->dot(NewsCategory::$statusColor);
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
        return Form::make(News::with('tags'), function (Form $form) {
            $form->text('title')->required();
            $form->select('news_category_id')->options(CategoryModels::all()->pluck('title', 'id'))->required();
            $form->multipleSelect('tags', '新闻标签')
            ->options(NewsTag::all()->pluck('title', 'id'))
            ->customFormat(function ($v) {
                if (!$v) {
                    return [];
                }
                return array_column($v, 'id');
            });
            $form->image('banner_url')->move('news/banner')->help("建议尺寸：600x800")->autoUpload();
            $form->textarea('excerpt');
            $form->editor('content')->imageDirectory('editor/images')->height('600');
            $form->number('read_count');
            $form->switch('is_recommend');
            $form->switch('status');
            $form->display('created_at');
            $form->display('updated_at');
        });
    }
}
