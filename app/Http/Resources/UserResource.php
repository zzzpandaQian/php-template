<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;


class UserResource extends JsonResource
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
            'id'          => $this->id,
            'name'        => $this->name,
            'mobile'      => $this->mobile,
            'email'       => $this->email,
            'gender'      => $this->gender,
            'birthdate'   => $this->birthdate,
            'avatar'      => $this->avatar,
            'address'     => $this->address,
            'language'     => $this->language,
            'nickname'     => $this->nickname,
            'wx_nickname' => $this->wx_nickname,
            'wx_avatar'   => $this->wx_avatar,
            'wx_openid'   => $this->wx_openid,
            'xcx_openid'  => $this->xcx_openid,
            'unionid'     => $this->unionid,
            'created_at' => optional($this->created_at)->toDateTimeString(),
            'updated_at' => optional($this->updated_at)->toDateTimeString(),
        ];
    }
}
