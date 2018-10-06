<?php
/**
 * Created by PhpStorm.
 * User: jon
 * Date: 2018/10/5
 * Time: 上午1:02
 */

namespace app\validate;


use think\Validate;

class RealPostValidate extends Validate
{

    protected $rule = [
        'user_id' => 'require',
        'cardIDurl' => 'require',
        'realname' => 'require',
        'cardID' => 'require|idCard',
//        'phone|手机号码' => 'require|mobile,'

    ];
    protected $message = [
        'user_id.require' => '缺少用户id',
        'cardIDurl.require' => '请上传身份证',
        'realname.require' => '请填写真实姓名',
        'cardID.idCard' => '请填写正确的身份证号码',
        'cardID.require' => '身份证号码不能为空',
        'phone.require' => '请填写手机号码',
//        'phone.mobile' => '手机号码错误',
    ];

}