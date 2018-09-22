<?php

namespace app\index\controller;

use app\common\model\User;
use think\Controller;

class Index extends Base
{
    public function index()
    {

     return view();

    }
    /*
     * 检查用户信息是否存在
     */
    public function checkUserbyopenid()
    {
        $PostData = input('param.');
        $data = User::where('openid', $PostData['openid'])->find();
        if (empty($data)) {
            $res = User::create($PostData);
            return json($res);
        } else {
            return json(['token' => 'user', 'data' => $data]);
        }
    }
}
