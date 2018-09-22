<?php
/**
 * Created by PhpStorm.
 * User: jon
 * Date: 2018/9/20
 * Time: 下午10:15
 */

namespace app\index\controller;


use app\common\model\Record;

class User extends Base
{

    //获取用户捐款记录
    public function getByCecord()
    {
        $data = input('param.');
        $res = Record::getRecordBylist($data);
        return json($res);

    }

}