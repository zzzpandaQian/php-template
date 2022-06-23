<?php

namespace App\Models;

use Dcat\Admin\Traits\HasDateTimeFormatter;
use Dcat\Admin\Traits\ModelTree;
use Illuminate\Database\Eloquent\Model;

class NewsCategory extends Model
{
	use HasDateTimeFormatter, ModelTree;
    protected $table = 'news_categories';

    protected $fillable = [
        'parent_id',
        'title',
        'sort_order',
        'status',
    ];

    protected $orderColumn = 'sort_order';
    protected $parentColumn = 'parent_id';

    public function parent()
    {
        return $this->belongsTo(NewsCategory::class, 'parent_id');
    }
}
