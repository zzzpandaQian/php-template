<?php

namespace App\Http\Resources;
use Illuminate\Http\Resources\Json\ResourceCollection;

class NewsCategoryCollection extends ResourceCollection
{
    public function toArray($request)
    {
        return $this->collection->map(function ($item) {
            return [
                'id'            => $item->id,
                'parent'        => $item->parent_id != 0 ? new NewsCategoryResource($item->parent) : '',
                'title'         => $item->title,
                'sort_order'    => $item->sort_order,
                'status'        => $item->status,
                'created_at'    => optional($item->created_at)->toDateTimeString(),
                'updated_at'    => optional($item->updated_at)->toDateTimeString(),
            ];
        })->all();
    }
}
