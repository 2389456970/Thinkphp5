<?php
/**
 * Created by PhpStorm.
 * User: My Home
 * Date: 2018/12/11
 * Time: 14:56
 */

namespace app\admin\controller;
use \think\Controller;

class Common extends Controller
{
    	protected $inst;
   public function _initialize(){
       Com::isSession();//第一种
       // $com = new Com;//第二种方法
       // $com->isSession();
       $this->inst=Catetree::tree();
       $this->assign('menu',$this->inst);
   }
//    public function cate(){
//
////        dump($this->inst);
//    }
}