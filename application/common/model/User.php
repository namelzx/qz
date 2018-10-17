<?php
/**
 * Created by PhpStorm.
 * User: jon
 * Date: 2018/9/15
 * Time: 下午6:51
 */

namespace app\common\model;


use think\model\concern\SoftDelete;

class User extends BaseModel
{
    use SoftDelete;
    protected $deleteTime = 'delete_time';

    public static function GetByList($data)
    {
        if (!empty($data['sort'])) {
            if ($data['sort'] == 2) {
                $res = self::where('status', 0)->paginate($data['limit'], false, ['query' => $data['page']]);
                return $res;
            } elseif ($data['sort'] == 3) {
                $res = self::paginate($data['limit'], false, ['query' => $data['page']]);
                return $res;
            }
            $res = self::where('status', $data['sort'])->paginate($data['limit'], false, ['query' => $data['page']]);

        } else {
            $res = self::paginate($data['limit'], false, ['query' => $data['page']]);
        }
        return $res;
    }

    public static function PostByUpdate($data)
    {
        $Ndata['phone'] = $data['phone'];
        $Ndata['realname'] = $data['realname'];
        $Ndata['cardID'] = $data['cardID'];
        $Ndata['status'] = 1;
        $res = self::where('id', $data['id'])->data($Ndata)->update();
        return $res;
    }

    public static function SoftDelete($id)
    {
        $res = self::destroy($id);
        return $res;

    }
}