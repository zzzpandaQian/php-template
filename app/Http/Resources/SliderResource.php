<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SliderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'title'             => $this->title,
            'image_url'         => $this->full_image_url,
            'description'       => $this->description,
            'has_button'        => $this->has_button,
            'button_link_url'   => $this->button_link_url,
            'is_light'          => $this->is_light,
            'position'          => $this->position,
            'sort_order'        => $this->sort_order,
            'status'            => $this->status,
            'created_at'        => optional($this->created_at)->toDateTimeString(),
            'updated_at'        => optional($this->updated_at)->toDateTimeString(),
        ];
    }
}
