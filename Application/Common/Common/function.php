<?php
/**
 * Created by PhpStorm.
 * User: w-pc
 * Date: 2017/02/20
 * Time: 9:56
 * 公用的方法
 * @param $status
 * @param $message
 * @param array $data
 */
function show($status, $message, $data=array()){
    $result = array(
        'status' => $status,
        'message' => $message,
        'data' => $data,
    );

    exit(json_encode($result));
}
function getMd5Password($password){
    return md5($password.C('MD5_PRE'));
}
function getLoginUsername(){
    return session('adminUser');
}
function check_verify($code, $id = ""){
    $verify = new \Think\Verify();
    return $verify->check($code, $id);
}
function get_left_menu($num){
    $left_menu = D('LeftMenu')->getAdminByLeft_Menu();
    $left_menu[$num]['show'] = 'active';
    sort($left_menu);
    return $left_menu;
}

/**
 * @param $class 设置请求类型，post，get
 * @param $type 设置参数类型，str，int
 * @param $name 设置参数名称
 * @param $default 可选参数，设置参数的默认值
 *
 */
function request($class,$type,$name,$default){
    $flag = 1;
    if($class=='get'){
        if(empty($_GET[$name])){
            $flag = 0;
        }else{
            $value = $_GET[$name];
        }
    }else{
        if(empty($_POST[$name])){
            $flag = 0;
        }else{
            $value = $_POST[$name];
        }
    }
    if($type=='str'){
        if($flag==1){
            //          $value = utf8_encode($value);
            //删除字符串两端的空白字符和其他预定义字符
            $value = trim($value);
        }else{
            $value = '';
            if(!empty($default)){
                $value = $default;
            }
        }
    }else{
        if($flag==1){
            //          $value = utf8_encode($value);
            //删除字符串两端的空白字符和其他预定义字符
            $value = trim($value);
        }else{
            $value = 0;
            if(!empty($default)){
                $value = $default;
            }
        }
    }
    return $value;
}
function set_Behavior($behavior,$content){
    $time = date("Y-m-d h:i:sa");
    $arr['behavior'] = $behavior;
    $arr['time'] = $time;
    $arr['content'] = $content;
    D('BehaviorLog')->add_Behavior($arr);
}
function start_session($expire = 0)
{
    if ($expire == 0) {
        $expire = ini_get('session.gc_maxlifetime');
    } else {
        ini_set('session.gc_maxlifetime', $expire);
    }
    if (empty($_COOKIE['PHPSESSID'])) {
        session_set_cookie_params($expire);
        session_start();
    } else {
        session_start();
        setcookie('PHPSESSID', session_id(), time() + $expire);
    }
}
function getMonthNum( $date1, $date2, $tags='-' ){
    $date1 = explode($tags,$date1);
    $date2 = explode($tags,$date2);
    return abs($date1[0] - $date2[0]) * 12 + abs($date1[1] - $date2[1]);
}
function get_Earning($words,$money,$day,$p_day=5.5){
   // $p_day = 5.5; //计划天数，为常量，值不需要改变
  //  $w_num = 30; //#单词个数
   // $money = 50; //#总投资
   // $day = 15; #
//    a = 0 #学习时长
//    z = 5  # 坚持天数
    $earn_arr = array();
    $earn_day = array();
    $sum = 0.0;
    for ($i=1;$i<=$day;$i++){
        $value1 = ($p_day/log(10))*((0.6*sqrt($i))*(0.7*$money)+0.4*$words);
        $value2 = 12*30;
        $value = $value1/$value2;
        $value = round($value,2);
        $sum += $value;
        array_push($earn_day,$value);
    }
    array_push($earn_arr,$earn_day);
    array_push($earn_arr,$sum);
    return $earn_arr;
}
function get_Num_Day($date1,$date2){
    $date1=strtotime($date1);
    $date2=strtotime($date2);
    $value = round(($date1-$date2)/3600/24) + 1;
    return $value;
}
function get_Now_Day($date){
    $date1=strtotime(date("Y-m-d"));
    $date2=strtotime($date);
    $value = round(($date1-$date2)/3600/24) + 1;
    return $value;
}
function upload_photo($file){
    //全局变量
    $arrType=array('image/jpg','image/gif','image/png','image/bmp','image/jpeg');
    $max_size='500000';      // 最大文件限制（单位：byte）
    $upfile='./Public/images'; //图片目录路径
    if($_SERVER['REQUEST_METHOD']=='POST') { //判断提交方式是否为POST
        if (!is_uploaded_file($file['tmp_name'])) { //判断上传文件是否存在
//            return '文件不存在！';
            return '';
        }
//        if ($file['size'] > $max_size) {  //判断文件大小是否大于500000字节
//            return '上传文件太大！';
//        }
        if (!in_array($file['type'], $arrType)) {  //判断图片文件的格式
//            return '上传文件格式不对！';
            return '';
        }
        if (!file_exists($upfile)) {  // 判断存放文件目录是否存在
            mkdir($upfile, 0777, true);
        }
        $imageSize = getimagesize($file['tmp_name']);
        $img = $imageSize[0] . '*' . $imageSize[1];
        //采用时间戳命名
        $fname = rand() . time();
        $ftype = explode('.', $fname);
        $fileinfo = pathinfo($file['name']);
//                var_dump($fileinfo['extension']);
//                exit();
        $picName = $upfile . "/rain" . $fname . '.' . $fileinfo['extension'];
        if (file_exists($picName)) {
//            return '同文件名已存在！';
            return '';
        }
        if (!move_uploaded_file($file['tmp_name'], $picName)) {
//            return '移动文件出错！';
            return '';
        } else {
//                echo $picName."<br>";
//                echo "<font color='#FF0000'>图片文件上传成功！</font><br/>";
//                echo "<font color='#0000FF'>图片大小：$img</font><br/>";
//                echo "图片预览：<br><div style='border:#F00 1px solid; width:200px;height:200px'>
//                    <img src=\"".$picName."\" width=200px height=200px>".$fname."</div>";
            return $picName;

        }
    }
}