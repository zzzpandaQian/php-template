<?php

namespace App\Http\Controllers\Api;

use App\Models\Slider;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\SliderResource;
use App\Http\Resources\SliderCollection;
use Jiannei\Response\Laravel\Support\Facades\Response;

class SliderController extends Controller
{

    /**
     * 滑块列表
     *
     * @param Request $request
     * @return void
     */
    public function list(Request $request)
    {
        $limit = $request->input('limit', 5);
        $result = Slider::where('status', 1)
            ->paginate($limit);

        return Response::success(new SliderCollection($result), '请求成功');
    }

    /**
     * 滑块详情
     *
     * @param [type] $id
     * @return void
     */
    public function detail($id)
    {
        $result = Slider::find($id);
        if ($result) {
            return Response::success(new SliderResource($result), '请求成功');
        }
        Response::errorBadRequest('暂无数据');
    }
}
