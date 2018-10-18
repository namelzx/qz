<?php
/**
 * Created by PhpStorm.
 * User: jon
 * Date: 2018/10/2
 * Time: 下午10:10
 */

namespace app\admin\controller;

use app\common\model\Admin;

class Login extends Base
{
    public function login()
    {

        $data = input('post.');
        if ($this->request->isPost()) {
            $userModel = new Admin();
            $hasUser = $userModel->where('username', $data['username'])->find();
            if (empty($hasUser)) {
                return json(logomsg(0, '', '', '管理员不存在'));
            }
            if ($data['password'] != $hasUser['password']) {
                return json(logomsg(0, '', '', $data['password']));
            }
            return json(logomsg(1, 'admin', url('index/index'), '登录成功'));
        } else {
            return json(logomsg(0, '', '', '登录失败'));
        }
//        return json($data);
    }

}