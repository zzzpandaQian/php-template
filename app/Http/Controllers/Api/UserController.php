<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Resources\UserResource;
use App\Http\Resources\UserCollection;
use App\Http\Controllers\Api\ApiController;
use Jiannei\Response\Laravel\Support\Facades\Response;

class UserController extends ApiController
{
    /**
     * 用户列表
     *
     * @return void
     */
    public function list(Request $request)
    {
        $limit = $request->input('limit', 10);
        $role = $request->input('role');
        $user = User::where('status', 1)
            ->when($role, function ($query) use ($role) {
                return $query->where('role', $role);
            })
            ->orderBy('created_at', 'desc')
            ->paginate($limit);
        return Response::success(new UserCollection($user), '请求成功');
    }

    /**
     * 用户详情
     *
     * @return void
     */
    public function detail(Request $request)
    {
        $user = $request->user();
        return Response::success(new UserResource($user), '请求成功');
    }

    /**
     * 用户编辑
     *
     * @param Request $request
     * @return void
     */
    public function edit(Request $request)
    {
        $user = $request->user();
        $inputs = $request->all();
        if ($request->avatar) {
            User::where('id', $user->id)->update($inputs);
        } else {
            unset($inputs['avatar']);
            User::where('id', $user->id)->update($inputs);
        }
        return Response::ok('修改成功');
    }

    /**
     * 用户删除
     *
     * @param Request $request
     * @return void
     */
    public function delete(Request $request)
    {
        $user = $request->user();
        user::find($user->id)->delete();
        return Response::ok('注销成功');
    }

    /**
     * 更改用户语言
     *
     * @param Request $request
     * @return void
     */
    public function changeLanguage(Request $request)
    {
        $user = $request->user();
        // $inputs = $request->all();
        $language = $request->language;
        User::where('id', $user->id)->update(['language' => $language]);
        return Response::ok('修改成功');
    }

    /**
     * 昵称校验
     */
    public function validateName(Request $request)
    {
        $name = $request->name;
        if (User::where('name', $name)->first()) {
            return Response::ok('用户已存在');
        } else {
            return Response::ok('用户不存在');
        }
    }

    /**
     * 用户注册
     */
    public function register(Request $request)
    {
        $inputs = $request->all();
        if (User::where('name', $inputs['name'])->first()) {
            return response::ok('用户已存在', 203);
        } else {
            $inputs['password'] = md5($inputs['password']);
            $inputs['nickname'] = '用户名' . time();
            $inputs['status'] = 1;
            $user = User::create($inputs);
            return Response::success($user, '注册成功');
        }
    }
    /**
     * 用户登录
     */
    public function login(Request $request)
    {
        $name = $request->name;
        $password = md5($request->password);
        $user = User::where('name', $name)->first();
        if (!$user || $password !== $user->password) {
            Response::errorBadRequest('用户或密码不正确');
        }
        if ($user->status === 0) {
            Response::errorBadRequest('用户未激活');
        }
        $token = $user->createToken('token-name');
        if(!$user->avatar){
            $user['avatar'] = \Storage::disk('public')->url('images/default-avatar.jpg');
        }
        return Response::success([
            'user' => new UserResource($user),
            'token' => $token->plainTextToken
        ], '登陆成功');
    }
}
