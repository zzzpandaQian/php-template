<?php

namespace App\Http\Resources;
use Illuminate\Http\Resources\Json\ResourceCollection;

class NewsCollection extends ResourceCollection
{
    public function toArray($request)
    {
        return $this->collection->map(function ($item) {
            return [
                'id'            => $item->id,
                'title'         => $item->title,
                'news_category' => new NewsCategoryResource($item->category),
                'news_tags'     => NewsTagResource::collection($item->tags),
                'banner_url'    => $item->full_banner_url,
                'excerpt'       => $item->excerpt,
                'content'       => $item->content,
                'read_count'    => $item->read_count,
                'is_recommend'  => $item->is_recommend,
                'status'        => $item->status,
                'created_at'    => optional($item->created_at)->toDateTimeString(),
                'updated_at'    => optional($item->updated_at)->toDateTimeString(),
            ];
        })->all();
    }
}
