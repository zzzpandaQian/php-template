<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Version;
use App\Http\Resources\VersionResource;
use App\Http\Resources\VersionCollection;
use Jiannei\Response\Laravel\Support\Facades\Response;

class VersionController extends Controller
{
    /**
     * 版本信息
     *
     * @return void
     */
    public function get_version(Request $request)
    {
        $result = Version::where('disabled', 0)->orderBy('created_at', 'desc')->first();
        return Response::success(new VersionResource($result), '请求成功');
    }
    public function get_all_version(Request $request)
    {
        // $result = Version::where('disabled', 0)->orderBy('created_at', 'asc')->paginate(10);
        $result = Version::where('disabled', 0)->orderBy('created_at', 'asc')->get();
        return Response::success(new VersionCollection($result), '请求成功');
    }
}
