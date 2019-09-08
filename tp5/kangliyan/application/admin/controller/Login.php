<?php
/**
 * Created by PhpStorm.
 * User: My Home
 * Date: 2018/12/17
 * Time: 9:17
 */

namespace app\admin\controller;
use \think\Controller;
use \think\Request;
use \think\Db;
use \think\Session;
use \think\captcha\Captcha;

class Login{
	public function index(){
		return view();
	}
	public function addPost(){
		$request=Request::instance();
		$post=$request->post();
		// dump($post);die;
		if (!$this->check_verify($post['code'])) {
 			$arr = ['code'=>3,'msg'=>'验证码错误'];
 			return json($arr);
 		}
		$res=Db::table('user')->where('username',$post['username'])->find();
		if ($res) {
			if ($res['password'] != Md5($post['password'])) {
				return $arr = ['code'=>2,'msg'=>'用户名不存在或密码错误'];
			}
			$role=Db::table('user_role')->field('role_id')->where('user_id',$res['id'])->find();
			// dump($role);die;
			Session::set('udata',['user_id'=>$res['id'],'uname'=>$post['username'],'role_id'=>$role]);
			$arr =['code'=>1,'msg'=>'登录成功','url'=>url('Index/index')];
			return json($arr);	
		}
		$arr =['code'=>2,'msg'=>'用户名不存在'];
			return json($arr);	
	}
	public function logout(){
		session('udata',null);
		return json(['code'=>1,'msg'=>'退出成功','url'=>url('login/index')]);
	}
	public function verify(){
		$captcha = new Captcha();
		$captcha->useCurve = false;
		$captcha->length = 2;
		return $captcha->entry();
	}
 // 检测输入的验证码是否正确，$code为用户输入的验证码字符串，$id多个验证码标识
    public function check_verify($code, $id = ''){
        $captcha = new Captcha();
        return $captcha->check($code, $id);
    }
}