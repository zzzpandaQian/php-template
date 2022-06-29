<?php

namespace App\Models;

use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Dcat\Admin\Traits\HasDateTimeFormatter;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasDateTimeFormatter, HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'id',
        'name',
        'mobile',
        'email',
        'password',
        'gender',
        'birthdate',
        'avatar',
        'language',
        'nickname',
        'address',
        'wx_nickname',
        'wx_avatar',
        'wx_openid',
        'xcx_openid',
        'unionid',
        'oauth_scope',
        'status',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * 激活的用户
     *
     */
    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }

    public function getFullAvatarUrlAttribute()
    {
        return getImageUrl($this->avatar);
    }

    public function getFullWxAvatarUrlAttribute()
    {
        return getImageUrl($this->wx_avatar);
    }
}
