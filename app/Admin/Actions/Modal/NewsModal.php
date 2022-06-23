<?php

namespace App\Admin\Actions\Modal;

use App\Admin\Actions\Form\NewsForm;
use Dcat\Admin\Admin;
use Dcat\Admin\Grid\Tools\AbstractTool;
use Dcat\Admin\Traits\HasPermissions;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;


class NewsModal extends AbstractTool
{
    /**
     * @return string
     */

    public function render()
    {
        // 模态窗
        $this->modal('upload-modal');
        return <<<HTML
        <button class="btn btn-primary btn-outline grid-expand" data-toggle="modal" data-target="#upload-modal">
            <i class="feather icon-upload"></i><span class="d-none d-sm-inline">&nbsp;&nbsp;导入新闻</span>
        </button>
        HTML;
    }

    protected function modal($id)
    {
        $form = new NewsForm();
        $downloadUrl = asset('download/News.xlsx');
        Admin::script('Dcat.onPjaxComplete(function () {
            $(".modal-backdrop").remove();
            $("body").removeClass("modal-open");
        }, true)');

        // 通过 Admin::html 方法设置模态窗HTML
        Admin::html(
            <<<HTML
            <div class="modal fade" id="{$id}">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">导入数据</h4>
                    <a href="{$downloadUrl}" class="btn btn-sm btn-primary" target="_blank" style="margin-left: 20px">
                        <i class="feather icon-download"></i>下载模板
                    </a>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    {$form->render()}
                </div>
                </div>
            </div>
            </div>
            HTML
        );
    }

    /**
     * @param Model|Authenticatable|HasPermissions|null $user
     *
     * @return bool
     */
    protected function authorize($user): bool
    {
        return true;
    }

    /**
     * @return array
     */
    protected function parameters()
    {
        return [];
    }
}