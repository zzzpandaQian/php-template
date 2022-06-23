<?php

namespace App\Models;

use Dcat\Admin\Traits\HasDateTimeFormatter;

use Illuminate\Database\Eloquent\Model;

class News extends Model
{
	use HasDateTimeFormatter;
    protected $fillable = [
        'title',
        'news_category_id',
        'banner_url',
        'excerpt',
        'content',
        'read_count',
        'is_recommend',
        'status'
    ];

    public function getFullBannerUrlAttribute()
    {
        return getImageUrl($this->banner_url, 'news');
    }

    public function category()
    {
        return $this->belongsTo(NewsCategory::class, 'news_category_id');
    }

    public function tags()
    {
        return $this->belongsToMany(NewsTag::class, 'news_with_tags', 'news_id', 'news_tag_id')->withTimestamps();
    }
}
