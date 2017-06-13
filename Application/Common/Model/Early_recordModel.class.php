<?php
/**
 * Created by PhpStorm.
 * User: Rain
 * Date: 2017/5/27
 * Time: 8:40
 */

namespace Common\Model;
use Think\Model;
class Early_recordModel extends Model{
    private $_db = '';

    public function __construct() {
        $this->_db = M('early_record');
    }
    public function get_AllInfo(){
        $early = $this->_db->where()->select();
        return $early;
    }

    public function get_CheckDay($up_id,$u_id){
        $where['up_id'] = $up_id;
        $where['u_id'] = $u_id;
        $early_arr = $this->_db->where($where)->select();
        $early = array_pop($early_arr);
        $date = date("Y-m-d");
        if(empty($early)){
            $this->insert($up_id,$u_id,$date,0);
            return 1;
        }else{
            if ($date==$early['e_date']){
//                $this->insert($up_id,$u_id,$date,$early['e_day']);
                return $early['e_day'];
            }else{
                $Days = get_Now_Day($early['e_date']) - 1;
                if($Days!=1){
                    $this->insert($up_id,$u_id,$date,0);
                    return 1;
                }else{
                    $this->insert($up_id,$u_id,$date,$early['e_day']);
                    return $early['e_day'] + 1;
                }
            }

        }
    }
    public function insert($up_id,$u_id,$e_date,$e_day){
        $arr['up_id'] = $up_id;
        $arr['u_id'] = $u_id;
        $arr['e_date'] = $e_date;
        $arr['e_day'] = $e_day + 1;
        $this->_db->add($arr);
    }
}