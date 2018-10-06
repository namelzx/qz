<?php
/**
 * Created by PhpStorm.
 * User: jon
 * Date: 2018/10/2
 * Time: 下午11:00
 */

namespace app\admin\controller;


use app\common\model\Images;
use app\common\model\Theraise;

class Project extends Base
{
    /*
     * h获取项目列表
     */
    public function GetTheraiseByList()
    {
        $data = input('param.');
        $res = Theraise::GetByList($data);
        return json($res);
    }

    /*
     * 修改项目状态
     */
    public function EditStatus()
    {
        $data = input('param.');
        $res = Theraise::EditStatus($data);
        return json($res);
    }

    /*
     * 删除项目
     */
    public function SoftDelete($id)
    {

        $res = Theraise::SoftDelete($id);
        return json($res);
    }

    /*
     * 获取项目详情
     */
    public function FetchProject($id)
    {
        $res = Theraise::fetchProject($id);
        return json(msg(200, $res, '获取成功'));
    }

    /*
     * 更新项目数据
     */
    public function PostByUpdate()
    {
        $data = input('param.');
        if (!empty($data['id'])) {
            $Model = new Theraise();
            $Model->readonly(['delete_time'])->allowField(true)->save($data, ['id' => $data['id']]);
            Images::where('theraise_id', $data['id'])->delete();
            $images = [];
            foreach ($data['images'] as $key => $item) {
                $images[$key]['images_url'] = str_replace("\"", "", $data['images'][$key]['url']);
                $images[$key]['theraise_id'] = $data['id'];
            }
            $ImagesModel = new Images();
            $ImagesModel->saveAll($images);
            $platforms = [];
            $p = ['bannerpush' => 0, 'mark' => 0, 'homepush' => 0];
            for ($i = 0; $i < count($data['platforms']); $i++) {
//            $platforms[$i]['mark'] = 1;
                if ($data['platforms'][$i] == 1) {
                    $platforms['mark'] = 1;
                }
                if ($data['platforms'][$i] == 2) {
                    $platforms['bannerpush'] = 1;
                }

                if ($data['platforms'][$i] == 3) {
                    $platforms['homepush'] = 1;
                }
            }
            $res = db('theraise')->where('id', $data['id'])->data($platforms + $p)->update();
            return json($res);
        }else{
            $data['price'] = intval($data['price']);

            $res = Theraise::PostByData($data);
            $images = [];
            foreach ($data['images'] as $key => $item) {
                $images[$key]['images_url'] = str_replace("\"", "", $data['images'][$key]['url']);
                $images[$key]['theraise_id'] = $res;
            }
            $ImagesModel = new Images();
            $ImagesModel->saveAll($images);
            return json(['status' => 200, 'msg' => '发布成功']);

        }
    }

}