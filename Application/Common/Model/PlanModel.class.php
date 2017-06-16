<?php
/**
 * Created by PhpStorm.
 * User: Rain
 * Date: 2017/5/22
 * Time: 10:27
 */

namespace Common\Model;
use Think\Model;
class PlanModel extends Model{
    private $_db = '';

    public function __construct() {
        $this->_db = M('plan');
    }
    public function get_AllInfo($p_status){
        $where['p_state'] = $p_status;
        $where['p_status'] = 1;
        $plan_arr = $this->_db->where($where)->select();
        return $plan_arr;
    }
    public function get_PlanList(){
        $where['p_status'] = 1;
        $plan_arr = $this->_db->where($where)->select();
        return $plan_arr;
    }
    public function get_Info($p_id){
        $where['p_id'] = $p_id;
//        $result = $this->_db->where('id=',$id)->find();
        $result = $this->_db->where($where)->find();
        return $result;
    }
}