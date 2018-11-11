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
     * 用户基本信息
     */
    public function PostByReal()
    {
        $validate = new RealPostValidate();
        $data = input('param.');
        if ($validate->check($data)) {
            $Model = new \app\common\model\User();
            $Model->allowField(true)->save($data, ['id' => $data['user_id']]);
            $userinfo = $Model->where('id', $data['user_id'])->find();
            return json(['status' => 200, 'data' => $userinfo, 'msg' => '更新成功']);
        } else {
            return json(['status' => 201, 'msg' => $validate->getError()]);
        }
    }

    /*
    * 用户身份证上传
    */
    public function PostByCard()
    {
        $data = input('param.');
        $Model = new \app\common\model\User();
//        $data['status'] = 1;
        $Model->allowField(true)->save($data, ['id' => $data['user_id']]);
        $userinfo = $Model->where('id', $data['user_id'])->find();
        return json(['status' => 200, 'data' => $userinfo, 'msg' => '提交基本证件信息成功，等待管理员审核']);
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

    /**
     * 根据openid 获取用户信息。判断用户是否存在
     * 存在略过，不存在添加
     */
    public function GetUserByData()
    {

        $data = input('param.');
        $Model = new \app\common\model\User();
        $res = $Model->where('openid', $data['openid']);
        return json($res);
    }



}