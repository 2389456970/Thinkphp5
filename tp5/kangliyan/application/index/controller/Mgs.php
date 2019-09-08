<?php
/**
 * Created by PhpStorm.
 * User: My Home
 * Date: 2018/11/27
 * Time: 16:28
 */

namespace app\index\controller;
use \think\Cookie;
use \think\Request;
class Mgs
{
    public function setMgs($url,$headers,$fields_string){
        $con = curl_init();
        curl_setopt($con, CURLOPT_URL, $url);
        curl_setopt($con, CURLOPT_SSL_VERIFYHOST, FALSE);
        curl_setopt($con, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($con, CURLOPT_HEADER, 0);
        curl_setopt($con, CURLOPT_POST, 1);
        curl_setopt($con, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($con, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($con, CURLOPT_POSTFIELDS, $fields_string);
        $result = curl_exec($con);
        curl_close($con);
        return "" . $result;
    }
    public function add(){
        $request = Request::instance();
        $url = "https://api.miaodiyun.com/20150822/industrySMS/sendSMS";
        $accountSid = 'fefc0b3de74a42e0ac7e9e7c9c85e1bc';
        $code = rand(1000,9999);
        $expie = "30";
        $smsContent = "【丽妍科技】您的验证码为".$code."，请于".$expie."分钟内正确输入，如非本人操作，请忽略此短信。";
        $to = $request->get('mobile');
//        $to = 13794008355;
        $time = date("YmdHis",time());
        $token ='c4748c43c0f841a590fb90ad1b19e806';
        $sig =  MD5($accountSid.$token.$time);
        $data = "accountSid=$accountSid&smsContent=$smsContent&to=$to&timestamp=$time&sig=$sig&respDataType=JSON";
        // header 浏览器头部信息 模拟浏览器提交
        $header = ['Content-type:application/x-www-form-urlencoded','Accept:application/json '];
        // $res = $this->setMgs($url,$header,$data);
//        var_dump($res);
        $rep =json_decode($res,true);
//        dump($rep);
        if($rep['respCode']=='00000'){
            Cookie::set('code',$code,60*30);
        }
//        dump( $code = Cookie::get('code'));

    }
}