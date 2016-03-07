<?php
namespace Home\Controller;
//namespace Home\Controller\Article;
use Think\Controller;
use Think\Model;
use Firebase\JWT\JWT;

require './ThinkPHP/Library/Vendor/autoload.php';
require './ThinkPHP/Library/Vendor/Classes/PHPExcel.php';


import(Vendor.Classes.Writer.Excel5.php);
import(Vendor.Classes.IOFactory.php);

class AdminController extends Controller {
    public function goUrl(){
        $Url="";
        return $Url;
    }
    public function newNoti(){
        //获取客户端发送的json
        $json=json_decode($GLOBALS['HTTP_RAW_POST_DATA']);
        $key="access_token";
        $jwt=$json->access_token;
        if($json->access_token==null){
            $log="无access_token";
        }else{
            $jwt=JWT::decode($jwt,$key,array('HS256'));
            $timenow=date("YmdHis",strtotime('now'));
            if(!($jwt->aud==$json->username&&$timenow<$jwt->exp&&$timenow>$jwt->iat)){
                $log="超时或名称不对称";
            }
        }
   /*      $json=json_decode($_POST);
        $key="access_token";
        $jwt=JWT::decode($json->jwt, $key, array('HS256'));
    
        $timenow=date("YmdHis",strtotime('now'));
        if(!($jwt->aud==$json->username&&$timenow<$jwt->exp&&$timenow>$jwt->iat)){
            return  "";
        } */
    
        $arr=$json;
        $uid=$arr->username;//用户名为学号，也是数据库中的ID
        //$id=$arr->id;//文章ID号（为14位年月日时分秒）
        $title=$arr->title;//文章标题
        //$uid=$arr->username;//创建该文章的用户ID
       // $date=$arr->date;//创建文章的年月日时分秒
        //$tid=$arr->tid;//
        $bodyofhtml=$arr->body;//文章的内容（保存为html）
        $grade=$arr->grade;//可查看该文章的年级
    
    
        //对时间进行处理；
       // $datetime= date("YmdHis",strtotime($date));//获取当前时间
    
        $datesql= date("Y-m-d H:i:s",strtotime('now'));//
    
        //将读取到的html文件写入到硬盘文件
  /*       $file_path=__DIRART__.$datetime.$uid.'article.html';
        $body=$datetime.$uid.'article.html';//html文件的名字
        $myfile = fopen($file_path, "w") or die("Unable to open file!");
        if(fwrite($myfile, $bodyofhtml))
            $suc=1;
        else
            $suc=0;
        fclose($myfile); */
        //$suc=1保存成功；=0写入失败
        //从数据库中读取用户的password和权限
    
        $Model=new Model();
    
        //从数据库中获取一个整数型的uuid，并设置为文章的ID号
        $sql="select uuid_short();";
        $res=$Model->query($sql);
        $id=$res[0]['uuid_short()'];
        
        $sql="insert into __PREFIX__article(id,title,uid,date,body,grade)
        values ($id,'$title',$uid,'$datesql','$bodyofhtml','$grade')";
        if($Model->execute($sql)){
            $suc=1;
        }
        else
            $suc=0;
    
        $jsonsend=array(
            "username" => $uid,
            "suc"=>$suc,
            "jwt"=>$json->jwt
        );
    
        $json=json_encode($jsonsend);
        echo $json;
        //向数据库中增加表
        $this::insertNotiuser($id);
    
    }
    public function insertNotiuser($articleid){
        $Model=new Model();
        $sql="create table ".__PREFIX__."article_user".$articleid." (id bigint(12),name varchar(10),grade varchar(10),checken int(2) default 0 not null,primary key (id)) ;";
        // $sql="create table ".__PREFIX__."article_user".$articleid."(id bigint(12),name varchar(10),grade varchar(10),check int(2) default 0 not null,primary key (id));";
        $Model->query($sql);
        echo $sql."<br>";
        $sql="select grade from ".__PREFIX__."article where id=".$articleid;
        $res=$Model->query($sql);
        $grade=explode(";",$res[0]['grade']);
        $count=count($grade)-1;
        print_r($grade);
        for($i=0;$i<$count;$i++){
            $sql="insert into ".__PREFIX__."article_user".$articleid.
            "(id,name,grade) select id,name,grade from ".__PREFIX__."user where grade like\"%$grade[$i]%\";";
            echo $sql;
            $Model->query($sql);
        }
    }
    public function newVote(){
        
        $json=json_decode($GLOBALS['HTTP_RAW_POST_DATA']);
        $key="access_token";
        $jwt=$json->access_token;
        if($json->access_token==null){
            $log="无access_token";
        }else{
            $jwt=JWT::decode($jwt,$key,array('HS256'));
            $timenow=date("YmdHis",strtotime('now'));
            if(!($jwt->aud==$json->username&&$timenow<$jwt->exp&&$timenow>$jwt->iat)){
                $log="超时或名称不对称";
            }
        }
      
        $arr=$json;
       // $username=$arr->username;//用户名为学号，也是数据库中的ID
        $title=$arr->title;//文章标题
        $uid=$arr->username;//创建该文章的用户ID
        $date=date("YmdHis",strtotime('now'));//创建投票开始的年月日时分秒
        $enddate=$arr->enddate;//投票截止年月日时分秒
        $body=$arr->content;//
        $type=$arr->type;
       // $bodyofhtml=$arr->body;//投票的内容（保存为html）
        $option=$arr->options;//投票的选项（按照英文字符的;区分如“我的家;在东北;松花江上;”）
       // $grade=$arr->grade;//可查看该投票的年级
    

      /*   $title="wulidianzixueyuan";//$arr->title;//文章标题
        $uid="111111";//$arr->username;//创建该文章的用户ID
        $date=date("YmdHis",strtotime('now'));//创建投票开始的年月日时分秒
        $enddate=date("YmdHis",strtotime('now'));//$arr->enddate;//投票截止年月日时分秒
        $body="20160307wulidianzixueyuan";//$arr->content;//
        $type="单选";//$arr->type;
        // $bodyofhtml=$arr->body;//投票的内容（保存为html）
        $option=$arr->options;//投票的选项（按照英文字符的;区分如“我的家;在东北;松花江上;”）
        // $grade=$arr->grade;//可查看该投票的年级 */
        if($type=="单选")
            $type=0;
        else $type=1;
        
        //对时间进行处理；
        $datetime= date("YmdHis",strtotime($date));//获取当前时间
        $id=$datetime;
    
        $datesql= date("Y-m-d H:i:s",strtotime($datetime));//放入数据库的时间格式
        $enddatesql=date("Y-m-d H:i:s",strtotime($enddate));//放入数据库的时间格式
    
        //对投票选项进行处理
        $contents=explode(";",$decoded->options);//此处为投票具体内容
        $count=count($contents)-1;//总共有多少个投票内容
    
        //将读取到的html文件写入到硬盘文件
      /*   $file_path=__DIRART__.$datetime.$uid.'vote.html';
        $body=$datetime.$uid.'vote.html';//html文件的名字
        $myfile = fopen($file_path, "w") or die("Unable to open file!");
        if(fwrite($myfile, $bodyofhtml))
            $suc=1;
        else
            $suc=0;
        fclose($myfile); */
        //$suc=1保存成功；=0写入失败
    
        //投票信息里加入字段
        //从数据库中获取一个整数型的uuid，并设置为文章的ID号
        $Model=new Model();
        $sql="select uuid_short();";
        $res=$Model->query($sql);
        $id=$res[0]['uuid_short()'];
    
        /* $sql="insert into __PREFIX__vote(id,title,body,begtime,endtime,uid,tid,options,grade) values (
         uuid_short(),'$title',$body,'$datesql','$enddatesql',$uid','$tid','$body','$grade')";
         *///
        $sql="insert into ". __PREFIX__."vote (id,title,type,body,begtime,endtime,options) values (
        $id,'$title',$type,'$body','$datesql','$enddatesql','$option')";
    
        if($Model->execute($sql))
            $suc=1;
        else
            $suc=0;
        
        //投票选项里加入字段
        if($suc){
            for($i=0;$i<$count;$i++){
                $sql="insert into ".__PREFIX__."vote_options(id,vid,content) values ($i,$id,$contents[$i])";
                $Model->query($sql);
            }
        }
    
        $jsonsend = array(
            "username" => $uid,
            "suc"=>$suc,
             "body"=>$body,
            "jwt"=>$arr->jwt
        );
    
        $jsonsend=json_encode($jsonsend);
        echo $jsonsend;
    
        $this::insertVoteuser($id);
         
    }
    public function insertVoteuser($voteid){
        $Model=new Model();
        $sql="create table ".__PREFIX__."vote_user".$voteid." (id bigint(12),name varchar(10),grade varchar(10),choose int(2) default 0 not null,options varchar(255),primary key (id)) ;";
        $Model->query($sql);
    
        $sql="select grade from ".__PREFIX__."vote where id=".$voteid;
    
        $res=$Model->query($sql);
        $grade=explode(";",$res[0]['grade']);
        echo "11111<br>";
        $count=count($grade)-1;
        for($i=0;$i<$count;$i++){
            $sql="insert into ".__PREFIX__."vote_user".$voteid.
            "(id,name,grade) select id,name,grade from ".__PREFIX__."user where grade like\"%$grade[$i]%\";";
            $Model->query($sql);
        }
    }
    
    public function uploadFile(){
        $filetmpname = __DIRART__.'test.xls';//APP_PATH.'public/Uploads/624.xls';
      
        Vendor('Classes.PHPExcel');
        $objPHPExcel = \PHPExcel_IOFactory::load($filetmpname);
        $arrExcel = $objPHPExcel->getSheet(0)->toArray();
       
        //查询数据库的字段
        $m = M('user');
        $fieldarr = $m->query("describe __PREFIX__user");
        
        foreach($fieldarr as $v){
            $field[] = $v['Field'];
    
        }
        //  array_shift($field);//删除自动增长的ID
        //循环给数据字段赋值
        foreach($arrExcel as $v){
            $fields[] = array_combine($field,$v);//将excel的一行数据赋值给表的字段
        }
       
        //批量插入
        $countids=count($fields);
        echo $countids;
        for($i=0;$i<$countids;$i++){
            $m->add($fields[$i]);
            echo $i;
            echo $m->getLastSql();
        }
    }
    
    
    
}