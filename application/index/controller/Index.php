<?php

namespace app\index\controller;

use app\common\model\User;
use think\Controller;

class Index extends Base
{
    public function index()
    {

        $weigeti='W3CSchool 在线教程的网址是 http://e.jb51.net/ ，你能把这个网址替换成正确的网址吗？';
        echo preg_replace('/http\:\/\/www\.jb51\.net\//','',$weigeti);
// 在 #作为定界符，/ 就不再是定界符的含义，就不需要转义了。
//        echo preg_replace('#http\://www\.jb51\.net/#','http://e.jb51.net/w3c/',$weigeti);

        return json('1');

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
