<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{

    protected $fillable = [
        'id',
        'title',
        'image_url',
        'button_link_url',
        'description',
        'status',
        'has_button',
        'is_light',
        'position',
        'sort_order',
    ];

    public function getFullImageUrlAttribute()
    {
        return getImageUrl($this->image_url);
    }

}
