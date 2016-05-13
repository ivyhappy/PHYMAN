<?php
namespace Home\Controller;
//namespace Home\Controller\Article;

use Think\Model;

use Common\Controller\AjaxController;
require './ThinkPHP/Library/Vendor/autoload.php';
require './ThinkPHP/Library/Vendor/Classes/PHPExcel.php';
require './ThinkPHP/Library/Vendor/Classes/messagePush-master/Pusher.php';
class ScanController extends AjaxController {
    
    public function getList(){
        $sqlplus="order by id desc";
        
        $sql="select * from ".__PREFIX__."scans ".$sqlplus;
        $Model=new Model();
        $res= $Model->query($sql);
        $resjson=json_encode($res);
  
        $jsonsend=array(
            "username"=>"",
            "list"=>$resjson,
        );
        $json=json_encode($jsonsend);
        //echo $json;
        echo $json;
    }
    //获取文章内容
    public function getScanDetail(){
        //获取客户端发送的json
      /*   $arr=json_decode($GLOBALS['HTTP_RAW_POST_DATA']);
        $username=$arr->userid; */
        $username=201522040840;
        $sql="select count(*) from ".__PREFIX__."scans where id=".$username;
        $Model=new Model();
        $res= $Model->query($sql);
        $count=$res[0]['count(*)'];
        $scanname="0";
        $sql="select scanname from ".__PREFIX__."scan where id =".username." and scanname != ".$scanname;
        $res= $Model->query($sql);
        $scans=$res[0]['scanname'];
        $scans=json_encode($scans);
        print_r($scans);
        $jsonsend=array(
            "username"=>$username,
            "count"=>$count,
            "scans"=>$scans
        );
        $json=json_encode($jsonsend);
        echo $json;
    }
}
?>