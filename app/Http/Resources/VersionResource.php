<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class VersionResource extends JsonResource
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
            'version' => $this -> version,
            'file' => $this -> file,
            'disabled' => $this -> disabled,
            'created_at'        => optional($this->created_at)->toDateTimeString(),
            'updated_at'        => optional($this->updated_at)->toDateTimeString(),
        ];
    }
}
