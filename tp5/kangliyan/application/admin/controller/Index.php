<?php
/**
 * Created by PhpStorm.
 * User: My Home
 * Date: 2018/12/11
 * Time: 10:32
 */

namespace app\admin\controller;


class Index extends Common
{
    public function index(){
//        dump($this->inst);die;
        return view();
    }
    public function welcome(){
    	return view();
    }
}