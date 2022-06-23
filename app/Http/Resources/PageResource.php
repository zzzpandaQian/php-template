<?php

namespace App\Http\Resources;

use App\Models\Page;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\App;

class PageResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id'              => $this->id,
            'title'           => $this->title,
            'content'         => $this->content,
            'permalink'       => $this->permalink,
            'sort_order'      => $this->sort_order,
            'status'          => $this->status,
            'seo_title'       => $this->seo_title,
            'seo_keywords'    => $this->seo_keywords,
            'seo_description' => $this->seo_description,
            'created_at'      => optional($this->created_at)->toDateTimeString(),
            'updated_at'      => optional($this->updated_at)->toDateTimeString(),
        ];
    }
}
