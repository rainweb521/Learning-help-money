<?php
/**
 * Created by PhpStorm.
 * User: Rain
 * Date: 2017/5/22
 * Time: 10:27
 */

namespace Common\Model;
use Think\Model;
class MessageModel extends Model{
    private $_db = '';

    public function __construct() {
        $this->_db = M('message');
    }
    public function get_MessageList(){
        $message_arr = $this->_db->where()->select();
        return $message_arr;
    }
    public function get_Info($m_id){
        $where['m_id'] = $m_id;
//        $result = $this->_db->where('id=',$id)->find();
        $result = $this->_db->where($where)->find();
        return $result;
    }
}