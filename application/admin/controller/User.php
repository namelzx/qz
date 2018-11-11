<?php
/**
 * Created by PhpStorm.
 * User: jon
 * Date: 2018/10/7
 * Time: 下午1:17
 */

namespace app\admin\controller;

use app\common\model\User as UserModel;

class User extends Base
{
    public function GetByList()
    {
        $data = input('param.');
        $res = UserModel::GetByList($data);
        return json($res);
    }

    public function PostByUpdate()
    {
        $data = input('param.');
        $res = UserModel::PostByUpdate($data);
        return json($res);
    }

    public function SoftDelete()
    {
        $data = input('param.');
        $res = UserModel::SoftDelete($data['id']);
        return json($res);
    }
    public function SetUserByStatus()
    {
        $data = input('param.');
        $Model = new \app\common\model\User();
        $Model->allowField(true)->where('id',$data['id'])->data($data)->update();
        $userinfo = $Model->where('id', $data['id'])->find();
        return json(['status' => 200, 'data' => $userinfo, 'msg' => '更新成功']);
    }

}