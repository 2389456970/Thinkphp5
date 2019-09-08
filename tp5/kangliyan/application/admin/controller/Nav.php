<?php
/**
 * Created by PhpStorm.
 * User: My Home
 * Date: 2018/12/11
 * Time: 10:58
 */

namespace app\admin\controller;
use \think\Db;
use \think\Request;

class Nav
{
    public function index(){
        $res = Db::table('nav')->select();
        $total=Db::table('nav')->count('id');

        $request=Request::instance();
        $url=$request->path();
        $title=Db::table('menu')->field('cate_id,cate_name')->where('url_path',$url)->find();
        // dump($title);die;
        $upper_title=Db::table('menu')->field('cate_name')->where('id',$title['cate_id'])->find();
        // $model=model('Tree');
        // $role=$model->selectList('nav');
        // $res = $model::cateTree($role,0,0,'nav_id','nav_name');
        // dump($res);die;
        foreach ($res as $key => $value) {
            $name=Db::table('nav')->where('id',$value['nav_id'])->find();
            $res[$key]['nav_id'] = $name['nav_name'];
            if(empty($value['nav_id'])){
                $res[$key]['nav_id'] = '顶级分类';
            }
            $res[$key]['url_path']= empty($value['url_path']) ? 'NULL' : $value['url_path'];

        }
        
        return view('',['result'=>$res,'total'=>$total,'title'=>$title['cate_name'],'upper_title'=>$upper_title['cate_name']]);

    }
    public function add(){
    	// $res = Db::table('nav')->select();
        $model=model('Tree');
        $role=$model->selectList("nav");
        $tree = $model::cateTree($role,0,0,'nav_id','nav_name');
    	return view('',['res'=>$tree]);
    }
    public function addPost(){
        $request= Request::instance();
        $post=$request->post();
        // dump($post);die;
        $res = Db::table('nav')->insert($post);
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
        // dump($id);die;
        $res = Db::table('nav')->where('id',$id)->find();
        $model=model('Tree');
        $role=$model->selectList("nav");
        $tree = $model::cateTree($role,0,0,'nav_id','nav_name');
       // dump($res);die;
        return view('',['res'=>$res,'tree'=>$tree]);
    }
    public function editorPost(Request $request){
        $post=$request->post();
        // dump($post);die;
        $res=Db::table('nav')->update($post);
        if ($res) {
            $arr=['code'=>1,'msg'=>'数据修改成功'];
        }else{
            $arr=['code'=>2,'msg'=>'数据未作修改'];
        }
        return $arr;
        
    }
    public function del(){
        $request=Request::instance();
        $post=$request->post();
        // dump($post);die;
        $res=Db::table('nav')->where('id',$post['id'])->delete();
        if($res){
            $arr=['code'=>1,'msg'=>'删除成功'];
        }else{
            $arr=['code'=>2,'msg'=>'删除失败'];
        }
        return $arr;
    }
}