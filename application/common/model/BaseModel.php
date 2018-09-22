<?php
/**
 * Created by PhpStorm.
 * User: jon
 * Date: 2018/9/15
 * Time: 下午6:51
 */

namespace app\common\model;


use think\Model;

class BaseModel extends Model
{
    protected $autoWriteTimestamp = true;
    protected $field = true;
}