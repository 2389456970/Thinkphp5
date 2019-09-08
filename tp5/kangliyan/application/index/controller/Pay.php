<?php
/**
 * Created by PhpStorm.
 * User: My Home
 * Date: 2018/12/7
 * Time: 10:04
 */

namespace app\index\controller;
use \think\Controller;
use \think\Request;
use \think\Db;
use \think\Cookie;

class Pay extends Common
{   
    public function index(){
        $num=Db::table('comfireorder')->field('order_num')->find();
        $price=Cookie::get('price');
        return view('',['order_num'=>$num['order_num'],'price'=>$price]);
    }
    public function addPost(){
        $post = $this->postData();
        $addr = Db::table('address')->field('address_name,address_mobile,address,zip_code')->where('id',$post['addr_id'])->find();
        $ids = explode(',',$post['ids']);
        $addr['order_num'] = rand(1000000,9999999).date('Ymd',time());
        $total=0;
        foreach($ids as $key=>$value){
            $res = Db::table('comfireorder')->where('id',$value)->update($addr);
            $money = Db::table('comfireorder')->where('id',$value)->find();
            $to_money = $money['pro_price'] * $money['pro_num']; //单个产品总价
            $total += $to_money; //所有购买订单的总价
        }
        if($res){
            $carids=Cookie::get('ids');
            $cart = Db::table('shop_cart')->where('id','in',$carids)->delete();
            $price_post=Cookie::set('price_post');    
            $url = url('Pay/index',['order_num'=>base64_encode($addr['order_num']),'total'=>base64_encode($total)]);
            $arr=['code'=>1,'mgs'=>'提交订单成功','url'=>$url];
        }else{
            $arr = ['code'=>2,'mgs'=>'提交订单失败'];
        }
        return json($arr);
    }
    public function pay_success(){
        return view();
    }
    public  function postData(){
        $request = Request::instance();
        $post = $request->post();
        return $post;}
}