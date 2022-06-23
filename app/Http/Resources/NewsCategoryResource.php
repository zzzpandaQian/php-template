<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;


class NewsCategoryResource extends JsonResource
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
            'parent'        => $this->parent_id != 0 ? new NewsCategoryResource($this->parent) : '',
            'title'         => $this->title,
            'sort_order'    => $this->sort_order,
            'status'        => $this->status,
            'created_at'    => optional($this->created_at)->toDateTimeString(),
            'updated_at'    => optional($this->updated_at)->toDateTimeString(),
        ];
    }
}
