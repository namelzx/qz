<?php
/**
 * Created by PhpStorm.
 * User: jon
 * Date: 2018/9/15
 * Time: 下午10:22
 */

namespace app\index\controller;


use think\Controller;
use OSS\OssClient;
use OSS\Core\OssException;

class Base extends Controller
{

    public function upload()
    {
        // 获取表单上传文件 例如上传了001.jpg
        $file = request()->file('file');
        // 移动到框架应用根目录/uploads/ 目录下
        $info = $file->move('./uploads');
        if ($info) {
             $path = $info->getSaveName();
            return $path;
        } else {
            // 上传失败获取错误信息
            echo $file->getError();
        }
        return json($file);
    }


    function filter_str($str)
    {
        $str = str_replace("\"", "", $str);
        return $str;
    }
}