<?php
/**
 * Created by PhpStorm.
 * User: jon
 * Date: 2018/9/15
 * Time: 下午10:22
 */

namespace app\index\controller;


use EasyWeChat\Factory;
use OSS\Core\OssException;
use OSS\OssClient;

use think\Controller;


header('Access-Control-Allow-Origin:*');
header('Access-Control-Allow-Credentials: true');
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept, authKey, sessionId, Access-Token, X-Token");

class Base extends Controller
{
    public function upload()
    {
        // 获取表单上传文件 例如上传了001.jpg
        $file = request()->file('file');
        // 移动到框架应用根目录/uploads/ 目录下
        $info = $file->move('./uploads');
        if ($info) {
            $path = $info->getSaveName();
            $filepath = 'https://qz.10huisp.com/uploads/' . $info->getSaveName();
            $fileName = 'uploads/' . $info->getSaveName();

            $this->uploadFile('gtjj', $fileName, $info->getPathname());
            return $path;
        } else {
            // 上传失败获取错误信息
            echo $file->getError();
        }
        return json($file);
    }

    /**
     * 实例化阿里云OSS
     * @return object 实例化得到的对象
     * @return 此步作为共用对象，可提供给多个模块统一调用
     */
    function new_oss()
    {
        //获取配置项，并赋值给对象$config
        $config = config('aliyun_oss');
        //实例化OSS
        $oss = new \OSS\OssClient($config['KeyId'], $config['KeySecret'], $config['Endpoint']);
        return $oss;
    }

    /**
     * 上传指定的本地文件内容
     *
     * @param OssClient $ossClient OSSClient实例
     * @param string $bucket 存储空间名称
     * @param string $object 上传的文件名称
     * @param string $Path 本地文件路径
     * @return null
     */
    function uploadFile($bucket, $object, $Path)
    {
        //try 要执行的代码,如果代码执行过程中某一条语句发生异常,则程序直接跳转到CATCH块中,由$e收集错误信息和显示
        try {
            //没忘吧，new_oss()是我们上一步所写的自定义函数
            $ossClient = $this->new_oss();
            //uploadFile的上传方法
            $res = $ossClient->uploadFile($bucket, $object, $Path);
            return json($res);
        } catch (OssException $e) {
            //如果出错这里返回报错信息
            return $e->getMessage();
        }
    }

    public function getopenid()
    {
        $data = input('param.');
        $url = "https://api.weixin.qq.com/sns/jscode2session?appid=" . $data['appid'] . "&secret=" . $data['secret'] . "&js_code=" . $data['js_code'] . "&grant_type=authorization_code";
        $data = $this->curlSend($url);
        return json_encode($data);
    }

    //调用获取路径
    public function curlSend($url, $data = '')
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); //不进行证书验证
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false); //不进行主机头验证
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); //结果不直接输出在屏幕上
        $data && curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        $data ? curl_setopt($ch, CURLOPT_POST, true) : curl_setopt($ch, CURLOPT_POST, false);  //发送的方式
        curl_setopt($ch, CURLOPT_URL, $url);   //发送的地址
        $result = curl_exec($ch);
        curl_close($ch);
        $info = json_decode($result, true);
        return $info;
    }


//单篇订单支付
    public function pay($data)
    {

//            $config = [
//                'app_id' => 'wxf193369c4886d5fc',
//                'mch_id' => '1498556672',
//                'key'    => 'shanshuijv45082119900303daliuren',   // API!操作
//                'cert_path'          => getcwd().'/cert/apiclient_cert.pem', // XXX: 绝对路径！！！！
//                'key_path'           => getcwd().'/cert/apiclient_key.pem',
//                'notify_url'         => '',     // 你也可以在下单时单独设置来想覆盖它
//            ];
        $config = [
            'app_id' => 'wx14dea0693ebf42ac',
            'mch_id' => '1518352971',
            'key'    => '33576aa35761f1e867268ab3b5d91096',   // API!操作

            'cert_path'          => getcwd().'/cert/apiclient_cert.pem', // XXX: 绝对路径！！！！
            'key_path'           => getcwd().'/cert/apiclient_key.pem',
            'notify_url'         => '',     // 你也可以在下单时单独设置来想覆盖它
        ];
//        return $config;
            $app = Factory::payment($config);
//            $openid =$data['openid'];
            $total_money = intval($data['price']);
            $total_money = 0.1;
            $attributes = [
                'trade_type'       => 'JSAPI', // JSAPI，NATIVE，APP...
                'body'             => '众筹捐款'.'-'.$data['title'],
                'out_trade_no'     => time() . rand(1000, 9999),
                'total_fee'        =>$total_money*100, // 单位：分
                'notify_url'       => 'https://'.$_SERVER['HTTP_HOST'].'/api/Order/order_notify', // 支付结果通知网址，如果不设置则会使用配置里的默认地址
                'openid'           => $data['openid'], // trade_type=JSAPI，此参数必传，用户在商户appid下的唯一标识，
            ];
            // $order = new Order($attributes);
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
            return $arr;
    }


    function filter_str($str)
    {
        $str = str_replace("\"", "", $str);
        return $str;
    }
}