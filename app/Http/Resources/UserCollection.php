<?php

namespace App\Http\Resources;
use Illuminate\Http\Resources\Json\ResourceCollection;

class UserCollection extends ResourceCollection
{
    public function toArray($request)
    {
        return $this->collection->map(function ($item) {
            return [
            'id'          => $item->id,
            'name'        => $item->name,
            'mobile'      => $item->mobile,
            'email'       => $item->email,
            'gender'      => $item->gender,
            'birthdate'   => $item->birthdate,
            'avatar'      => $item->avatar,
            'address'     => $item->address,
            'wx_nickname' => $item->wx_nickname,
            'wx_avatar'   => $item->wx_avatar,
            'wx_openid'   => $item->wx_openid,
            'xcx_openid'  => $item->xcx_openid,
            'unionid'     => $item->unionid,
                'created_at' => optional($item->created_at)->toDateTimeString(),
                'updated_at' => optional($item->updated_at)->toDateTimeString(),
            ];
        })->all();
    }
}
