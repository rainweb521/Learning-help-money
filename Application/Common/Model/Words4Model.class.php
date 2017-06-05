<?php
/**
 * Created by PhpStorm.
 * User: Rain
 * Date: 2017/5/22
 * Time: 15:29
 */

namespace Common\Model;
use Think\Model;
class Words4Model extends Model{
    private $_db = '';

    public function __construct() {
        $this->_db = M('words4');
    }
    public function get_Info($w_id){
        $where['w_id'] = $w_id;
        $result = $this->_db->where($where)->find();
        return $result;
    }
    public function get_NumInfo($num){
//        $result = $this->_db->where()->select();
        //四级总单词数4451
        $result = array();
        /**
         * 我的想法是为了单词的随机出现更加合理化，将单词分成固定的区间，然后在每个区间里随机出一个单词
         * 但是后来发现，我是不能限定所选定的单词总数的，所以我觉得直接划分成固定的区间，然后直接用循环去
         * 区间里查找，num的值为445比较合理,但是如果选择的单词太少，比如一百个，就会被前面的细分掉，
        **/
        $c_value = 4451/100;
        $b_value = 0;
        for ($i=0;$i<=$num;$i++){
            $j_value = $b_value + $c_value;
            if($j_value>4451) {$b_value= 1;$j_value = $b_value + $c_value;}
            if($b_value<1) $b_value = 1;
            $rand_num = rand($b_value,$j_value);
            $result[$i] = $this->get_Info($rand_num);
            $b_value = $j_value;
        }
        shuffle($result);
        return $result;
    }
}