<?php
/**
 * Created by PhpStorm.
 * User: Rain
 * Date: 2017/5/22
 * Time: 10:27
 */

namespace Common\Model;
use Think\Model;
class AdviceModel extends Model{
    private $_db = '';

    public function __construct() {
        $this->_db = M('advice');
    }
    public function get_AdviceList(){
        $message_arr = $this->_db->where()->select();
        return $message_arr;
    }
    public function get_Info($a_id){
        $where['a_id'] = $a_id;
//        $result = $this->_db->where('id=',$id)->find();
        $result = $this->_db->where($where)->find();
        return $result;
    }
    public function add_Info($content,$u_id){
        $where['a_content'] = $content;
        $where['u_id'] = $u_id;
        $where['a_date'] = date('Y-m-d');
        $this->_db->add($where);
    }
}