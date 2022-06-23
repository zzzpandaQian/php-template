<?php

namespace App\Models;

use Dcat\Admin\Traits\HasDateTimeFormatter;

use Illuminate\Database\Eloquent\Model;

class NewsTag extends Model
{
	use HasDateTimeFormatter;
    protected $table = 'news_tags';

    protected $fillable = [
        'id',
        'title',
        'status',
    ];
}
