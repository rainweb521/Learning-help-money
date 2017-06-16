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
//        $earn_arr = get_Earning(20,10,10);
//        var_dump($earn_arr);
//        exit();
        $this->get_session();
        $plan_arr = D('U_Plan')->get_AllInfo($_SESSION['u_id']);
        $this->assign('plan_arr',$plan_arr);
        $this->display();
    }
    public function add(){
        $flag = request('post','int','flag',0);
        //这个是点击计划以后的选择跳转
        if($flag==0){
            $p_id = request('get','int','p_id',0);
            if($p_id!=0){
                $u_id = $_SESSION['u_id'];
                $balance = D('Login')->get_Balance($u_id);
                $this->assign('p_id',$p_id);
                $this->assign('balance',$balance);
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
            /**
             * 开始记录交易记录
             * 1. 将选定计划所投入的资金扣掉
             * 2. 将这次记录放入交易记录中
             */
            D('Login')->set_Balance($arr['u_id'],$arr['p_money']);
            $plan_arr = D('Plan')->get_Info($arr['p_id']);
            D('Trading_record')->add_Record($arr['u_id'],date("Y-m-d"),$plan_arr['p_name'].'计划投入'.$arr['p_money'].'元');
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
                    if ($sum>=$arr['p_day']) $sum = 0;
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
                    if ($sum>=$arr['p_day']) $sum = 0;
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
                    if ($sum>=$arr['p_id']) $sum = 0;
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
        if($tip==0){
            $plan_arr = D('Plan')->get_PlanList();
        }else{
            $plan_arr = D('Plan')->get_AllInfo($tip);
        }
        $this->assign('plan_arr',$plan_arr);
        $this->display();
    }

    /**
     * 学习过程的设置
     */
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
            $result = D('Words_record')->get_Day_Info($value,$up_id,$_SESSION['u_id']);
            $num = $u_plan['p_num'] - sizeof($result);
            $num = ($num / $u_plan['p_num']) * 100;
            $num = round($num,0);
            //如果今日计划已完成，则可以分配收益
            /**
             * 这个模块涉及到用户学习天数，我考虑的是，不管学习的内容，也不在earning_record表中修改字段
             * 只在user表中添加learn_day和learn_date两个字段，然后直接用这两个字段去判断学习的天数，与
             * 学习什么内容无关，每次收益发放的时候在model层里去判断和修改learn_day和learn_date
             */
            if ($num==100){
                //计算今日应得收益
                //判断今日的收益记录是否已经写入，如果返回的值不是0，则说明已经有了记录
                $state_value = D('Earning_record')->get_Now_Info($u_plan['u_id'], $u_plan['up_id']);
                if ($state_value==0){
                    $earn = get_Earning($u_plan['p_num'],$u_plan['p_money'],$u_plan['p_day']);
                    $earn = $earn[0][$value-1];
                    $u_plan['p_balance'] = $u_plan['p_balance'] + $earn;
                    //将收益的记录放到收益记录表中，再修改u_plan中的balance
                    //防止重复计算收益
                    D('U_Plan')->update_Info($up_id,$u_plan);
                    D('Earning_record')->add_Info($u_plan,$earn);
                }

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
            $result = D('Words_record')->get_Day_Info($value,$up_id,$_SESSION['u_id']);
            $num = $u_plan['p_num'] - sizeof($result);
            $num = ($num / $u_plan['p_num']) * 100;
            $num = round($num,0);

//            $this->assign('num',$num);
//            $this->assign('up_id',$up_id);
//            $this->assign('words',array_pop($result));
            $words = array_pop($result);
            if($num==100){
                $words['w_name'] = '恭喜你，今日学习进度已完成！';

                //计算今日应得收益
                //判断今日的收益记录是否已经写入，如果返回的值不是0，则说明已经有了记录
                $state_value = D('Earning_record')->get_Now_Info($u_plan['u_id'], $u_plan['up_id']);
                if ($state_value==0){
                    $earn = get_Earning($u_plan['p_num'],$u_plan['p_money'],$u_plan['p_day']);
                    $earn = $earn[0][$value-1];
                    $u_plan['p_balance'] = $u_plan['p_balance'] + $earn;
                    //将收益的记录放到收益记录表中，再修改u_plan中的balance
                    //防止重复计算收益
                    D('U_Plan')->update_Info($up_id,$u_plan);
                    D('Earning_record')->add_Info($u_plan,$earn);
                }


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
    public function ajax_earning(){
        $money = request('get','int','money',0);
        $words = request('get','int','words',0);
        $day = request('get','int','day',0);
        $earn_arr = get_Earning($words,$money,$day);
        $ret = array('sum'=>$earn_arr[1],'max'=>$earn_arr[0][$day-1]);
        echo json_encode($ret);
    }
    public function invite(){
        $p_id = request('get','int','p_id',0);
        if($p_id!=0){
            $this->display();
        }
    }
}