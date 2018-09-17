<?php
/**
 * Created by PhpStorm.
 * User: jon
 * Date: 2018/9/15
 * Time: 下午11:55
 */

namespace app\common\model;


class Theraise extends BaseModel
{
    public function items()
    {
        return $this->hasMany('images');
    }

    public static function PostByData($data)
    {
        $res = self::create($data);
        return $res->id;
    }

    public static function GetByfind($id)
    {
        $data = self::with('items')->where('id', $id)->find();
        return $data;
    }

}