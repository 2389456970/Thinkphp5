<?php
namespace app\index\controller;
use \think\Controller;
use \think\Request;
use \think\Db;

class Common extends Controller{
	public function _initialize(){
		$model=model('Common');
		$top=$model->topNav();
		$middle=$model->middleNav();
		$bottom=$model->bottomNav();
		$all=$model->shop_cart_total();
		$this->assign('topnav',$top);
		$this->assign('middlenav',$middle);
		$this->assign('bottomnav',$bottom);
		$this->assign('all',$all);
		// dump($res);die;
	}
}