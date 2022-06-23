<?php

namespace App\Admin\Actions\Form;

use App\Admin\Actions\Imports\NewsImport;
use Dcat\Admin\Widgets\Form;
use Maatwebsite\Excel\Facades\Excel;

class NewsForm extends Form
{
    public function handle(array $input)
    {
        try {
            //上传文件位置，这里默认是在storage中，如有修改请对应替换
            $file = storage_path('/app/public/' . $input['file']);
            $import = new NewsImport;
            Excel::import($import, $file);
            return $this->response()->success('数据已导入' . $import->getSuccessRows() . '行，未导入' . $import->getFailedRows() . '行')->refresh();
        } catch (\Exception $e) {
            return $this->response()->error($e->getMessage());
        }
    }

    public function form()
    {
        $this->file('file', '上传数据（Excel）')->rules('required', ['required' => '文件不能为空'])->move('import/upload/')->autoUpload();
    }

}
