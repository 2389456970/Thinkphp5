<?php
/**
 * Created by PhpStorm.
 * User: My Home
 * Date: 2018/12/17
 * Time: 19:38
 */

namespace app\admin\controller;
use think\Session;


class Power extends \think\Controller
{
	public function __construct(){
		$this->runs();
	}
	public function runs(){
		$level=model('Level');
		$role_id=Session::get('udata.role_id');
                $res=$level->roleLevel($role_id);
                if (!$res) {
                	// abort(404,'你没有权限');
                	// echo "<script>window.parent.location.reload();</scirpt>";
                	$this->error('你没有权限','Error/power');
                	// // return false;
                	// return view('Error/power');
                }
                return true;
	}
}