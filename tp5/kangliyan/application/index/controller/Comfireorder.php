<?php
/**
 * Created by PhpStorm.
 * User: My Home
 * Date: 2018/12/5
 * Time: 15:44
 */

namespace app\index\controller;
use \think\Controller;
use \think\Request;
use \think\Db;
use \think\Cookie;

class Comfireorder extends Common
{   
    public function index(){
        // $shopcart=new Shopcart();
        // dump($shopcart->abc());die;
        $result =Db::table('comfireorder')->select();
        $addr = Db::table('address')->select();
        // dump($addr);die;
        $num=Db::table('comfireorder')->count('id');
        $total =0;
        foreach ($result as $key => $value) {
            $to_money = $value['pro_price'] * $value['pro_num']; //单个产品总价
            // dump($to_money);die;
            $total += $to_money; //所有购买订单的总价
            // dump($total);die;
            $str =strip_tags($value['pro_name']);
            $len =mb_strlen($str,'utf-8');
            if ($len>18) {
            $result[$key]['pro_name']=mb_substr($str,0,18,'utf-8').'...';
            }
        }
        $total = $total;
        Cookie::set('price',$total,60*60*60);
        return view('',['res'=>$result,'addr'=>$addr,'total'=>$total,'num'=>$num]);
    }
    public function addPost(){
        $ids_str = $this->postData();//接收到的ID
        $ids = explode(',',$ids_str['ids']);
        $data = Db::table('shop_cart')->field('pro_name,pro_price, pro_size,pro_color,pro_num')->where('id','in',$ids)->select();
        $res = Db::table('comfireorder')->insertAll($data);
        // dump($res);die;
        if ($res) {
            Cookie::set('ids',$ids,60*60*60);
            // Db::table('shop_cart')->where('id','in',$ids)->delete();
            $arr = ['code'=>1,'mgs'=>'添加订单成功'];
        }else{
            $arr = ['code'=>2,'mgs'=>'添加订单失败'];
        }
        return json($arr);

    }
    public function postData(){
    	$request = Request::instance();
        $post = $request->post();
    	return $post;
    }
    public function order(){
        return view();
    }
}

