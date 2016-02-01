<?php
namespace Home\Controller;
use Think\Controller;
use Think\Model;
require './ThinkPHP/Library/Vendor/autoload.php';
use Firebase\JWT\JWT;
class ArticlenewController extends Controller {
    public function index(){
        //获取来自客户端的jwt
        $postjwt=$_POST;
        $key="access_token";
        
        //提取jwt中的json数据
        $decoded = JWT::decode($postjwt, $key, array('HS256'));
        $arr=json_decode($decoded);
        $username=$arr->username;//用户名为学号，也是数据库中的ID
        $title=$arr->title;//文章标题
        $uid=$arr->username;//创建该文章的用户ID
        $date=$arr->date;//创建文章的年月日时分秒
        $enddate=$arr->enddate;
        $tid=$arr->tid;//
        $bodyofhtml=$arr->body;//投票的内容（保存为html）
        $option->$arr->options;//投票的选项（按照英文字符的;区分如“我的家;在东北;松花江上;”）
        $grade=$arr->grade;//可查看该投票的年级
        
        //对时间进行处理；
        $datetime= date("YmdHis",strtotime($date));//获取当前时间
        $id=$datetime;
      
        $datesql= date("Y-m-d H:i:s",strtotime($datetime));//放入数据库的时间格式
        $enddatesql=date("Y-m-d H:i:s",strtotime($enddate));//放入数据库的时间格式

        //对投票选项进行处理
        $contents=explode(";",$decoded->options);//此处为投票具体内容
        $count=count($contents)-1;//总共有多少个投票内容
        for($i=0;$i<$count;$i++){
            $ids=$datetime.$i.";";
        }
        $optionids=explode(";",$ids);

        //将读取到的html文件写入到硬盘文件
        $file_path=__DIRART__.$datetime.$uid.'vote.html';
        $body=$datetime.$uid.'vote.html';//html文件的名字
        $myfile = fopen($file_path, "w") or die("Unable to open file!");
        if(fwrite($myfile, $bodyofhtml)) 
            $suc=1;
        else
            $suc=0;
        fclose($myfile);
        //$suc=1保存成功；=0写入失败
        
        //投票信息里加入字段
        $Model=new Model();
        /* $sql="insert into __PREFIX__vote(id,title,body,begtime,endtime,uid,tid,options,grade) values (
           uuid_short(),'$title',$body,'$datesql','$enddatesql',$uid','$tid','$body','$grade')";
         *///
        $sql="insert into __PREFIX__vote(id,title,body,begtime,endtime,uid,tid,options,grade) values (
        uuid_short(),'$title',$body,'$datesql','$enddatesql',$uid','$tid','$bodyofhtml','$grade')";
        
        if($Model->query($sql))
            $suc=1;
        else 
            $suc=0;
        
   /*      //投票选项里加入字段
        if($suc){
            for($i=0;$i<$count;){
                $sql="insert into __PREFIX__vote_options(id,tid,content) values ('$optionids[$i]','$datetime',$contents[$i])";
                if($Model->query($sql))
                    $i++;
                else {
                    $suc=0;
                    break;//跳出for循环
                }
            }
        } */
              
        $token = array(
            
            
            
            "username" => $username,
            "suc"=>$suc,
            "body"=>$body,
        );
       // echo 'success';
        /**
         * IMPORTANT:
         * You must specify supported algorithms for your application. See
         * https://tools.ietf.org/html/draft-ietf-jose-json-web-algorithms-40
         * for a list of spec-compliant algorithms.
        */
        $jwt = JWT::encode($token, $key);
        echo $jwt;
        
       /*  $decoded = JWT::decode($jwt, $key, array('HS256'));//json
        print_r($decoded); */
        
    }
}
?>