<?php
/**
 * Created by PhpStorm.
 * User: Rain
 * Date: 2017/5/22
 * Time: 10:27
 */

namespace Common\Model;
use Think\Model;
class U_PlanModel extends Model{
    private $_db = '';

    public function __construct() {
        $this->_db = M('u_plan');
    }
    public function get_AllInfo(){
        $plan_arr = $this->_db->where()->select();
        return $plan_arr;
    }
    public function set_Info($arr){
        $up_id = $this->_db->add($arr);
        return $up_id;
    }
    public function get_Info($up_id){
        $where['up_id'] = $up_id;
//        $result = $this->_db->where('id=',$id)->find();
        $result = $this->_db->where($where)->find();
        return $result;
    }
}