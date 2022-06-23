<?php

namespace App\Http\Controllers\Api;

use App\Models\Page;
use App\Http\Resources\PageResource;
use Jiannei\Response\Laravel\Support\Facades\Response;

class PageController extends ApiController
{
    public function index($permalink)
    {
        $result = Page::where('permalink', $permalink)->first();
        if($result){
            return Response::success(new PageResource($result), '请求成功');
        }
        Response::errorBadRequest('暂无该页面');
    }
}
