<?php
namespace app\admin\model;
use \think\Db;
use \think\Request;
/**
* 
*/
class Share
{	//计算数据总条数
	public function total($table='user',$id='id'){
		$total=Db::table($table)->count($id);
		// dump($total);die;
		return $total;
	}
	//左上角标题栏
	public function title(){
		$request=Request::instance();
        $url=$request->path();
        $title=Db::table('menu')->field('cate_id,cate_name')->where('url_path',$url)->find();
        $upper_title=Db::table('menu')->field('cate_name')->where('id',$title['cate_id'])->find();
        $arr=[$title,$upper_title];
        return $arr;
	}
}