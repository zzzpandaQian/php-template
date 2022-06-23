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
}
