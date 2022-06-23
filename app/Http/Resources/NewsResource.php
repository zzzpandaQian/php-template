<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;


class NewsResource extends JsonResource
{
    /**
     * Undocumented function
     *
     * @param [type] $request
     * @return void
     */
    public function toArray($request)
    {
        return [
            'id'            => $this->id,
            'title'         => $this->title,
            'news_category' => new NewsCategoryResource($this->category),
            'news_tags'     => NewsTagResource::collection($this->tags),
            'banner_url'    => $this->full_banner_url,
            'excerpt'       => $this->excerpt,
            'content'       => $this->content,
            'read_count'    => $this->read_count,
            'is_recommend'  => $this->is_recommend,
            'status'        => $this->status,
            'created_at'    => optional($this->created_at)->toDateTimeString(),
            'updated_at'    => optional($this->updated_at)->toDateTimeString(),
        ];
    }
}
