<?php

namespace App\Models;

use Dcat\Admin\Traits\ModelTree;
use Spatie\EloquentSortable\Sortable;
use Illuminate\Database\Eloquent\Model;
use Dcat\Admin\Traits\HasDateTimeFormatter;

class Page extends Model implements Sortable
{
    use HasDateTimeFormatter, ModelTree;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'seo_title',
        'seo_keywords',
        'seo_description',
        'parent_id',
        'sort_order',
        'permalink',
        'content',
        'status',
    ];
    public $translatedAttributes = ['title', 'content'];

    protected $table = 'pages';
    protected $titleColumn = 'title';
    protected $orderColumn = 'sort_order';
    protected $parentColumn = 'parent_id';
}
