<?php
/**
 * Created by PhpStorm.
 * User: Rain
 * Date: 2017/6/6
 * Time: 15:55
 */
namespace Common\Model;
use Think\Model;
class Trading_recordModel extends Model{
    private $_db = '';

    public function __construct() {
        $this->_db = M('trading_record');
    }
    public function add_Record($u_id,$date,$content){
        $result['u_id'] = $u_id;
        $result['t_date'] = $date;
        $result['t_content'] = $content;
        $this->_db->add($result);
    }
}