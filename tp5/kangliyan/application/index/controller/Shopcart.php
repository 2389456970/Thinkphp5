<?php
/**
 * Created by PhpStorm.
 * User: My Home
 * Date: 2018/12/4
 * Time: 10:09
 */

namespace app\index\controller;
use \think\Controller;
use \think\Request;
use \think\Db;


class Shopcart extends Common
{
    public function index(){
        $result =Db::table('shop_cart')->select();
        $all =Db::table('shop_cart')->count();
        // dump($all);die;
        return view('',['res'=>$result,'all'=>$all]);
    }
    public function addPost(){
        // dump($this->postData());
        $data = $this->postData();
        // dump($data);die;
        $len = mb_strlen($data['price'],'utf8');
        $data['price'] = mb_substr($data['price'],stripos($data['price'],'¥')+1,$len,'utf8');
        $res = Db::table('shop_cart')->insertGetid($data);
        if ($res) {
            $arr = ['code'=>1,'mgs'=>'添加购物车成功'];
        }else{
            $arr = ['code'=>2,'mgs'=>'添加购物车失败'];
        }
        return json($arr);
    }
    public  function postData(){
        $request = Request::instance();
        $post = $request->post();
        return $post;
    }
    public function abc(){
        return(1111);
    }
}


