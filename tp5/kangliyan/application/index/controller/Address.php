<?php
/**
 * Created by PhpStorm.
 * User: My Home
 * Date: 2018/12/10
 * Time: 10:48
 */

namespace app\index\controller;
use \think\Controller;
use \think\Request;
use \think\Db;


class Address extends Common
{
    public function index(){
        $addr=Db::table('address')->select();
        return view('',['addr'=>$addr]);
    }
    public function add(){
    	$data = $this->postData();
    	$res=Db::table('address')->insert($data);
    	if ($res) {
    		$arr=['code'=>1,'mgs'=>'保存信息成功'];
    	}else{
    		$arr=['code'=>2,'mgs'=>'保存信息失败'];
    	}
    	return json($arr);
    }
    public function postData(){
    	$request = Request::instance();
    	$post = $request->post();
    	return $post;
    }
}