<?php
/**
 * Created by PhpStorm.
 * User: Rain
 * Date: 2017/6/6
 * Time: 15:55
 */
namespace Common\Model;
use Think\Model;
class Earning_recordModel extends Model{
    private $_db = '';

    public function __construct() {
        $this->_db = M('earning_record');
    }
    public function add_Info($data,$money){
//        $value = $this->get_Now_Info($data['u_id']);
//
//        if($value!=0){
//            return 0;
//        }
        $record['u_id'] = $data['u_id'];
        $record['up_id'] = $data['up_id'];
        $record['e_money'] = $money;
        $record['e_balance'] = $data['p_balance'];
        $record['e_state'] = 1;
        $record['e_date'] = date("Y-m-d");
        $record['r_content'] = '在'.$data['p_name'].'计划中收益'.$money.'元';
        $this->_db->add($record);
    }
    public function get_Now_Info($u_id){
        $date = date("Y-m-d");
        $where['e_date'] = $date;
        $where['u_id'] = $u_id;
        $earn = $this->_db->where($where)->find();
        if ($earn==''){
            return 0;
        }
        return $earn['e_balance'];
    }

    /**
     * @param $u_id 这里我将遍历这个数据表，然后将提前出来的数据累加，后期如果要改进，可以将money改为balance
     */
    public function get_All_Earning($u_id){
        $where['u_id'] = $u_id;
        $where['e_state'] = 1;
        $result = $this->_db->where($where)->select();
        $sum = 0;
        foreach ($result as $value){
            $sum += $value['e_money'];
        }
        return $sum;
    }
    public function get_All_Loss($u_id){
        $where['u_id'] = $u_id;
        $where['e_state'] = 0;
        $result = $this->_db->where($where)->select();
        $sum = 0;
        foreach ($result as $value){
            $sum += $value['e_money'];
        }
        return $sum;
    }
    public function get_RecordList($u_id){
        $where['u_id'] = $u_id;
        $result = $this->_db->where($where)->select();
        return $result;
    }
}