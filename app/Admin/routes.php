<?php

use Dcat\Admin\Admin;
use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Route;
use App\Admin\Controllers\StatisticController;

Admin::routes();

Route::group([
    'prefix'     => config('admin.route.prefix'),
    'namespace'  => config('admin.route.namespace'),
    'middleware' => config('admin.route.middleware'),
], function (Router $router) {
    $router->get('/', 'HomeController@index');
    $router->resource('users', 'UserController');
    $router->resource('pages', 'PageController');
    $router->resource('news', 'NewsController');
    $router->resource('news-categories', 'NewsCategoryController');
    $router->resource('news-tags', 'NewsTagController');
    $router->resource('sliders', 'SliderController');
    $router->resource('users-with-pwd', 'UsersWithPwdController');
    $router->resource('version', 'VersionController');

    $router->get('statistic-recommends', [StatisticController::class, 'recommend']);
});
