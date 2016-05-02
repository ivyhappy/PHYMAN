<?php
namespace Home\Controller;
use Common\Controller\AjaxController;
use Think\Model;

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
        $arr=json_decode($GLOBALS['HTTP_RAW_POST_DATA']);
        $username=$arr->userid;
        
        $sql="select count(*) from ".__PREFIX__."scans where id=".$username;
        $Model=new Model();
        $res= $Model->query($sql);
        $count=$res[0]['count(*)'];
        print_r($count);
        $sql="select scanname from ".__PREFIX__."scan where id =".username;
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