<?php
/**
 * Created by PhpStorm.
 * User: My Home
 * Date: 2018/12/17
 * Time: 17:24
 */

namespace app\admin\model;
use think\Request;
use think\Db;
use think\Session;

class Level
{
	public function level(){
		$request=Request::instance();
		$url=$request->path();
		$id=Db::table('menu')->field('id')->where('url_path',$url)->find();
		return $id;}
	public function roleLevel($role_id){
		$id=$this->level();
		if (!$id) {
			return NULL;}
		$res=Db::table('role_menu')->where(['role_id'=>$role_id['role_id'],
			'cate_id'=>$id['id']])->find();
		if ($res) {
			return $res;
		}else{
			return false;}

	}
}