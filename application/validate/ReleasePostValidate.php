<?php
/**
 * Created by PhpStorm.
 * User: jon
 * Date: 2018/10/1
 * Time: 下午4:53
 */

namespace app\validate;

use think\Validate;

class ReleasePostValidate extends Validate
{
    protected $rule = [
        'user_id' => 'require',
        'price' => 'require',
        'tarName' => 'require',
        'janeName' => 'require',

    ];
    protected $message = [
        'user_id.require'=>'缺少用户id',
        'price.require' => '金额不可为空',
        'tarName.require' => '标题不可为空',
        'janeName.require' => '简介不可为空',

        'helpName.require' => '详细说明不可为空',
    ];

}