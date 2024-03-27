<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class MainModel extends Model
{
    protected $folderUpload = '';
    protected $fieldSearchAccepted = [];
    protected $crudNotAccepted = ['_token', '_method', 'thumb_current'];

    protected $guarded = ['_token', '_method', 'thumb_current'];


    //  zvn_storage_image: nằm trong config/filesystems để cài đặt path cho hình
    public function uploadThumb($thumbObj)
    {
        $thumbName = Str::random(10) . '.' . $thumbObj->extension();
        $thumbObj->storeAs($this->folderUpload, $thumbName, 'zvn_storage_image');
        return $thumbName;
    }

    public function deleteThumb($thumbName)
    {
        Storage::disk('zvn_storage_image')->delete($this->folderUpload . '/' . $thumbName);
    }

    public function prepareParams($params)
    {
        // dùng array_flip($this->crudNotAccepted) chuyển value->key. 
        // sau đó array_diff_key sẽ loại bỏ những phần tử của $params nào có value giống với key của array_flip
        return array_diff_key($params, array_flip($this->crudNotAccepted));
    }
}
