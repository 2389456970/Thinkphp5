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

class Menu
{
    public function index(){
        $res = Db::table('menu')->select();
        $total=Db::table('menu')->count('id');
        $request=Request::instance();
        $url=$request->path();
        $title=Db::table('menu')->field('cate_id,cate_name')->where('url_path',$url)->find();
        $upper_title=Db::table('menu')->field('cate_name')->where('id',$title['cate_id'])->find();
        // $model=model('Tree');
        // $role=$model->selectList('menu');
        // $res = $model::cateTree($role,0,0,'cate_id','cate_name');
        // dump($res);die;
        foreach ($res as $key => $value) {
            $name=Db::table('menu')->where('id',$value['cate_id'])->find();
            $res[$key]['cate_id'] = $name['cate_name'];
            if(empty($value['cate_id'])){
                $res[$key]['cate_id'] = '顶级分类';
            }
            $res[$key]['url_path']= empty($value['url_path']) ? 'NULL' : $value['url_path'];

        }
        
        return view('',['result'=>$res,'total'=>$total,'title'=>$title['cate_name'],'upper_title'=>$upper_title['cate_name']]);

    }
    public function add(){
    	// $res = Db::table('menu')->select();
        $model=model('Tree');
        $role=$model->selectList("menu");
        $tree = $model::cateTree($role,0,0,'cate_id','cate_name');
    	return view('',['res'=>$tree]);
    }
    public function addPost(){
        $request= Request::instance();
        $post=$request->post();
        // dump($post);die;
        $res = Db::table('menu')->insert($post);
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
        $res = Db::table('menu')->where('id',$id)->find();
        $model=model('Tree');
        $role=$model->selectList("menu");
        $tree = $model::cateTree($role,0,0,'cate_id','cate_name');
       // dump($res);die;
        return view('',['res'=>$res,'tree'=>$tree]);
    }
    public function editorPost(Request $request){
        $post=$request->post();
        // dump($post);die;
        $res=Db::table('menu')->update($post);
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
        $res=Db::table('menu')->where('id',$post['id'])->delete();
        if($res){
            $arr=['code'=>1,'msg'=>'删除成功'];
        }else{
            $arr=['code'=>2,'msg'=>'删除失败'];
        }
        return $arr;
    }
}