<?php

namespace App\Admin\Extensions\Tools;

use Encore\Admin\Admin;
use Encore\Admin\Grid;
use Encore\Admin\Grid\Tools\AbstractTool;
use Illuminate\Support\Facades\Request;

class ImportButton extends AbstractTool
{

    /**
     * Set up script for import button.
     */
    protected function setUpScripts()
    {
        $script = <<<SCRIPT

function handleFileSelect(evt) {
    var file = evt.target.files; // FileList object

    document.getElementById('input').style.display="none";
    document.getElementById('confirm').style.display="block";
}

document.getElementById('files').addEventListener('change', handleFileSelect, false);

$('#confirm').on('click', function() {

    var formData = new FormData();
    if ($("input[name='csvfile']").val()!== '') {
        formData.append( "file", $("input[name='csvfile']").prop("files")[0] );
    }
    formData.append("_token", LA.token);

    $.ajax({
        method: 'post',
        url: '/admin/stocks/csv/import',
        data: formData,
        processData: false,
        contentType: false,
        success: function () {
            $.pjax.reload('#pjax-container');
            toastr.success('操作成功');
        }
    });
});

SCRIPT;

        Admin::script($script);
    }

    /**
     * Render Import button.
     *
     * @return string
     */
    public function render()
    {

        $this->setUpScripts();

        $import = 'Import';

        return <<<EOT

<div class="btn-group pull-right" style="margin-right: 10px">
    <label>
        <span class="btn btn-sm btn-twitter">
            <span id="input"><i class="fa fa-upload"></i> {$import}</span>
            <span id="confirm" style="display:none"><i class="fa fa-upload"></i> 確定</span>
            <input type="file" id="files" name="csvfile" style="display:none">
        </span>
    </label>
</div>
EOT;

    }

    /**
     * Get Import Url
     *
     * @return string
     */
    public function getImporttUrl($string)
    {
        return $string;
    }
}
