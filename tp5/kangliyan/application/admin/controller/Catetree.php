<?php
/**
 * Created by PhpStorm.
 * User: My Home
 * Date: 2018/12/11
 * Time: 11:34
 */

namespace app\admin\controller;
use \think\Db;

class Catetree
{
    public static function tree($table='menu'){
        $res = Db::table($table)->where('cate_id',1)->select();
        // dump($res);die;
        foreach($res as $key=>$value){
            $next = Db::table($table)->where('cate_id',$value['id'])->select();
            $res[$key]['next']= $next;
            foreach($next as $ke=>$va){
                $next2 = Db::table($table)->where('cate_id',$va['id'])->select();
                $res[$key]['next'][$ke]['children']= $next2;
            }
        }
        // dump($next);die;
        return $res;
    }
}