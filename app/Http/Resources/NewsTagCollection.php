<?php

namespace App\Http\Resources;
use Illuminate\Http\Resources\Json\ResourceCollection;

class NewsTagCollection extends ResourceCollection
{
    public function toArray($request)
    {
        return $this->collection->map(function ($item) {
            return [
                'id'            => $item->id,
                'title'         => $item->title,
                'status'        => $item->status,
                'created_at'    => optional($item->created_at)->toDateTimeString(),
                'updated_at'    => optional($item->updated_at)->toDateTimeString(),
            ];
        })->all();
    }
}
