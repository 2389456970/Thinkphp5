<?php
/**
 * Created by PhpStorm.
 * User: My Home
 * Date: 2018/12/12
 * Time: 10:14
 */

namespace app\admin\controller;
use \think\Db;
use \think\Request;

class Role
{
    public function index(){
        $role=Db::table('role')->select();
//        dump($role);die;
        return view('',['role'=>$role]);
    }
    public function add(){
        return view();
    }
    public function addPost(){
//        return(1);
        $post=$this->postData();
        $rolename=Db::table('role')->where('rolename',$post['rolename'])->find();
        if($rolename){
           return $arr=['code'=>3,'msg'=>'该角色名称已存在'];
        }
        $post['create_time']=time();
        $res=Db::table('role')->insert($post);
        if($res){
            $arr=['code'=>1,'msg'=>'添加成功'];
        }else{
            $arr=['code'=>2,'msg'=>'添加失败'];
        }
        return $arr;

    }
    public function editor(){
        $request=Request::instance();
        $id=$request->param('id');
        $res=Db::table('role')->where('id',$id)->find();
        return view('',['res'=>$res]);
    }
    public function editorPost(){
        $post=$this->postData();
        $res=Db::table('role')->update($post);
        if ($res) {
            $arr=['code'=>1,'msg'=>'修改成功'];
        }else{
            $arr=['code'=>2,'msg'=>'修改失败'];
        }
        return $arr;
    }
    public function delete(){
        $id=$this->postData();
        $res = Db::table('role')->where('id',$id['id'])->delete();
        if($res){
            $arr=['code'=>1,'msg'=>'删除成功'];
        }else{
            $arr=['code'=>2,'msg'=>'删除失败'];
        }
        return $arr;
    }
    public function alldel(){
        $post=$this->postData();
        $ids=explode(',',$post['ids']);
        $res = Db::table('role')->where('id','in',$ids)->delete();
        if($res){
            $arr=['code'=>1,'msg'=>'删除全部成功'];
        }else{
            $arr=['code'=>2,'msg'=>'删除全部失败'];
        }
        return $arr;
    }
    public function postData(){
        $request=Request::instance();
        $post=$request->post();
        return $post;
    }
}