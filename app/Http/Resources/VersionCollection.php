<?php

namespace App\Http\Resources;
use Illuminate\Http\Resources\Json\ResourceCollection;

class VersionCollection extends ResourceCollection
{
    public function toArray($request)
    {
        return $this->collection->map(function ($item) {
            return [
                'id'            => $item->id,
                'disabled'         => $item->disabled,
                'file'        => \Storage::disk('public')->url($item->file),
                'version'        => $item->version,
                'created_at'    => optional($item->created_at)->toDateTimeString(),
                'updated_at'    => optional($item->updated_at)->toDateTimeString(),
            ];
        })->all();
    }
}
