<?php
/**
 * Created by PhpStorm.
 * User: jon
 * Date: 2018/9/17
 * Time: 上午11:10
 */

namespace app\common\model;


class Record extends BaseModel
{
    public function info()
    {
        return $this->hasOne('user', 'id', 'user_id');
    }

    public function Theraise()
    {
        return $this->hasOne('Theraise', 'id', 'theraise_id');
    }

    public static function PostByData($data)
    {
        $res = self::create($data);
        return $res->id;
    }

    public static function getBylist($data)
    {
        $res = self::with('info')->where('theraise_id', $data['theraise_id'])->order('create_time desc')->
        paginate($data['limit'], false, ['query' => $data['page'],]);
        return $res;
    }

    public static function getRecordBylist($data)
    {
        $res = self::with('Theraise')->where('user_id', $data['id'])->order('create_time desc')->
        paginate($data['limit'], false, ['query' => $data['page'],]);
        return $res;
    }

    /*
     * 后台模块方法
     */

    public static function GetRecordByAll($data)
    {

        $res = self::with(['Theraise', 'info'])->order('create_time desc')->
        paginate($data['limit'], false, ['query' => $data['page'],]);
        return $res;
    }

    public static function GetByRecord($data)
    {
        $res = self::with('Theraise')->where('Theraise_id', $data['id'])->order('create_time desc')->
        paginate($data['limit'], false, ['query' => $data['page'],]);
        return $res;
    }

}