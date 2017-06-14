<?php
/**
 * Created by PhpStorm.
 * User: Rain
 * Date: 2017/5/18
 * Time: 22:19
 */

namespace Home\Controller;
use Think\Controller;
class EarningController extends CommonController{
    public function index(){
        $this->get_session();
        $u_id = $_SESSION['u_id'];
        $result = D('Login')->get_Info($u_id);
        $this->assign('user',$result['mobile']);
        //显示今天的收益
        $earn = D('Earning_record')->get_Now_Money($u_id);
        $this->assign('earn',$earn);
        //计算总资产，总资产应该包括账号里的余额和u_plan中的balance+money
        $user_balance = D('Login')->get_Balance($u_id);
        $uPlan_balance = D('U_Plan')->get_All_Money($u_id);
        $this->assign('balance',$user_balance+$uPlan_balance);
        //累计收益和累计亏损
        $all_earning = D('Earning_record')->get_All_Earning($u_id);
        $all_loss = D('Earning_record')->get_All_Loss($u_id);
        $this->assign('all_earning',$all_earning);
        $this->assign('all_loss',$all_loss);
        $this->display();
    }
    public function record(){
        $tip = request('get','int','tip',0);
        $u_id = $_SESSION['u_id'];
        if($tip==0){
            $reocrd_list = D('Earning_record')->get_RecordList($u_id);
            $this->assign('header','收益记录');
            $this->assign('record_list',$reocrd_list);

        }else{
            $reocrd_list = D('Trading_record')->get_RecordList($u_id);
            $this->assign('header','交易记录');
            $this->assign('record_list',$reocrd_list);

        }
        $this->display();
    }
    public function count(){
        $this->display();
    }
    public function count_ajax(){
        $money = request('get','int','money',0);
        $words = request('get','int','words',0);
        $day = request('get','int','day',0);
        $earn_arr = get_Earning($words,$money,$day);
        $ret = array('sum'=>$earn_arr[1],'max'=>$earn_arr[0][$day-1]);
        echo json_encode($ret);
    }

}