<?php

namespace App\Admin\Actions\Imports;

use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use App\Models\News;
use App\Models\NewsCategory;
use App\Models\NewsTag;

class NewsImport implements ToModel, WithHeadingRow, WithMultipleSheets
{
    private $_successRows = 0;
    private $_failedRows = 0;

    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        // 跳过空
        if (!isset($row['标题'])) {
            ++$this->_failedRows;
            return null;
        }

        //查询是否存在，存在就不写入
        $news = News::where('title', $row['标题'])->first();
        if ($news) {
            ++$this->_failedRows;
            return null;
        }
        ++$this->_successRows;

        // 分类
        $category = NewsCategory::firstOrCreate([ 'title' => $row['分类'] ], [ 'status' => 1 ]);

        // 标签
        $tags = explode(",", $row['标签']);
        $tag_ids = [];
        foreach ($tags as $tag) {
            $searchTag = NewsTag::firstOrCreate([ 'title' => $tag ], [ 'status' => 1 ]);
            $tag_ids[] = $searchTag->id;
        }

        $newNews = News::create([
            'title' => $row['标题'],
            'news_category_id' => $category->id,
            'banner_url' => $row['头图'],
            'excerpt' => $row['简介'],
            'content' => $row['内容'],
            'read_count' => $row['阅读量'],
            'is_recommend' => $row['是否推荐'] === '是' ? '1' : '0',
            'status' => 1
        ]);
        $newNews->tags()->sync($tag_ids);

    }

    /**
     * 支持有多个sheet的excel文件，避免因多sheet产生导入错误
     *
     * @return array
     */
    public function sheets(): array
    {
        return [
            0 => $this,
        ];
    }

    /**
     * 成功条数
     * @return int
     */
    public function getSuccessRows(): int
    {
        return $this->_successRows;
    }

    /**
     * 失败条数
     * @return int
     */
    public function getFailedRows(): int
    {
        return $this->_failedRows;
    }
}
