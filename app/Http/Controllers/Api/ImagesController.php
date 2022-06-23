<?php
namespace App\Http\Controllers\Api;

use Image;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\ApiController;
use Jiannei\Response\Laravel\Support\Facades\Response;

class ImagesController extends ApiController
{
    public function index(Request $request)
    {
        // 自动裁图，覆盖原图
        $use_crop = false;

        $type = $request->input('type') ? $request->input('type') : 'others';
        $index = $request->input('index') ? $request->input('index') : '0';
        $allowed_ext = ["png", "jpg", "gif", 'jpeg'];
        $folder_name = "images/$type/" . date("Ym/d", time());
        $upload_path = public_path('storage') . '/' . $folder_name;

        $image_path = '';
        if ($request->file('image')) {
            $file = $request->file('image');

            // 获取文件的后缀名，因图片从剪贴板里黏贴时后缀名为空，所以此处确保后缀一直存在
            $extension = strtolower($file->getClientOriginalExtension()) ?: 'png';

            // 如果上传的不是图片将终止操作
            if (!in_array($extension, $allowed_ext)) {
                return false;
            }

            $filename = time() . '_' . Str::random(10) . '.' . $extension;
            $image_path = $file->storeAs($folder_name, $filename, 'public');

            if ($use_crop) {
                $image = Image::make($upload_path . '/' . $filename);
                $image->resize(1000, null, function ($constraint) {
                    $constraint->aspectRatio(); // 按设定宽度，高度等比例缩放
                    $constraint->upsize(); // 防止裁图时图片尺寸变大
                });
                $image->save();
            }
            $full_image = \Storage::disk('public')->url($image_path);

            $return_data = [
                'image' => $image_path,
                'full_image' => $full_image,
                'index' => $index
            ];
            return Response::success($return_data);
        }
    }
}
