<?php
namespace Home\Controller;
//namespace Home\Controller\Article;

use Think\Model;
use Firebase\JWT\JWT;
use Common\Controller\AjaxController;
require './ThinkPHP/Library/Vendor/autoload.php';
require './ThinkPHP/Library/Vendor/Classes/PHPExcel.php';
require './ThinkPHP/Library/Vendor/Classes/messagePush-master/Pusher.php';

import(Vendor.Classes.Writer.Excel5.php);
import(Vendor.Classes.IOFactory.php);

class AdminController extends AjaxController {
    
    public function getScanList(){
        $sqlplus="order by id desc";
    
        $sql="select * from ".__PREFIX__."scans ".$sqlplus;
        $Model=new Model();
        $res= $Model->query($sql);
        $resjson=json_encode($res);
    
        $jsonsend=array(
           
            "list"=>$resjson,
        );
        $json=json_encode($jsonsend);
        //echo $json;
        echo $json;
    }
    
    public function getScanDetail(){
        //获取客户端发送的json
        $arr=json_decode($GLOBALS['HTTP_RAW_POST_DATA']);
        $username=$arr->username;
        $sql="select count from ".__PREFIX__."scans where id=".$username;
        $Model=new Model();
        $res= $Model->query($sql);
        $count=$res[0]['count']-1;
        $scanname="0";
        $sql="select scanname from ".__PREFIX__."scan where userid =".$username." and scanid != 0";
        
        //$sql="select scanname from ".__PREFIX__."scan where userid =".$username;
        $res= $Model->query($sql);
       
        $scans=json_encode($res);
        
        $jsonsend=array(
            "username"=>$username,
            "count"=>$count,
            "scans"=>$scans
        );
        $json=json_encode($jsonsend);
        echo $json;
    }
   public function updatescan(){
       $json=json_decode($GLOBALS['HTTP_RAW_POST_DATA']);
      /*  $key="access_token";
       $jwt=$json->access_token;
       
       if($json->access_token==null){
           $log="无access_token";
       }else{
           $jwt=JWT::decode($jwt,$key,array('HS256'));
           $timenow=date("Y-m-d",strtotime('now'));
           if(!($jwt->aud==$json->username&&$timenow<$jwt->exp&&$timenow>$jwt->iat)){
               $log="超时或名称不对称";
           }
       } */
       $Model= new Model();
       
       $title=$json->title;
       $ids=$json->updated;
       $count=count($ids);
       
       $sql="select uuid_short();";
       $res=$Model->query($sql);
       $scanid=$res[0]['uuid_short()'];
      
       
       for($i=0;$i<$count;$i++){
           $userid=$ids[$i]->id;
           $username=$ids[$i]->name;
           
           $sql="insert into ".__PREFIX__."scan (userid,username,scanid,scanname) values ($userid,'$username',$scanid,'$title');";
           $Model->query($sql);
           $Model->getLastSql();
       }
      
   }
   
   public function addUser(){
       //获取客户端发送的json
       $json=json_decode($GLOBALS['HTTP_RAW_POST_DATA']);
       print_r($json);
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
       $id = $arr->id;//用户名为学号，也是数据库中的ID
       $name=$arr->name;
       $mailbox=$arr->mailbox;
       $psw=$arr->id;
       $authority=$arr->authority;
       $grade=$arr->grade;
       $art = $arr->id;//文章的id号
       
       if($authority=="管理员")
           $authority="admin";
       else
           $authority="user";
       
       
       $Model=new Model();
       $sql="insert into ". __PREFIX__."user (id,name,mailbox,psw,authority,grade) values ($id,'$name','$mailbox',$psw,'$authority','$grade');";
       
       if($Model->execute($sql))
           $suc=1;
       else
           $suc=0;
       
       
       $jsonsend=array(
           "username" => $json->username,
           "suc"=>$suc,
           "access_token"=>$json->access_token
       );
       
   } 
    
    //上传用户名册文件
   public function impUser(){
        if (!empty($_FILES)) {
            
            import('ORG.Net.UploadFile');
           $upload = new \Think\Upload();
           $upload->exts = array('xlsx','xls');// 设置附件上传类型
           $upload->maxSize   =     3145728 ;// 设置附件上传大小
           $upload->rootPath  =     'D:/Coding/xampp/htdocs/dashboard/PHYMAN/Background/Home/contents/'; // 设置附件上传根目录
           $upload->savePath  =     ''; // 设置附件上传（子）目录
           $upload->saveName = 'time';//array('date', '');
           $info   =   $upload->upload();
            if(!$info) {// 上传错误提示错误信息
                 echo $upload->getError();
            } else {
    
            }
            vendor("PHPExcel.PHPExcel");
            $file=$upload->rootPath.$info['file']['savename'];
            
          
            $this:: uploadFile($file);
            
            }else
            {
            echo "请选择上传的文件";
            }
             
    
     }
        
        
       //读取用户文件然后插入数据库 
   public function uploadFile($filetmpname){
       
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
            for($i=0;$i<$countids;$i++){
                $m->add($fields[$i]);
            }
        }
    public function addNotiFile(){
        if (!empty($_FILES)) {
        
            import('ORG.Net.UploadFile');
            /* $config=array(
             'allowExts'=>array('xlsx','xls'),
             'savePath'=>'./Public/upload/',
             'saveRule'=>'time',
            ); */
            $upload = new \Think\Upload();
            $upload->exts = array('xlsx','xls','doc','docx','ppt','pptx','rar','zip','pdf');// 设置附件上传类型
            $upload->maxSize   =     3145728 ;// 设置附件上传大小
            $upload->rootPath  =     'D:/Coding/xampp/htdocs/dashboard/PHYMAN/Background/Home/contents/'; // 设置附件上传根目录
            $upload->savePath  =     ''; // 设置附件上传（子）目录
            $upload->saveName = 'time';//array('date', '');
            $info   =   $upload->upload();
            if(!$info) {// 上传错误提示错误信息
                echo $upload->getError();
            } else {
        
            }
            $file=$upload->rootPath.$info['file']['savename'];
            $jsonsend=array(
                "filedir"=>$info['file']['savename']
            );
            
            $json=json_encode($jsonsend);
            echo $json;
        }else
        {
            echo "请选择上传的文件";
        }
    }
    public function newNoti(){
        //获取客户端发送的json
        $arr=json_decode($GLOBALS['HTTP_RAW_POST_DATA']);
        
        $uid=$arr->uid;//用户名为学号，也是数据库中的ID
        //$id=$arr->id;//文章ID号（为14位年月日时分秒）
        $title=$arr->title;//$arr->noti->title;//文章标题
        //$uid=$arr->username;//创建该文章的用户ID
       // $date=$arr->date;//创建文章的年月日时分秒
        //$tid=$arr->tid;//
        $bodyofhtml=$arr->content;//$arr->noti->content;//文章的内容（保存为html）
        $grade=$arr->grade;//$arr->noti->viewlevel;//可查看该文章的年级
        $filedir=$arr->filedir;
        $grades="";
        for($i=0;$i<count($grade);$i++){
            $grades=$grades.$grade[$i].";";
         }
    
    
        //对时间进行处理；
       // $datetime= date("YmdHis",strtotime($date));//获取当前时间
    
        $datesql= date("YmdHis",strtotime('now'));//
        $Model=new Model();
    
        //从数据库中获取一个整数型的uuid，并设置为文章的ID号
        $sql="select uuid_short();";
        $res=$Model->query($sql);
        $id=$res[0]['uuid_short()'];
        
        if($filedir!=""&$uid!=null){
            $sql="insert into __PREFIX__article(id,title,uid,date,body,grade,filedir) 
            values ($id,'$title',$uid,'$datesql','$bodyofhtml','$grades','$filedir')";
        }else {
            $sql="insert into __PREFIX__article(id,title,uid,date,body,grade) 
            values ($id,'$title',$uid,'$datesql','$bodyofhtml','$grades')";
        }
        $Model->query($sql);
        $suc=1;
        $datesql= date("Y-m-d",strtotime( $datesql));
        $jsonsend=array(
            "title"=>$title,
            "date"=>$datesql,
            "jwt"=>$json->jwt
        );
    
        $json=json_encode($jsonsend);
       
        //向数据库中增加表
        $this::insertNotiuser($id);
        $config = array(
            'from' => '123',
            'to' => '',
            'content' => $title,
            'viewlevel' => '1',
            'action' => '1');
        
        vendor("messagePush-master.Pusher");
        vendor("messagePush-master.MessageBuilder");
        
        $result = \Pusher::push((new \MessageBuilder($config))->build());
        
        
    
    }
    public function message(){
        
        $Model=new Model();
       
        $sqlplus="order by date desc LIMIT 1";
        $sql="select id,title,content,date from ".__PREFIX__."article ".$sqlplus;
        $noti= $Model->query($sql);
        
        
        $sqlplus="order by begtime desc LIMIT 1";// LIMIT $start,$pagesize";
        $sql="select id,title,begtime as date from ".__PREFIX__."vote ".$sqlplus;
        $vote= $Model->query($sql);

        if($noti[0]['date']<$vote[0]['begtime']){
            $type="vote";
            $message=json_encode($vote[0]);
        }
        else{ 
            $type="noti";
            $message=json_encode($noti[0]);
        }
        
        $jsonsend=array(
            "message"=>$message,
            "type"=>$type
        );
        $json=json_encode($jsonsend);
        echo $json;
                
        
        
    }
    public function insertNotiuser($articleid){
        
        $Model=new Model();
        $sql="create table ".__PREFIX__."article_user".$articleid." (id bigint(12),name varchar(10),grade varchar(10),checken int(2) default 0 not null,primary key (id));";
        $Model->query($sql);
        $sql="select grade from ".__PREFIX__."article where id=".$articleid;
        $res=$Model->query($sql);
        $grade=explode(";",$res[0]['grade']);
        $count=count($grade)-1;
        for($i=0;$i<$count;$i++){
            $sql="insert into ".__PREFIX__."article_user".$articleid.
            "(id,name,grade) select id,name,grade from ".__PREFIX__."user where grade like\"%$grade[$i]%\";";
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
            $timenow=date("Y-m-d",strtotime('now'));
            if(!($jwt->aud==$json->username&&$timenow<$jwt->exp&&$timenow>$jwt->iat)){
                $log="超时或名称不对称";
            }
        }
      
        $arr=$json;
       // $username=$arr->username;//用户名为学号，也是数据库中的ID
        $title=$arr->title;//文章标题
        $uid=$arr->username;//创建该文章的用户ID
        $enddate=date("Y-m-d",strtotime($arr->date));//投票截止年月日时分秒
        $body=$arr->content;//
        $type=$arr->type;
        $grade=$arr->grades;
        $option=$arr->options;//投票的选项（按照英文字符的;区分如“我的家;在东北;松花江上;”）
       
       
        $grades="";
        for($i=0;$i<count($grade);$i++){
            $grades=$grades.$grade[$i].";";
            
        }
       
        if($type=="单选")
            $type=0;
        else if($type=="多选") $type=1;
        else $type=null;
        
        //对时间进行处理；
        $datesql= date("Y-m-d H:i:s",strtotime('now'));//放入数据库的时间格式
        $enddatesql=date("Y-m-d",strtotime($enddate));//放入数据库的时间格式
    
        //对投票选项进行处理
        $contents=explode(";",$option);//此处为投票具体内容
        $count=count($contents)-1;//总共有多少个投票内容
    
    
        //投票信息里加入字段
        //从数据库中获取一个整数型的uuid，并设置为文章的ID号
        $Model=new Model();
        $sql="select uuid_short();";
        $res=$Model->query($sql);
        $id=$res[0]['uuid_short()'];
    
       
        $sql="insert into ". __PREFIX__."vote (id,title,type,body,begtime,endtime,options,grade) values (
        $id,'$title',$type,'$body','$datesql','$enddatesql','$option','$grades')";
        $Model->query($sql);
        $suc=1;
        
        //投票选项里加入字段
        if($suc==1){
            for($i=0;$i<$count;$i++){
                $j=$i+1;
                $sql="insert into ".__PREFIX__."vote_options (vid,content,id) values ($id,'$contents[$i]',$j)";
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
    
       // $sql="select grade from ".__PREFIX__."vote where id=".$voteid;
    
        //$res=$Model->query($sql);
        //$grade=explode(";",$res[0]['grade']);
      //  $count=count($grade)-1;
      //  for($i=0;$i<$count;$i++){
            $sql="insert into ".__PREFIX__."vote_user".$voteid.
            "(id,name,grade) select id,name,grade from ".__PREFIX__."user";// where grade like\"%$grade[$i]%\";
            $Model->query($sql);
        //}
    }
    
    
    
    
    
}