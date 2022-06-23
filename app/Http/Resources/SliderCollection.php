<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class SliderCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return $this->collection->map(function ($item) {
            return [
                'id'                => $item->id,
                'title'             => $item->title,
                'image_url'         => $item->full_image_url,
                'description'       => $item->description,
                'has_button'        => $item->has_button,
                'button_link_url'   => $item->button_link_url,
                'is_light'          => $item->is_light,
                'position'          => $item->position,
                'sort_order'        => $item->sort_order,
                'status'            => $item->status,
                'created_at'        => optional($item->created_at)->toDateTimeString(),
                'updated_at'        => optional($item->updated_at)->toDateTimeString(),
            ];
        })->all();
    }
}
