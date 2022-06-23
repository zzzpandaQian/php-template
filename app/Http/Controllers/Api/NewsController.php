<?php

namespace App\Http\Controllers\Api;

use App\Models\News;
use Illuminate\Http\Request;
use App\Http\Resources\NewsResource;
use App\Http\Resources\NewsCollection;
use Jiannei\Response\Laravel\Support\Facades\Response;

class NewsController extends ApiController
{
    public function list(Request $request)
    {
        $limit = $request->input('limit', 20);
        $category_id = $request->input('category_id');
        $tag_id = $request->input('tag_id');
        $search = News::where('status', 1)
            ->when($category_id, function ($query) use ($category_id) {
                return $query->where('news_category_id', $category_id);
            })
            ->when($tag_id, function ($query) use ($tag_id) {
                return $query->whereHas('tags', function ($query) use ($tag_id) {
                    $query->where('news_tag_id', $tag_id);
                });
            })
            ->orderBy('created_at', 'desc')
            ->paginate($limit);
        return Response::success(new NewsCollection($search), '请求成功');
    }

    public function detail($id)
    {
        $result = News::find($id);
        if ($result) {
            return Response::success(new NewsResource($result), '请求成功');
        }
        Response::errorBadRequest('暂无数据');
    }

    public function recommend()
    {
        $result = News::where('is_recommend', 1)->where('status', 1)->get();
        if ($result) {
            return Response::success(new NewsCollection($result), '请求成功');
        }
        Response::errorBadRequest('暂无数据');
    }
}
