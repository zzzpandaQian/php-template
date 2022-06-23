<?php

namespace App\Models;

use Dcat\Admin\Traits\HasDateTimeFormatter;

use Illuminate\Database\Eloquent\Model;

class NewsWithTag extends Model
{
	use HasDateTimeFormatter;
    protected $table = 'news_with_tags';
    
}
