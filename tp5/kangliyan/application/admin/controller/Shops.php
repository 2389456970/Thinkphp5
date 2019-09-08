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

class Shops{
	public function index(){
		$res = Db::table('shops s')->join('pro_category c','s.shops_cate=c.id')->select();
        foreach($res as $key =>$value){
            $re = Db::table('shops_image')->where('shops_id',$value['shops_id'])->find();
            $res[$key]['image_path']=$re['image_path'];
        }
       // dump($res);die;
        return view('',['shops'=>$res]);
        return view('',['shops'=>$res]);
	}
	public function add(){
		$model = model('Tree');
        $res = $model->selectList();
        $data = $model::cateTree($res,0,0);
        return view('',['role'=>$data]);
	}
	public function addPost(){
        $reqeust = Request::instance();
        $post = $reqeust ->post();
        $post['shops_desc'] =  $reqeust->post('shops_desc','','htmlspecialchars');
        $post['create_time'] = time();
        $post['update_time']=time();
        $upload=model('Upload');
        $files=$upload->upload();
        $big_pic=$upload->upload('shops_image');
        $post['shops_image']=$big_pic[0];
        //开启事务
        Db::startTrans();
        //异常处理,两个表都成功时侧不作异常处理
        try{
            $res=Db::table('shops')->insertGetId($post);
            // dump($res);die;
            $info=[];
            foreach($files as $key => $value){
                $arr=['shops_id'=>$res,'image_path'=>$value,'create_time'=>$post['create_time'],'update_time'=>$post['update_time']];
                $info[]=$arr;
            }
            Db::table('shops_image')->insertAll($info);
            // 提交事务
            Db::commit();    
        } catch (\Exception $e) {
            // 回滚事务
            Db::rollback();
        }
//        dump($post);die;
        if($res){
            $arr = ['code'=>1,'msg'=>'添加成功'];
        }else{
            $arr = ['code'=>2,'msg'=>'添加失败'];
        }
        return $arr;
    }
    public function test(){
        // $upload=model('Upload');
        // $files=$upload->upload();
        // dump($files);
        
    }
}