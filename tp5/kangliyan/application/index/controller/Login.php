<?php
/**
 * Created by PhpStorm.
 * User: My Home
 * Date: 2018/11/26
 * Time: 16:07
 */

namespace app\index\controller;
use \think\Controller;
use \think\Request;
use \think\Db;
use \think\Session;
use \think\captcha\Captcha;


class Login
{
 public  function index(){
     return view();
 }
 public function addPost(){
 	$request = Request::instance();
 	$post = $request->post();
 	$post['password'] = Md5($post['password']);

 	if (!$this->check_verify($post['code'])) {
 		$arr = ['code'=>3,'mgs'=>'验证码错误'];
 		return json($arr);
 	}
 	$res = Db::table('user')->where('username',$post['username'])->find();
 	// return json([$post['password'],$res['password'] ]);
 	if ($res) {
 		if ($res['password'] != $post['password']) {
 			$arr = ['code'=>1,'mgs'=>'密码错误'];
 			return json($arr);
 		}
 		Session::set('arr',['uname'=>$post['username'],'id'=>$res['id']]);
 		// $this->success('登录成功','Index/index');
 		$arr = ['code'=>0,'mgs'=>'登录成功','url'=>url('Index/index')];
 		return json($arr);
 	}
 	$arr = ['code'=>2,'mgs'=>'用户名错误'];
 	return json($arr);
 	
}
	public function verify(){
		$captcha = new Captcha();
		$captcha->useCurve = false;
		$captcha->length = 4;
		return $captcha->entry();
	}
 // 检测输入的验证码是否正确，$code为用户输入的验证码字符串，$id多个验证码标识
    public function check_verify($code, $id = ''){
        $captcha = new Captcha();
        return $captcha->check($code, $id);
    }
}