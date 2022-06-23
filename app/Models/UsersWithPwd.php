<?php

namespace App\Models;

use Dcat\Admin\Traits\HasDateTimeFormatter;

use Illuminate\Database\Eloquent\Model;

class UsersWithPwd extends Model
{
	use HasDateTimeFormatter;
    protected $table = 'users_with_pwd';

    protected $fillable = [
        'id',
        'username',
        'password',
        'gender',
        'nickname',
        'email',
        'mobile',
        'user_id',
        'birth',
        'avatar',
    ];
    protected $hidden = [
        'password',
        'remember_token',
    ];
}
