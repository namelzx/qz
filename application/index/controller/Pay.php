<?php
/**
 * Created by PhpStorm.
 * User: jon
 * Date: 2018/10/1
 * Time: 下午11:06
 */

namespace app\index\controller;


use EasyWeChat\Factory;
use EasyWeChatComposer\EasyWeChat;
use think\Facade;

class Pay extends Base
{
    //单篇订单支付
    public function order()
    {
        if (request()->isPost()) {
            $config = [
                'app_id' => 'wxf193369c4886d5fc',
                'mch_id' => '1498556672',
                'key'    => 'shanshuijv45082119900303daliuren',   // API!操作
                'cert_path'          => getcwd().'/cert/apiclient_cert.pem', // XXX: 绝对路径！！！！
                'key_path'           => getcwd().'/cert/apiclient_key.pem',
                'notify_url'         => '',     // 你也可以在下单时单独设置来想覆盖它
            ];
            $app=Factory::payment($config);
            $total_money = 1;
            $attributes = [
                'trade_type'       => 'JSAPI', // JSAPI，NATIVE，APP...
                'body'             => "1213",
                'out_trade_no'     => time() . rand(1000, 9999),
                'total_fee'        => $total_money*100, // 单位：分
                'notify_url'       => '', // 支付结果通知网址，如果不设置则会使用配置里的默认地址
                'openid'           => 'o5Vsc5MVaEz1ou9h6f0Mzm44Yme0', // trade_type=JSAPI，此参数必传，用户在商户appid下的唯一标识，
            ];

            $result = $app->order->unify($attributes);
            // var_dump($result);exit;
            $config = array();
            if ($result['return_code'] == 'SUCCESS' && $result['result_code']== 'SUCCESS'){
                $prepayId = $result['prepay_id'];
                $jssdk = $app->jssdk;
                $config = $jssdk->bridgeConfig($prepayId, false);
                //var_dump($config);exit;
            }
            $arr = array(
                'timeStamp'=>$config['timeStamp'],
                'nonceStr'=>$config['nonceStr'],
                'package'=>$config['package'],
                'signType'=>'MD5',
                'paySign'=>$config['paySign'],
            );
            return json_encode($arr);
        }
    }



}