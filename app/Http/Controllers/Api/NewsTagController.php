<?php

namespace App\Http\Controllers\Api;

use App\Models\NewsTag;
use Illuminate\Http\Request;
use App\Http\Resources\NewsTagResource;
use App\Http\Resources\NewsTagCollection;
use Jiannei\Response\Laravel\Support\Facades\Response;

class NewsTagController extends ApiController
{
    public function list(Request $request)
    {
        $limit = $request->input('limit', 20);
        $search = NewsTag::where('status', 1)
            ->orderBy('created_at', 'desc')
            ->paginate($limit);
        return Response::success(new NewsTagCollection($search), '请求成功');
    }
    public function detail($id)
    {
        $result = NewsTag::find($id);
        if ($result) {
            return Response::success(new NewsTagResource($result), '请求成功');
        }
        Response::errorBadRequest('暂无数据');
    }
}
