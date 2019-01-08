<?php
/**
 * Created by PhpStorm.
 * User: jon
 * Date: 2018/11/11
 * Time: 11:38 AM
 */

namespace app\common\model;


class Article extends BaseModel
{



    public static function PostByAdd($data)
    {
//        备注
        $res = self::create($data);
        return $res;

    }

    public static function PostByUpdate($data)
    {
        $res = self::where('id', $data['id'])->data($data)->update();
        return $res;
    }

    public static function GetByList($data)
    {
        $res = self::paginate($data['limit'], false, ['query' => $data['page']]);
        return $res;
    }

    public static function GetByFind($id)
    {
        $res = self::where($id)->find();
        return $res;
    }

}