<?php
/**
 * Created by PhpStorm.
 * User: My Home
 * Date: 2018/12/17
 * Time: 20:38
 */

namespace app\admin\controller;
use think\Controller;

class Com extends \think\Controller
{
    public static function isSession(){
        $so=model('Session');
        $res = $so->checkSession();
        // dump($res);die;
        if(!$res){
            $controller=new \think\Controller();
            $controller -> error('请先登录','Login/index');
            // $this->redirect('Login/index');//第二种方法
        }
        return true;
    }
}