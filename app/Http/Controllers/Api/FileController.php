<?php
namespace App\Http\Controllers\Api;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\ApiController;
use Jiannei\Response\Laravel\Support\Facades\Response;

class FileController extends ApiController
{
    public function index(Request $request)
    {
        // $allowed_ext = ["txt", "doc", "png", "jpg", "pcm", "aac", "mp3", "wav"];
        $index = $request->input('index') ? $request->input('index') : '0';
        $folder_name = "upload-file/" . date("Ym/d", time());
        $file_path = '';
        if ($request->file('file')) {
            $file = $request->file('file');
            // 获取文件的后缀名
            $extension = strtolower($file->getClientOriginalExtension()) ?: '';
            // 判断是否是允许传入的格式
            // if (!in_array($extension, $allowed_ext)) {
            //     return false;
            // }
            $filename = time() . '_' . Str::random(10) . '.' . $extension;
            $file_path = $file->storeAs($folder_name, $filename, 'public');
        }
        $return_data = [
            'file' => $file_path,
            'index' => $index
        ];
        return Response::success($return_data);
    }
}
