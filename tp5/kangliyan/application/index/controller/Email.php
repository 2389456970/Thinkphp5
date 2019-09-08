<?php
/**
 * Created by PhpStorm.
 * User: My Home
 * Date: 2018/11/28
 * Time: 19:41
 */

namespace app\index\controller;
use app\index\model\Phpmailer;
use \think\Cookie;
use \think\Request;

class Email
{
    public function setMaile(){
    	$request = Request::instance();
//        $model = new Phpmailer();
//        dump($model);
        $title ='您好，您的验证码是';
        $mgs = rand(1000,9999);
        $email = $request->get('mail');
        // $email = '1261296691@qq.com';
        $res = Phpmailer::SendEmail($title,$mgs,$email);
        // dump($res);
        if ($res==true) {
        	Cookie::set('m_code',$mgs,60*10);
        }
        

        // dump($res);
    }
}