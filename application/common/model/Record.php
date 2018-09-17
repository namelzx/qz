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
}