<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends CommonController {
    public function index(){
        $this->get_session();
        $user = D('Login')->get_Info($_SESSION['u_id']);
        $photo_list = D('Login')->get_PhotoList();
//        var_dump($photo_list);
        $this->assign('learn_day',$user['learn_day']);
        $this->assign('photo_list',$photo_list);
        $this->assign('num',count($photo_list));
        $this->display();
//        $this->redirect('/index.php?c=index');
//        $this->show('<style type="text/css">*{ padding: 0; margin: 0; } div{ padding: 4px 48px;} body{ background: #fff; font-family: "微软雅黑"; color: #333;font-size:24px} h1{ font-size: 100px; font-weight: normal; margin-bottom: 12px; } p{ line-height: 1.8em; font-size: 36px } a,a:hover{color:blue;}</style><div style="padding: 24px 48px;"> <h1>:)</h1><p>欢迎使用 <b>ThinkPHP</b>！</p><br/>版本 V{$Think.version}</div><script type="text/javascript" src="http://ad.topthink.com/Public/static/client.js"></script><thinkad id="ad_55e75dfae343f5a1"></thinkad><script type="text/javascript" src="http://tajs.qq.com/stats?sId=9347272" charset="UTF-8"></script>','utf-8');
    }
    public function early_month(){
        $early_arr = D('Early_record')->get_AllInfo();
        $result = array();
        $date2 = date("Y-m-d");
        foreach($early_arr as $early){
            $date1 = $early['e_date'];
            $monthNum = getMonthNum( $date1 , $date2 );
            if ($monthNum==0){
                array_push($result,array('signDay'=>date('d',strtotime($date1))));
            }
        }
        echo json_encode($result);
    }
    public function early_check(){
        /**点击早起，应该提取出对应现在月份内的所有早起数据，并根据算法来计算出已签到的天数
         * 1. 难点是提取对应月份内的早起数据
         * 2. 难点是设计一个能计算已签到的天数
        */
//        $early_arr = D('Early_record')->get_AllInfo();
//        $result = array();
//        $date2 = date("Y-m-d");
//        echo date("m",strtotime('2017-2-1'));
//        exit();
//        $month = date('m');
//        $day = date('d');
//        foreach($early_arr as $early){
//            $date1 = $early['e_date'];
//            $monthNum = getMonthNum( $date1 , $date2 );
//            if ($monthNum==0){
//                array_push($result,array('signDay'=>date('d',strtotime($date1))));
//            }
//        }
//var_dump($result);
//        echo json_encode($result);
//        exit();
//        $this->assign('result',$result);
//        echo $monthNum;
//        exit();
        $this->display();
    }

    /**
     * 计算已签到的天数，如果每次都遍历一遍数据库很烦，所以我在数据库的record里直接放个day字段，每次计算出来
     * 的签到天数就放入，这样我每次直接查一下上一条字段里的值就能知道有没有签到，并且将这次签到的记录
     * 记到数据库里
     */
    public function early_ajax(){
        $up_id = request('get','int','up_id',0);
        $u_id = $_SESSION['u_id'];
        /**
         * 将用户信息和记录信息传过去，然后查询最后一条记录，如果没有，则返回 1，
         */
        $early_day = D('Early_record')->get_CheckDay($up_id,$u_id);
        $result = array('day'=>$early_day);
        echo json_encode($result);

    }

    /**
     * 学习进度的图表
     * 先准备显示已掌握的单词数
     *
     */
    public function progress(){

        $this->display();
    }


}