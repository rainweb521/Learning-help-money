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
    public function get_AllInfo($u_id){
        $where['u_id'] = $u_id;
        $where['p_status'] = 0;
        $plan_arr = $this->_db->where($where)->select();
        return $plan_arr;
    }
    public function set_Info($arr){
        $up_id = $this->_db->add($arr);
        return $up_id;
    }
    public function update_Info($up_id,$data){
        $where['up_id'] = $up_id;
        $this->_db->where($where)->save($data);
    }
    public function get_Info($up_id){
        $where['up_id'] = $up_id;
//        $result = $this->_db->where('id=',$id)->find();
        $result = $this->_db->where($where)->find();
        return $result;
    }
    public function get_All_Money($u_id){
        $where['p_status'] = 0;
        $where['u_id'] = $u_id;
        $result = $this->_db->where($where)->select();

        $value = array();
        $sum = 0;
        foreach ($result as $value){
//            $sum += $value['p_balance'] + $value['p_money'];
            $sum += $value['p_balance'] ;

        }
        return $sum;
    }
//    public function get_All_Balance($u_id){
//        $where['p_status'] = 0;
//        $where['u_id'] = $u_id;
//        $result = $this->_db->where($where)->select();
//        $value = array();
//        $sum = 0;
//        foreach ($result as $value){
//            $sum += $value['p_balance'] ;
//        }
//        return $sum;
//    }
}