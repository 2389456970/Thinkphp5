<?php
/**
 * Created by PhpStorm.
 * User: My Home
 * Date: 2018/12/14
 * Time: 11:10
 */

namespace app\admin\controller;
use \think\Request;
use \think\Db;

class Level
{
    public function index(){
        $arr=[];
        $res=Db::table('role')->select();
        foreach($res as $key =>$value){
            $next=Db::table('role_menu rm')->join('menu m','m.id=rm.cate_id')->where('role_id',$value['id'])->select();
            if (is_array($next)) {
                $array=array_column($next,'cate_name');
            }
            $next=join('||',$array);
            $arr2=['role_id'=>$value['id'],'rolename'=>$value['rolename'],'cate_name'=>$next];
            $arr[]=$arr2;
        }
        return view('',['level'=>$arr]);
    }
    public function add(){
        $res=Db::table('role')->field('id,rolename')->where('id','gt',1)->select();
        $tree = Catetree::tree();
        return view('',['rol'=>$res,'tree'=>$tree]);
    }
    public function addPost(){
        $request = Request::instance();
        $post = $request->post();
        $arr = [];
        foreach($post['cate_id'] as $key => $v){
            $arr[]=['role_id'=>$post['role_id'],'cate_id'=>$v,
                'create_time'=>time(),'update_time'=>time()];
        }
        $res = Db::table('role_menu')->insertAll($arr);
        if ($res) {
            $arr=['code'=>1,'msg'=>'添加成功','data'=>''];
        }else{
            $arr=['code'=>2,'msg'=>'添加失败'];}
        return $arr;
    }
    public function update(){
        $request=Request::instance();
        $id=$request->param('id');
        $res=Db::table('role')->field('id,rolename')->where('id','gt',1)->select();
        $tree = Catetree::tree();
        $selected=Db::table('role_menu')->where('role_id',$id)->select();
        $menu=array_column($selected,'cate_id');
        return view('',['res'=>$res,'tree'=>$tree,'id'=>$id,'menu'=>$menu]);
    }
    public function updatePost(){
        $request =  Request::instance();
        $post = $request->post();
       dump($post);die;
        $res  = Db::table('role_menu')->where('role_id',$post['role_id'])->select();

        $array = array_column($res,'cate_id');
        // dump($array);
        $arr =[];
        foreach($post['cate_id'] as $v){
            $arr[] = (int)$v; //inival()
        }
       // dump($arr);
        $diff = array_diff($arr,$array);
        // dump($diff);die;
        if(!empty($diff)){
            $del =  Db::table('role_menu')->where('role_id',$post['role_id'])->where('cate_id','in',$diff)->delete();
        }
        else{
            $p=count($arr);
            $q=count($array);
            if ($p >= $q) {
                return $arr = ['code'=>2,'msg'=>'权限未作任何修改'];
            }
            else{
                if(empty($diff2)){
                     $diff2 = array_diff($array,$arr);
                 // dump($diff2);die;
                    $delete=Db::table('role_menu')->where('role_id',$post['role_id'])->where('cate_id','in',$diff2)->delete();
                    // dump($delete);die;
                if($delete){
                    return  $arr = ['code'=>1,'msg'=>'权限修改成功','data'=>''];
                }
                else{
                    return $arr = ['code'=>2,'msg'=>'权限未作任何修改'];
                }
            }
        }
    }

//        dump($del);
        $diff2 = array_diff($post['cate_id'],$array);
        // dump($diff2);die;
        if(empty($diff2)){
            if($del){
                return  $arr = ['code'=>1,'msg'=>'权限修改成功','data'=>''];
            }else{
                return $arr = ['code'=>2,'msg'=>'权限未作任何修改'];
            }

        }
//        dump(1);die;
//        dump($diff2);die;
        $arr_insert = [];
        foreach($diff2 as $key =>$value){
            $dif_arr = ['role_id'=>$post['role_id'],'cate_id'=>$value];
            $arr_insert[] = $dif_arr;
        }
        $result =  Db::table('role_menu')->insertAll($arr_insert);
//        dump($result);die;
        if($result){
            $arr = ['code'=>1,'msg'=>'权限修改成功','data'=>''];
        }else{
            $arr = ['code'=>2,'msg'=>'权限未作任何修改'];
        }
        return json($arr);

    }
    public function del(Request $request){
        $post=$request->post();
        // dump($post);die;
        $role_menu=Db::table('role_menu')->where('role_id',$post['id'])->delete();
        if ($role_menu) {
            $arr=['code'=>1,'msg'=>'清空权限成功'];
        }else{
            $arr=['code'=>2,'msg'=>'清空权限失败'];
        }
        return $arr;
    }
}