<?php
/**
 * Created by PhpStorm.
 * User: My Home
 * Date: 2018/12/17
 * Time: 15:13
 */

namespace app\admin\model;
use think\Db;

class Tree
{
    public static function cateTree($data,$pid,$tep,$id='pro_cate_id',$name='pro_cate_name'){
        static $tree = [];
        foreach($data as $key => $val) {
            if ($val[$id] == $pid) {
                $str = str_repeat("&nbsp;&nbsp;&nbsp;",$tep+1);
                $flg = str_repeat('▶', $tep);
                $val[$name] = $str . $flg . $val[$name];
                $tree[] = $val;
                self::cateTree($data, $val['id'], $tep + 1,$id,$name);
            }
        }
        return $tree;

    }
    public function selectList($table='pro_category'){
        $res = Db::table($table)->select();
        return $res;
    }
}