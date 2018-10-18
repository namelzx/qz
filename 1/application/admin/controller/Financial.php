<?php
/**
 * Created by PhpStorm.
 * User: jon
 * Date: 2018/10/7
 * Time: 下午3:57
 */

namespace app\admin\controller;


use think\Db;

class Financial extends Base
{
    public function GetRecordByAll()
    {
        //获取流水列表
        $data = input('param.');
//        $res = Record::GetRecordByAll($data);
        $res = Db::table('ra_record')->alias('r')
            ->join('ra_theraise t', 'r.theraise_id=t.id')
            ->join('ra_user u', 'u.id=r.user_id')
            ->field('r.id,u.nickName,u.realname,t.tarName,t.price as tprice,t.get_price,r.create_time,r.price');
        if (!empty($data['starTime'])) {
            $res = $res->where('r.create_time', 'between time', $data['starTime']);
        }
        if (!empty($data['title'])) {
            $where[''] = array('like', '%' . $data['title'] . '%');//封装模糊查询 赋值到数组
            $res = $res->whereOr('u.realname', 'like', '%' . $data['title'] . '%')->
            whereOr('u.nickName', 'like', '%' . $data['title'] . '%')->
            whereOr('t.tarName', 'like', '%' . $data['title'] . '%');
        }
        $res = $res->paginate($data['limit'], false, ['query' => $data['page'],]);
        return json($res);
    }

}