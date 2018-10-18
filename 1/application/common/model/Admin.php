<?php
/**
 * Created by PhpStorm.
 * User: jon
 * Date: 2018/10/2
 * Time: 下午10:01
 */

namespace app\common\model;


class Admin extends BaseModel
{
    public static function GetByList($data)
    {
//        if (!empty($data['sort'])) {
//            if ($data['sort'] == 2) {
//                $res = self::where('status', 0)->paginate($data['limit'], false, ['query' => $data['page']]);
//                return $res;
//            } elseif ($data['sort'] == 3) {
//                $res = self::paginate($data['limit'], false, ['query' => $data['page']]);
//                return $res;
//            }
//            $res = self::where('status', $data['sort'])->paginate($data['limit'], false, ['query' => $data['page']]);
//
//        } else {
//            $res = self::paginate($data['limit'], false, ['query' => $data['page']]);
//        }
        $res = self::paginate($data['limit'], false, ['query' => $data['page']]);
        return $res;
    }

    public static function PostByUpdate($data)
    {

        $res = self::where('id', $data['id'])->data($data)->update();
        return $res;
    }




}