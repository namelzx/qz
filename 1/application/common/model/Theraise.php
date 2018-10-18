<?php
/**
 * Created by PhpStorm.
 * User: jon
 * Date: 2018/9/15
 * Time: 下午11:55
 */

namespace app\common\model;


use think\model\concern\SoftDelete;

class Theraise extends BaseModel
{
    use  SoftDelete;
    protected $deleteTime = 'delete_time';
    protected $readonly = ['id', 'update_time'];
    protected $field = true;

    public function info()
    {
        return $this->hasOne('user', 'id', 'user_id');
    }
    public function complete()
    {
        return $this->hasOne('complete', 'theraise_id', 'id');
    }

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

    /*
     * 获取项目列表
     */
    public static function GetByList($data)
    {
        $res = self::order('create_time desc');
        if ($data['status'] != 2) {
            $res = $res->where('status', 1)->whereOr('status', 0);
        } else {
            $res = $res->where('status', 2);
        }
        $res = $res->paginate($data['limit'], false, ['query' => $data['page'],]);
        return $res;
    }

    /*
     * 修改项目状态
     */
    public static function EditStatus($data)
    {
        $res = self::where('id', $data['id'])->data(['status' => $data['status']])->update();
        return $res;
    }

    public static function SoftDelete($id)
    {
        $res = self::destroy($id);
        return $res;
    }

    public static function fetchProject($id)
    {
        $res = self::with(['info', 'items'])->find($id);
        return $res;
    }

    public static function CompleteByFind($id)
    {
        $res = self::with('complete')->find($id);
        return $res;
    }

    public static function PostByUpdate($data)
    {
        $res = self::where('id', $data['id'])->strict(true)->data($data)->update();
        return $res;

    }

    /*
     * 获取轮播图
     */
    public static function GetByBanner()
    {
        $res = self::where('bannerpush', 1)->paginate(100);
        return $res;
    }

}