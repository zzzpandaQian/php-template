<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\FileController;
use App\Http\Controllers\Api\NewsController;
use App\Http\Controllers\Api\PageController;
use App\Http\Controllers\Api\TestController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\ImagesController;
use App\Http\Controllers\Api\SliderController;
use App\Http\Controllers\Api\NewsTagController;
use App\Http\Controllers\Api\NewsCategoryController;
use App\Http\Controllers\Api\VersionController;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::namespace('Api')->group(function () {

    /*
    * 授权登录
    */
    Route::group(['prefix' => 'auth'], function () {
        // 假冒登录
        Route::get('test', [AuthController::class, 'test']);

        // 手机号密码登录
        Route::post('mobile/password/login', [AuthController::class, 'mobilePasswordLogin']);

        // 邮箱密码登录
        Route::post('email/password/login', [AuthController::class, 'emialPasswordLogin']);

        // 小程序授权
        Route::post('xcx', [AuthController::class, 'xcxAuth']);

        // 小程序绑定手机
        Route::post('xcx/bind/mobile', [AuthController::class, 'xcxBindMobile']);

        // 微信H5授权
        Route::get('wx', [AuthController::class, 'wxAuth']);

        // 微信绑定手机
        Route::post('wx/bind/mobile', [AuthController::class, 'wxBindMobile']);

        // 登出
        Route::middleware('auth:sanctum')->group(function () {
            Route::get('logout', [AuthController::class, 'logout']);
        });
    });

    /*
    * 需要授权登录
    */
    Route::middleware('auth:sanctum')->group(function () {
        /*
        * 用户
        */
        Route::group(['prefix' => 'user'], function () {
            // 用户列表
            Route::get('list', [UserController::class, 'list']);

            // 用户详情
            Route::get('detail', [UserController::class, 'detail']);

            // 用户编辑
            Route::post('edit', [UserController::class, 'edit']);

            // 用户删除
            Route::get('delete', [UserController::class, 'delete']);
        });

    });

    // jssdk
    Route::get('jssdk', [AuthController::class, 'jssdk']);

    /*
     * 新闻
     */
    // 新闻列表
    Route::get('/news/list', [NewsController::class, 'list']);

    // 新闻详情
    Route::get('/news/{id}/detail', [NewsController::class, 'detail']);

    // 推荐新闻
    Route::get('/news/recommend', [NewsController::class, 'recommend']);

    // 新闻分类列表
    Route::get('/news-category/list', [NewsCategoryController::class, 'list']);

    // 新闻分类详情
    Route::get('/news-category/{id}/detail', [NewsCategoryController::class, 'detail']);

    // 新闻标签列表
    Route::get('/news-tag/list', [NewsTagController::class, 'list']);

    // 新闻标签详情
    Route::get('/news-tag/{id}/detail', [NewsTagController::class, 'detail']);

    // 滑块列表
    Route::get('/sliders/list', [SliderController::class, 'list']);

    // 滑块详情
    Route::get('/slider/{id}/detail', [SliderController::class, 'detail']);

    /*
     * 上传
     */
    // 上传图片
    Route::post('images', [ImagesController::class, 'index']);

    // 上传文件
    Route::post('upload', [FileController::class, 'index']);

    // 页面
    Route::get('/page/{permalink}', [PageController::class, 'index']);
    Route::get('/test', [TestController::class, 'index']);

    // 获取版本信息
    Route::get('/version/get', [VersionController::class, 'get_version']);

    // 获取所有版本
    Route::get('/version/get_all', [VersionController::class, 'get_all_version']);
});
