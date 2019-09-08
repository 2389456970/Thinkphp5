<?php
/**
 * Created by PhpStorm.
 * User: My Home
 * Date: 2018/11/26
 * Time: 16:08
 */

namespace app\index\controller;
use \think\Controller;
use \think\Request;
use \think\Db;
use \think\Cookie;
use \think\captcha\Captcha;
use \think\Validate;

class Register extends Controller
{
    public function index(){
        return view();
    }
    public function checkAll(){
        $post = Request::instance();
        $data = $post->post();
        $rule = [
            'username'  => 'require|alphaDash',
            'password'  => 'require|alphaDash',
        ];

        $msg = [
            'username.require' => '用户名不能为空',
            'username.alphaDash' => '必须为字母和数字，下划线_及破折号',
            'password.require' => '密码不能为空',
            'password.alphaDash' => '密码必须为字母和数字，下划线_及破折号',
            // 'username.max'     => '名称最多不能超过25个字符',
        ];
        $validate = new Validate($rule, $msg);

        $result   = $validate->check($data);
         
        if (!$result) {
            return json($validate->getError());
            return false;
        }
        return true;

    }
    public function addPost(){
        $post = Request::instance();
        //$data = $post->param();//自动获取提交信息
        $data = $post->post();
        $data['password'] = Md5($data['password']);
        $data['create_time'] = time();
        $code = Cookie::get('code');//手机验证码
        $m_code = Cookie::get('m_code');
       // echo $data['m_code'].'a';echo $m_code;die; //进行发送与输入验证码对比
        if($data['password'] != Md5($data['com_pass'])){
            echo "<script>alert('确认密码不对');history.back(-1);</script>";
            exit;
        }
        unset($data['com_pass']);

        // if (empty($data['code'])) {
        //     echo "<script>alert('手机验证码不能为空');history.back(-1);</script>";
        //     exit;
        // }
        // if($data['code'] != $code){
        //     echo "<script>alert('手机验证码不正确');history.back(-1);</script>";
        //     exit;
        // }
        unset($data['code']);

        //邮箱验证码发送模块
        // echo empty($data['m_code']) ?  "<script>alert('邮箱验证码不能为空');history.back(-1);</script>" :  '';
        // if($data['m_code'] != $m_code){
        //     echo "<script>alert('邮箱验证码不正确');history.back(-1);</script>";
        //     exit;
        // }
        // unset($data['m_code']);
        
        $res = Db::table('user')->insertGetId($data);
        if($res){
            $this->success('注册成功','Login/index');
        }else{
            echo "<script>alert('信息有误，注册不成功');history.back(-1);</script>";
        }
    }


}