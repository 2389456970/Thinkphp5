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

class User
{
    public function index(){
        $share=model('Share');
        $title=$share->title();
        $total=$share->total();
        $user='user.id,user.username,user.mobile,user.mail,user.create_time,user.update_time,role.rolename';
        $role=Db::table('user')->field($user)->join('user_role r','user.id=r.user_id')->join('role','role.id=r.role_id')->select();  
        return view('',['role'=>$role,'title'=>$title[0]['cate_name'],'upper_title'=>$title[1]['cate_name'],'total'=>$total]);
    }
    public function add(){
        $res = Db::table('role')->field('id,rolename')->where('id','gt',1)->select();
        return view('',['role'=>$res]);
    }
    public function addPost(){
//        return(1);
        $post=$this->postData();
        // dump($post);die;
        $role_id = $post['role_id'];
        // dump($role_id);die;
        if(empty($role_id)){
            return $arr = ['code'=>4,'msg'=>'请选择角色'];
        }
        $rolename=Db::table('user')->where('username',$post['username'])->find();
        if($rolename){
            return $arr=['code'=>3,'msg'=>'该角色名称已存在'];
        }
        $post['create_time']=time();
        $post['update_time']=time();
        $post['password'] = MD5($post['password']);
        unset($post['role_id']);
        $result =  Db::table('user')->insertGetId($post);
        // dump($result);die;
        $data = ['role_id'=>$role_id,'user_id'=>$result,'create_time'=>$post['create_time'],'update_time'=>$post['update_time']];
        // user_role 中间表
        $res   =  Db::table('user_role')->insert($data);
        // $res=Db::table('user')->insert($post);
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
        $res=Db::table('user')->where('id',$id)->find();
        // dump($res);die;
        $role_data='role.id,role.rolename';
        $role = Db::table('role')->field($role_data)->where('id','gt',1)->select();
        $sel=Db::table('user_role')->field('user_role.role_id')->where('user_id',$id)->find();
        return view('',['res'=>$res,'role'=>$role,'sel'=>$sel]);
    }
    public function editorPost(){
        $post=$this->postData();
        // dump($post);die;
        $role_id = $post['role_id'];
        $post['update_time']=time();
        if(!empty($post['password'])){
           $post['password']=MD5($post['password']); 
        }else{
            unset($post['password']);
        }
        if(empty($role_id)){
            return $arr = ['code'=>4,'msg'=>'请选择角色'];
        }
        unset($post['role_id']);
        $user_role=Db::table('user_role')->where('user_id',$post['id'])->update(['role_id'=>$role_id,'update_time'=>$post['update_time']]);
        // dump($post);die;
        $res=Db::table('user')->update($post);
        if ($res) {
            $arr=['code'=>1,'msg'=>'修改成功'];
        }else{
            $arr=['code'=>2,'msg'=>'修改失败'];
        }
        return $arr;
    }
    public function delete(){
        $id=$this->postData();
        $user_role = Db::table('user_role')->where('user_id',$id['id'])->delete();
        $res = Db::table('user')->delete($id['id']);
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
        $user_role=Db::table('user_role')->where('user_id','in',$ids)->delete();
        $res = Db::table('user')->delete($ids);
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