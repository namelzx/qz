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

}