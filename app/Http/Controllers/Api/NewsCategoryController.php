<?php

namespace App\Http\Controllers\Api;

use App\Models\NewsCategory;
use Illuminate\Http\Request;
use App\Http\Resources\NewsCategoryResource;
use App\Http\Resources\NewsCategoryCollection;
use Jiannei\Response\Laravel\Support\Facades\Response;

class NewsCategoryController extends ApiController
{
    public function list(Request $request)
    {
        $limit = $request->input('limit', 20);
        $search = NewsCategory::where('status', 1)
            ->orderBy('created_at', 'desc')
            ->paginate($limit);
        return Response::success(new NewsCategoryCollection($search), '请求成功');
    }
    public function detail($id)
    {
        $result = NewsCategory::find($id);
        if ($result) {
            return Response::success(new NewsCategoryResource($result), '请求成功');
        }
        Response::errorBadRequest('暂无数据');
    }
}
