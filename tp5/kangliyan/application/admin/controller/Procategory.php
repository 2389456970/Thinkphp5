<?php
/**
 * Created by PhpStorm.
 * User: My Home
 * Date: 2018/12/17
 * Time: 15:53
 */

namespace app\admin\controller;
use \think\Db;
use \think\Request;

class Procategory
{
    public function index(){
        // $res = Db::table('pro_category')->select();
        $model=model('Tree');
        $role=$model->selectList();
        $tree = $model::cateTree($role,0,0);
        return view('',['result'=>$tree]);
    }
    public function add(){
        $model=model('Tree');
        $role=$model->selectList();
        $tree = $model::cateTree($role,0,0);
        return view('',['res'=>$tree]);
    }
    public function addPost(Request $request){
        // return(1);
        $post=$request->post();
        // dump($post);die;
        $res = Db::table('pro_category')->insert($post);
        if($res){
            $arr=['code'=>1,'msg'=>'添加成功'];
        }else{
            $arr=['code'=>2,'msg'=>'添加失败'];
        }
        return $arr;
    }
}