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
        //修改用户的学习天数
        /**
         * 这个模块涉及到用户学习天数，我考虑的是，不管学习的内容，也不在earning_record表中修改字段
         * 只在user表中添加learn_day和learn_date两个字段，然后直接用这两个字段去判断学习的天数，与
         * 学习什么内容无关，每次收益发放的时候在model层里去判断和修改learn_day和learn_date
         */
        $date = date("Y-m-d");
        $user = D('Login')->get_Info($data['u_id']);
        if ($user['learn_date']==''){
            $user['learn_date'] = $date;
            $user['learn_day'] = 1;
        }
        $day = get_Now_Day($user['learn_date']) - 1;
        if ($day!=0){
            if (($day==1)){
                $user['learn_date'] = $date;
                $user['learn_day'] = $user['learn_day'] + 1;
            }else{
                $user['learn_date'] = $date;
                $user['learn_day'] = 1;
            }
            D('Login')->update_Info($user,$data['u_id']);
        }

    }
    public function get_Now_Info($u_id){
        $date = date("Y-m-d");
        $where['e_date'] = $date;
        $where['u_id'] = $u_id;
        $earn = $this->_db->where($where)->find();
        if ($earn==''){
            return 0;
        }
        return $earn['e_money'];
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