<?php
/**
 * Created by PhpStorm.
 * User: My Home
 * Date: 2018/11/28
 * Time: 19:02
 */

namespace app\index\model;
use think\Db;

class Common{
	public function topNav(){
		$map=['nav_id'=>1,'is_show'=>1];
		$res=$this->selecList('nav',$map,'nav_name,url_path');
		return $res;
	}
	public function middleNav(){
		$map=['nav_id'=>2,'is_show'=>1];
		$res=$this->selecList('nav',$map,'nav_name,url_path');
		return $res;
	}
	public function bottomNav($table='nav'){
		$res = Db::table($table)->where('nav_id',3)->select();
        foreach($res as $key=>$value){
            $next = Db::table($table)->where('nav_id',$value['id'])->select();
            $res[$key]['next']= $next;
        }
        return $res;
	}
	public function selecList($table,$where,$field="*"){
		$res = Db::table($table)->field($field)->where($where)->select();
		return $res;
	}
	public function shop_cart_total(){
		$all =Db::table('shop_cart')->count('id');
		return $all;
	}
}