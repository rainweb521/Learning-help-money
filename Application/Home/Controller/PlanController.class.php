<?php
/**
 * Created by PhpStorm.
 * User: Rain
 * Date: 2017/5/18
 * Time: 22:19
 */

namespace Home\Controller;
use Think\Controller;
class PlanController extends CommonController{
    public function index(){
        $this->get_session();
        $plan_arr = D('U_Plan')->get_AllInfo();
        $this->assign('plan_arr',$plan_arr);
        $this->display();
    }
    public function add(){
        $flag = request('post','int','flag',0);
        if($flag==0){
            $p_id = request('get','int','p_id',0);
            if($p_id!=0){
                $this->assign('p_id',$p_id);
            }
        }else{
            $arr['p_id'] = request('post','int','p_id',0);
            $arr['p_money'] = request('post','int','p_money',0);
            $arr['p_day'] = request('post','int','p_day',0);
            $arr['p_num'] = request('post','int','p_num',0);
            $arr['u_id'] = $_SESSION['u_id'];
            $result = D('Plan')->get_Info($arr['p_id']);
            $arr['p_name'] = $result['p_name'];
            $arr['p_photo'] = $result['p_photo'];
            $arr['p_state'] = $result['p_state'];
            $arr['p_status'] = 0;
            $arr['p_date'] = date("Y-m-d");
            $up_id = D('U_Plan')->set_Info($arr);

            if($arr['p_id']==1){
                //获取用户所需要的单词
                $num = $arr['p_day'] * $arr['p_num'];
                $result = D('Words4')->get_NumInfo($num);
                $sum = 0;
                for ($i=1;$i<=$num;$i++){
                    $result[$i]['u_id'] = $arr['u_id'];
                    $result[$i]['up_id'] = $up_id;
                    $result[$i]['r_state'] = 0;
                    $sum ++;
                    $result[$i]['r_day_num'] = $sum;
                    if ($sum>=10) $sum = 0;
                }
                //将所有获取到的单词全部填入数据库
                D('Words_record')->set_AllInfo($result,$num);
            }else if($arr['p_id']==2){
                //获取用户所需要的单词
                $num = $arr['p_day'] * $arr['p_num'];
                $result = D('Words6')->get_NumInfo($num);
                $sum = 0;
                for ($i=1;$i<=$num;$i++){
                    $result[$i]['u_id'] = $arr['u_id'];
                    $result[$i]['up_id'] = $up_id;
                    $result[$i]['r_state'] = 0;
                    $sum ++;
                    $result[$i]['r_day_num'] = $sum;
                    if ($sum>=10) $sum = 0;
                }
                //将所有获取到的单词全部填入数据库
                D('Words_record')->set_AllInfo($result,$num);
            }else if($arr['p_id']==3){
                //获取用户所需要的单词
                $num = $arr['p_day'] * $arr['p_num'];
                $result = D('Words6c')->get_NumInfo($num);
                $sum = 0;
                for ($i=1;$i<=$num;$i++){
                    $result[$i]['u_id'] = $arr['u_id'];
                    $result[$i]['up_id'] = $up_id;
                    $result[$i]['r_state'] = 0;
                    $sum ++;
                    $result[$i]['r_day_num'] = $sum;
                    if ($sum>=10) $sum = 0;
                }
                //将所有获取到的单词全部填入数据库
                D('Words_record')->set_AllInfo($result,$num);
            }
            $this->redirect('/index.php?c=plan');
            exit();
        }

        $this->display();
    }
    public function show(){
        $tip = request('get','int','tip',0);
//        if($tip!=0)
        {
            $plan_arr = D('Plan')->get_AllInfo();
            $this->assign('plan_arr',$plan_arr);
//            var_dump($plan_arr);
//            exit();
        }
        $this->display();
    }
    public function learn(){
        $up_id = request('get','int','up_id',0);
        if($up_id!=0){
            $r_id = request('get','int','r_id',0);
            if($r_id!=0){
                D('Words_record')->set_State($r_id);
            }
            $u_plan = D('U_Plan')->get_Info($up_id);
            $date1=strtotime(date("Y-m-d"));
            $date2=strtotime($u_plan['p_date']);
            $value = round(($date1-$date2)/3600/24) + 1;
            $result = D('Words_record')->get_Day_Info($value,$up_id);
            $num = $u_plan['p_num'] - sizeof($result);
            $num = ($num / $u_plan['p_num']) * 100;
            if ($num==100){
                $ret = array_pop($result);
                $ret['w_name'] = '恭喜你，今日学习进度已完成！';
                $this->assign('num',$num);
                $this->assign('words',$ret);
            }else{
                $this->assign('num',$num);
                $this->assign('up_id',$up_id);
                $this->assign('words',array_pop($result));
            }


        }
        $this->display();
    }
    public function ajax(){
        $up_id = request('get','int','up_id',0);
        if($up_id!=0){
            $r_id = request('get','int','r_id',0);
            if($r_id!=0){
                $state = 1;
                D('Words_record')->set_State($r_id,$state);
            }
            $u_plan = D('U_Plan')->get_Info($up_id);
            $date1=strtotime(date("Y-m-d"));
            $date2=strtotime($u_plan['p_date']);
            $value = round(($date1-$date2)/3600/24) + 1;
            $result = D('Words_record')->get_Day_Info($value,$up_id);
            $num = $u_plan['p_num'] - sizeof($result);
            $num = ($num / $u_plan['p_num']) * 100;

//            $this->assign('num',$num);
//            $this->assign('up_id',$up_id);
//            $this->assign('words',array_pop($result));
            $words = array_pop($result);
            if($num==100){
                $words['w_name'] = '恭喜你，今日学习进度已完成！';
            }
            $ret = array('upid'=>$up_id,'rid'=>$words['r_id'],'num'=>$num,
                'name'=>$words['w_name'],'symbol'=>$words['w_symbol'],
                'translate'=>$words['w_translate']);
            echo json_encode($ret);
        }

//        $result = json_encode($result);
//        return show(1,"4564",$result);
    }
    public function ajax2(){
        $up_id = request('get','int','up_id',0);
        if($up_id!=0){
            $r_id = request('get','int','r_id',0);
            if($r_id!=0){
                $state = 2;
                D('Words_record')->set_State($r_id,$state);
            }
        }
    }
    public function note(){
        $tip = request('get','int','tip',0);
        if ($tip!=0){
            $state = $tip ;
            $u_id = $_SESSION['u_id'];
            $result = D('Words_record')->get_StateList($state,$u_id);
            if($tip==2){
                $this->assign('title','生词本');
                $this->assign('content','生词本是在今天及以前，未掌握和测试题中错误的单词');
            }
            if($tip==1){
                $this->assign('title','单词本');
                $this->assign('content','单词本是在今天及以前，已掌握和测试题中答对的单词');
            }
            $this->assign('words',$result);
        }
        $this->display();
    }
    public function notebook(){

        $this->display();
    }
}