<?php
/**
 * Created by PhpStorm.
 * User: jon
 * Date: 2018/11/11
 * Time: 11:40 AM
 */

namespace app\admin\controller;

use app\common\model\Article as ArticleModel;

class Article extends Base
{
    public function GetArticleByList()
    {
        $data = input('param.');
        $res = ArticleModel::GetByList($data);
        return json($res);
    }

    public function createArticle()
    {
        $data = input('param.');
        if (empty($data['id'])) {

            $res = ArticleModel::PostByAdd($data);
            return json($res);

        } else {
            $res = ArticleModel::PostByUpdate($data);
            return json($res);
        }
    }

    public function detail()
    {
        $data = input('param.');
        $res = ArticleModel::GetByFind($data);
        return json($res);
    }

    public function delete()
    {
        $data = input('param.');
        $res = ArticleModel::destroy($data);
        return json($res);
    }

}