<?php

namespace app\admin\model;
use think\Db;

/**
* 
*/
class Upload
{
	public function upload($name='image_path'){
    // 获取表单上传文件
    $files = request()->file($name);
    if (empty($files)) {
    	return NULL;
    }
    $arr = [];
	    foreach($files as $file){
	        // 移动到框架应用根目录/public/uploads/ 目录下
	        $info = $file->move(ROOT_PATH . 'public' . DS . 'uploads');
	        if($info){
	            // 成功上传后 获取上传信息
	            // 输出 jpg
	            //echo $info->getExtension(); 
	            // 输出 42a79759f284b767dfcb2a0197904287.jpg
	            //echo $info->getFilename(); 
	        $arr[]=  '/' . 'uploads/'.$info->getSavename();
	        }else{
	            // 上传失败获取错误信息
	            echo $file->getError();
	        }    
	    }
	    if ($arr) {
	    	return $arr;
	    }else{
	    	return false;
	    }
	    
	}
}