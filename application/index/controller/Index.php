<?php

namespace app\index\controller;

use app\common\model\Article;
use app\common\model\Complete;
use app\common\model\Theraise;
use app\common\model\User;

class Index extends Base
{
    public function index()
    {
        return view();
    }

    /**
     * 根据openid 获取用户信息。判断用户是否存在
     * 存在略过，不存在添加
     */
    public function checkUserbyopenid()
    {
        $PostData = input('param.');
        $data = User::where('openid', $PostData['openid'])->find();
        if (empty($data)) {
            $res = User::create($PostData);
            return json(['token' => 'user', 'data' => $res]);
        } else {
            return json(['token' => 'user', 'data' => $data]);
        }
    }

    /*
     * 获取首页轮播图
     */
    public function Banner()
    {
        $res = Theraise::GetByBanner();
        return json($res);
    }

    /*
     * 获取助学公示
     */
    public function GetCompleteByList()
    {
        $data = input('param.');
        $res = Complete::GetByList($data);
        return json($res);
    }

    /*
    * 获取助学公示
    */
    public function GetCompleteByfind()
    {
        $data = input('param.');
        $res = Complete::GetByFind($data['id']);
        return json($res);
    }

    /*
     * 获取使用教程
     */
    public function GetBytutorial()
    {
        $res = Article::all();
        return json($res);

    }
}