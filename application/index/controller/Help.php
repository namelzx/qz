<?php
/**
 * Created by PhpStorm.
 * User: jon
 * Date: 2018/9/15
 * Time: 下午11:56
 */

namespace app\index\controller;


use app\common\model\Images;
use app\common\model\Record;
use app\common\model\Theraise;
use app\validate\ReleasePostValidate;

class Help extends Base
{
    /*
     * 提交众筹
     */
    public function PostbyData()
    {
        $validate = new ReleasePostValidate();
        $data = input('param.');

        if ($validate->check($data['temp'])) {


            $data['temp']['price'] = intval($data['temp']['price']);
            $data['temp']['logo'] = str_replace("\"", "", $data['images'][0]['data']);//获取图片上传的第一张做logo图
            $res = Theraise::PostByData($data['temp']);
            $images = [];
            foreach ($data['images'] as $key => $item) {
                $images[$key]['images_url'] = str_replace("\"", "", $data['images'][$key]['data']);
                $images[$key]['theraise_id'] = $res;
            }
            $ImagesModel = new Images();
            $ImagesModel->saveAll($images);
            return json(['status' => 200, 'msg' => '发布成功']);
        } else {
            return json(['status' => 201, 'msg' => $validate->getError()]);
        }
    }

    /*
     * 获取众筹详情
     */
    public function getDatabyfind($id)
    {
        $res = Theraise::GetByfind($id);
        return json($res);
    }

    /*
     * 获取众筹列表
     */
    public function getByList()
    {
        $data = input('param.');
        $res = Theraise::order('create_time desc')->paginate($data['limit'], false, ['query' => $data['page'],]);
        return json(['total' => $res->total(), 'data' => $this->groupVisit($res)]);
    }

    /*
    * 获取用户众筹列表
    */
    public function getUserByList()
    {
        $data = input('param.');
        $res = Theraise::where('user_id', $data['id'])->order('create_time desc')->paginate($data['limit'], false, ['query' => $data['page'],]);
        return json(['total' => $res->total(), 'data' => $this->groupVisit($res)]);
    }

    /* 数据重装 */
    function groupVisit($visit)
    {
        $visit_list = [];
        foreach ($visit as $v => $item) {
            $visit_list[$v] = $visit[$v];
            if ($visit[$v]['price'] > $visit[$v]['get_price']) {
                $visit_list[$v]['sum'] = round(($visit[$v]['get_price'] / intval($visit[$v]['price'])) * 100, 2);
            } else {
                $visit_list[$v]['sum'] = 100;
            }
        }
        return $visit_list;
    }

    public function Upay()
    {
        $data = input('param.');
        $res = $this->pay($data);
        return json($res);
    }

    /*
     * 捐款
     */
    public function PostByrecord()
    {
        $data = input('param.');
//       $res= $this->pay($data);
        $res = Record::PostByData($data);
        // score 字段加 5
        db('theraise')
            ->where('id', $data['theraise_id'])
            ->setInc('get_price', intval($data['price']));
        db('theraise')
            ->where('id', $data['theraise_id'])
            ->setInc('thenumber', 1);
        return json($res);
    }

    /*
     * 最近捐款人列表
     */
    public function getrecordBylist()
    {
        $data = input('param.');
        $res = Record::getBylist($data);
        return json($res);
    }
}