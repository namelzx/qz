<?php
/**
 * Created by PhpStorm.
 * User: jon
 * Date: 2018/10/6
 * Time: 下午4:44
 */

namespace app\common\model;


class Complete extends BaseModel
{


    public function Theraise()
    {
        return $this->hasOne('Theraise', 'id', 'theraise_id');
    }

    public static function PostByAdd($data)
    {
        $res = self::create($data);
        return $res;
    }

    public static function PostByUpdate($data)
    {
        $res = self::where('theraise_id', $data['theraise_id'])->data($data)->update();
        return $res;
    }

    public static function GetByList($data)
    {
        $res = self::with('Theraise')->paginate($data['limit'], false, ['query' => $data['page']]);
        return $res;
    }

    public static function GetByFind($id)
    {
        $res = self::with('Theraise')->where('id', $id)->find();
        return $res;
    }

}