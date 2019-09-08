<?php
/**
 * Created by PhpStorm.
 * User: My Home
 * Date: 2018/12/17
 * Time: 20:33
 */

namespace app\admin\model;
use think\Session as Se;
class Session
{
    public function checkSession(){
        $res=Se::has('udata');
        if(!$res){
            return false;
        }
        return true;
    }
}