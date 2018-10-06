<?php
/**
 * Created by PhpStorm.
 * User: jon
 * Date: 2018/9/20
 * Time: 下午10:15
 */

namespace app\index\controller;


use app\common\model\Record;
use app\validate\RealPostValidate;

class User extends Base
{

    //获取用户捐款记录
    public function getByCecord()
    {
        $data = input('param.');
        $res = Record::getRecordBylist($data);
        return json($res);
    }

    /*
     * 用户审核提交
     */
    public function PostByReal()
    {
        $validate = new RealPostValidate();
        $data = input('param.');

        if ($validate->check($data)) {
            $Model = new \app\common\model\User();
            $data['status']=1;
            $Model->allowField(true)->save($data, ['id' => $data['user_id']]);
            return json(['status' => 200, 'msg' => '认证成功']);
        } else {
            return json(['status' => 201, 'msg' => $validate->getError()]);
        }
    }

    /*
     * 查询用户身份信息
     */
    public function GetByUserInfo()
    {
        $data = input('param.');
        $Model = new \app\common\model\User();
        $res = $Model->where('id', $data['user_id'])->find();
        return json($res);
    }

}