<?php
/**
 * Created by PhpStorm.
 * User: jon
 * Date: 2018/10/7
 * Time: 下午2:55
 */

namespace app\admin\controller;


use app\common\model\Admin as AdminModel;

class Admin extends Base
{
    public function GetByList()
    {
        $data = input('param.');
        $res = AdminModel::GetByList($data);
        return json($res);
    }

    public function PostByUpdate()
    {
        $data = input('param.');
        if (!empty($data['id'])) {

            $res = AdminModel::PostByUpdate($data);

        } else {
            $Model = new AdminModel();
            $data['create_time'] = time();
            $res = $Model->insertGetId($data);
        }
        return json($res);
    }

    public function SoftDelete()
    {
        $Model = new AdminModel();
        $data = input('param.');
        $res = $Model->where('id',$data['id'])->delete();
        return json($res);
    }


}