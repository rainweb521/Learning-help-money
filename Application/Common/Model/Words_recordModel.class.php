<?php
/**
 * Created by PhpStorm.
 * User: Rain
 * Date: 2017/5/22
 * Time: 18:42
 */

namespace Common\Model;
use Think\Model;
class Words_recordModel extends Model{
    private $_db = '';

    public function __construct() {
        $this->_db = M('words_record');
    }
    public function get_Info($r_id){
        $where['r_id'] = $r_id;
        $result = $this->_db->where($where)->find();
        return $result;
    }
    public function set_Info($result){
        $this->_db->add($result);
    }
    public function set_AllInfo($result,$num){
        for ($i=1;$i<=$num;$i++){
            $this->set_Info($result[$i]);
        }
    }
    public function get_Day_Info($value,$up_id,$u_id){
        $where['r_day_num'] = $value;
        $where['up_id'] = $up_id;
        $where['u_id'] = $u_id;
        $where['r_state'] = 0;
        $result = $this->_db->where($where)->select();
        return $result;
    }
    public function set_State($r_id,$state){
        $data = $this->get_Info($r_id);
        if ($data['r_state']!=2){
            $data['r_state'] = $state;
            $this->set_Update($r_id,$data);
        }
    }
    public function set_Update($r_id,$data){
        $where['r_id'] = $r_id;
        $this->_db->where($where)->save($data);
    }
    public function get_StateList($state,$u_id){
        $where['r_state'] = $state;
        $where['u_id'] = $u_id;
        $result = $this->_db->where($where)->select();
        return $result;
    }
}