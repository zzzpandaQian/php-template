<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Validator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // 前端页面使用Bootstrap分页导航格式
        Paginator::useBootstrap();

        // 验证手机号
        Validator::extend('zh_mobile', function ($attribute, $value) {
            return preg_match('/^(\+?0?86\-?)?((13\d|14[57]|15[^4,\D]|166|17[01235678]|18\d|19[89])\d{8})$/', $value);
        });

        // 注册校验密码
        Validator::extend('current_password', function ($attribute, $value, $parameters, $validator) {
            $user = User::find($parameters[0]);
            return $user && Hash::check($value, $user->password);
        });
    }
}
