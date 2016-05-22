<?php
namespace Home\Controller;
use Common\Controller\AjaxController;
use Think\Model;
require './ThinkPHP/Library/Vendor/autoload.php';
use Firebase\JWT\JWT;
use Think\Template\Driver\Mobile;
require './ThinkPHP/Library/Vendor/Classes/messagePush-master/Pusher.php';

import('Vendor.mail');
class TestfunctionController extends AjaxController {
    public function insertuser1(){
        $articleid="123456789";
        $Model=new Model();
        
        
        
        
        $sql="select count(*) from ".__PREFIX__."article where id=".$articleid;
        $res=$Model->query($sql);
        print_r($res);
        if($res[0]['count(*)']!='0'){
            echo "111";
                
            print_r($res);
        }
        else print_r( $res);
        die;
    
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
    public function addscan(){
        $Model=new Model();
        $sql="update ".__PREFIX__."scan ,".__PREFIX__."user set ".__PREFIX__."scan.grade = ".__PREFIX__."user.grade where id=userid ;";
        $Model->query($sql);
        echo $sql;
        
    }
    public function votetest(){
        $grade=["大三", "研一"];
        $grades="";
        for($i=0;$i<count($grade);$i++){
            $grades=$grades.$grade[$i].";";
        
        }
        echo count($grade);
        echo $grades;
    }
    public function scan(){
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
    public function Vote(){
       
        $option='3;';
        
        $username=201522040840;//$arr->username;//用户名为学号，也是数据库中的ID
        $voteid="96537863713193988";//$arr->id;//投票ID号（为14位年月日时分秒）
    
        $Model=new Model();
        $sql="update ".__PREFIX__."vote_user".$voteid." set options= ".$option." where id=".$username;
        $Model->query($sql);
    echo $sql;
        $sql="update  ".__PREFIX__."vote_user".$voteid." set choose=1 where id=".$username;;
        $Model->query($sql);
         
        //投票结果
    }
    public function stat(){
       
        $articleid="96561627280703503";//$json->id;
    
    
        $Model=new Model();
        $sql="select id,name,checken from ".__PREFIX__."artic
            le_user".$articleid." where checken=1";
        echo $sql;
        $res=$Model->query($sql);
        $read=$res;
        $read=json_encode($read);
    
        $sql="select id,name,checken from ".__PREFIX__."article_user".$articleid." where checken=0";
        $res=$Model->query($sql);
        $unread=$res;
        $unread=json_encode($unread);
    
    
    
        $jsonsend=array(
            'unread'=>$unread,
            'read'=>$read
        );
        $json=json_encode($jsonsend);
        echo $json;
    
    
    
    }
    public function newNoti(){
        //获取客户端发送的json
        $arr=json_decode($GLOBALS['HTTP_RAW_POST_DATA']);
    
        $uid=111;//用户名为学号，也是数据库中的ID
        //$id=$arr->id;//文章ID号（为14位年月日时分秒）
        $title="123";//$arr->title;//$arr->noti->title;//文章标题
        //$uid=$arr->username;//创建该文章的用户ID
        // $date=$arr->date;//创建文章的年月日时分秒
        //$tid=$arr->tid;//
        $bodyofhtml="<p>111</p>";//$arr->content;//$arr->noti->content;//文章的内容（保存为html）
        $grade="研一;研二;研三";//$arr->noti->viewlevel;//可查看该文章的年级
    
    
        //对时间进行处理；
        // $datetime= date("YmdHis",strtotime($date));//获取当前时间
    
        $datesql= date("Y-m-d",strtotime('now'));//
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
    
    
    
    
    
    public function insertNotiuser($articleid){
    
        $Model=new Model();
        $sql="create table ".__PREFIX__."article_user".$articleid." (id bigint(12),name varchar(10),grade varchar(10),checken int(2) default 0 not null,primary key (id));";
        // $sql="create table ".__PREFIX__."article_user".$articleid."(id bigint(12),name varchar(10),grade varchar(10),check int(2) default 0 not null,primary key (id));";
        $Model->query($sql);
        print_r($sql);
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
    
    
    public function testjwt111(){
        $token=array(
            "iss"=>"phyman",
          
            "viewlevel"=>"1",
            "permission"=>"admin"
        );
        $key="access_token";
        $jwt=JWT::encode($token, $key);
        echo $jwt;
       // print_r(JWT::decode($jwt, $key));
    }
    
    /* public function newNoti(){
        
        $config = array(
            'from' => '123',
            'to' => '',
            'content' => "111",
            'viewlevel' =>"1",
            'action' => '1');
    
        vendor("messagePush-master.Pusher");
        vendor("messagePush-master.MessageBuilder");
    
        $result = \Pusher::push((new \MessageBuilder($config))->build());
        print_r( $result);
    
    
    
    } */
    
    
    public function update(){
        
        $tt=array (
            "noti"=>array (
                "title"=>"new noti2",
                "content"=> "raw html data",
                "viewlevel"=> "102"
                 ),
            "jwt"=>"232431wwewe"
         );
        $json=json_encode($tt);
        print_r($json);
        echo $json['noti'];
        $json=json_decode($json);
     //   print_r($json);
       echo $json->noti->title;
        die;
        
        $Model=new Model();
     $hasid=true;
        while($hasid){
           for($i=0;$i<12;$i++){
                if($i==0)
                    $b[]=rand(3,9);
                else
                    $b[]=rand(0,9);
                
            }
            $id=join("",$b);
            $sql="select * from ".__PREFIX__."user where id=".$id;
            $res=$Model->query($sql);
            print_r($res);
            if($res==null)
                $hasid=false;
        }
        echo $id;
        die;
        $Model=new Model();
        $sql="update " .__PREFIX__."user set authority='管理员' where authority=1";
        $Model->query($sql);
        $sql="update " .__PREFIX__."user set authority='学生' where authority=3";
        $Model->query($sql);
    }
    
    public function index(){
      /*   print_r($_POST);
        $this->display("./Background/Home/View/Index/index.html");
        DIE; */
        //$json=$GLOBALS['HTTP_RAW_POST_DATA'];
        
        //$json->username="ivy";
        $json=array(
            "jwt"=>123444,
            "user"=>array(
                ["id"=>1,
                    "name"=>11
                 ],[
                     "id"=>111,"name"=>"123"
                     
                 ]               
            )
        );
        $json=json_encode($json);
//       $this->assign('row',$json);
      //  $this->display("./Background/Home/phyman-1/modules/user/views/List.html");
        print_r($json);
       $this->display("./Background/Home/phyman-1/index.html");
        die;
        //printWriter.write($json);
        $this->ajaxReturn($json,'JSON');
        die;
        print_r($_POST);
        echo "111111111111111111111";
        $this->display("./Background/Home/View/Index/test.html");
        die;
        $Model=new Model();
        $choose=0;
        //共有多少人投票
        $sql="select id,pwd from  ".__PREFIX__."user where id=1";
        $res=$Model->query($sql);
        if($res==null)
            echo "1";
        else echo"2";
        die;
        $voteid=1;
        $Model=new Model();
        $choose=0;
        //共有多少人投票
        $sql="select count(*) from  ".__PREFIX__."vote_user".$voteid." where choose=1";
        $res=$Model->query($sql);
        
        $resultofvote=Array(
            'sum'=>$res[0]['count(*)'],
            'options'=>Array(
        
            ),
        );
        
        //有这么多种选项
        $sql="select count(*) from __PREFIX__vote_options where vid=".$voteid;
        $res=$Model->query($sql);
        $count=$res[0]['count(*)'];
        
        $sql="select id,content from __PREFIX__vote_options where vid=".$voteid;
        $res=$Model->query($sql);
        
        
        //每种选项有多少人选择
        for($i=0;$i<$count;$i++){
            $id=$res[$i]['id'];
            $content=$res[$i]['content'];
        
            $sql="select count(*) from __PREFIX__vote_user".$voteid." where option like \"%$id%\"";
            $temp=$Model->query($sql);
            $num=$temp[0]['count(*)'];
            $s=array(
                'opt'=>$id,
                'conten'=>$content,
                'num'=>$num
            );
            array_push($resultofvote['options'],$s);
        
        }
        $resultofvote=json_encode($resultofvote);
        print_r($resultofvote);
        die;

    
     
        A('Getvotexls')->impUser;
        die;
        $Model=new Model();
        
        
        //从数据库中获取一个整数型的uuid，并设置为文章的ID号
        $sql="select uuid_short();";
        $res=$Model->query($sql);
        print_r($res);
        echo $res[0]['uuid_short()'];
        die;;
       /*  $function="Articlelist";
        $username="2222";
        $log=1;
        $authority=3;
        
        
        $datetime=date("YmdHis",strtotime('now'));
        $exptime=date("YmdHis",strtotime("$datetime+1hours"));
        $token=array(
            "iss"=>"phyman",
            "aud"=>$username,
            "exp"=>$exptime,
            "iat"=>$datetime
        );
        $key="access_token";
        $jwt=JWT::encode($token, $key);
        
        //生成发送给客户端的json信息
        
        $jsonsend = array(
            "username" => $username,
            "log"=>$log,
            "authority"=>$authority,
            "jwt"=>$jwt
        );
        
        $jsonsend=json_encode($jsonsend);
        
        $json=json_decode( $jsonsend);
        $this->getfunction($function,$json);
        die; */
        
        
        
        //获取客户端发送的json
        $json=json_decode($_POST);
       
       /* 判断客户端请求方法
        * 如果请求内容为login，则实例化login方法
        * 如果为其他方法，则首先进行jwt的验证
        * 验证内容主要为1、时间是否正确
        * 2、jwt中包含的username和发送请求的username是否为同一个
        * 验证通过后再进行数据传输和返回 */
        $key="access_token";
        if($json->function=="Login"){
            $login=A('Login');
            $login->index();
        }
        else{
            $jwt=JWT::decode($json->jwt, $key);
            
            
           /*  "iss"=>"phyman",
            "sud"=>$username,
            "exp"=>$exptime,
            "iat"=>$datetime
             */
            $timenow=date("YmdHis",strtotime('now'));
            if($jwt->aud==$json->username&&$timenow<$jwt->exp&&$timenow>$jwt->iat)
                $this->getfunction($json->function,$json);
        }
    }
    //实例化除login方法外的其他方法
    public function getfunction($fuc,$json){
        
        $function=A($fuc);
        $function->index($json);

        die;
        switch ($fuc){
            case "Articlenew":
                $function=A('Articlenew');
                break;
            case "Articlelist":
                $function=A('Articlelist');
                break;
            case "Getarticle":
                $function=A('Getarticle');
                break;
            case "Getarticlexls":
                $function=A('Getarticlexls');
                break;    
            case"Votenew":
                $function=A('Votenew');
                break;
            case"Votelist":
                $function=A('Votelist');
                break;
            case"Getvote":
                $function=A('Getvote');
                break;
            case"Getvotexls":
                $function=A('Getvotexls');
                break;
            case"Uservote":
                $function=A('Uservote');
                break;
            
                
        }
        $function->index();
        
        
        
        
    }
    
    
    
    
    public function xlstest(){

        $fname=array("Bill","Steve","Mark");
        $age=array("60","56","31");
        
        print_r($fname);
        print_r($age);
        
        $c=array_combine($fname,$age);
        print_r($c);
        //Array ( [Bill] => 60 [Steve] => 56 [Mark] => 31 )
        die;
      /*   $colors = array("red","green","blue","yellow");
        foreach ($colors as $value) {
            echo "$value <br>";
        }
        print_r($value);
        die; */
        $m = M('user');
        $fieldarr = $m->query("describe __PREFIX__user");
        foreach($fieldarr as $v){
            $field[] = $v['Field'];
        }
        
        print_r($field);
    }
    
    public function sendmail(){
    
        
        $mailbox="linxiaoyi_j@163.com";
        $mail="dd2dt";
        //******************** 配置信息 ********************************
        $smtpserver = "smtp.163.com";//SMTP服务器
        $smtpserverport =25;//SMTP服务器端口
        $smtpusermail = "linxiaoyi_j@163.com";//SMTP服务器的用户邮箱
        $smtpemailto = $mailbox;//发送给谁
        $smtpuser = "linxiaoyi_j";//SMTP服务器的用户帐号
        $smtppass = "密码";//SMTP服务器的用户密码
    
        $mailtitle = "Change password";//邮件主题
        $mailconten="您的phyman账号密码已成功修改为".$mail."请及时修改密码";//邮件内容
        $mailtype = "TXT";//邮件格式（HTML/TXT）,TXT为文本邮件
        //************************ 配置信息 ****************************
        $smtp = new \smtp($smtpserver,$smtpserverport,true,$smtpuser,$smtppass);//这里面的一个true是表示使用身份验证,否则不使用身份验证.
        $smtp->debug = false;//是否显示发送的调试信息
        $state = $smtp->sendmail($smtpemailto, $smtpusermail, $mailtitle, $mailconten, $mailtype);
        if($state==""){
            echo "对不起，邮件发送失败！您还可以发送学号，姓名到管理员邮箱。";
    
        }else
            echo "邮件发送成功，请查收，并尽快修改密码";
    
        return $log;
    
    }
    public function testurl(){
        
    }
    public function insertuser($id){
        echo "insertuser"."<br>";
    }
    
    
    public function testoprions(){
        
        $key="123";
        $Model= new Model();
        $voteid=1;
        $sql="select count(*) from __PREFIX__vote_options where vid=".$voteid;
        $res=$Model->query($sql);
        $resultofvote=Array(
            'sum'=>$res[0]['count(*)'],
            'options'=>Array(
                ),
        );
        for($i=1;$i<3;$i++){
            $sql="select id,content from __PREFIX__vote_options where vid=".$voteid;
            $res=$Model->query($sql);
            $num=$temp[0]['count(*)'];
            $s=Array(
                'opt'=>$res[$i]['id'],
                'conten'=>$res[$i]['content'],
            );
            array_push($resultofvote['options'],$s);
            
        }
        $resss=json_encode($resultofvote);
       print_r($resss);
       
       echo "<br>";
       $token = array(
       
           'result'=>$resss,
       );
       
       // echo 'success';
       /**
        * IMPORTANT:
        * You must specify supported algorithms for your application. See
        * https://tools.ietf.org/html/draft-ietf-jose-json-web-algorithms-40
        * for a list of spec-compliant algorithms.
       */
       //$token=json_encode($token);
       
       
       $token=json_encode($token);
       $jwt = JWT::encode($token, $key);
       echo $jwt;
       //向数据库中增加表
       $this::insertuser($id);

       $decoded = JWT::decode($jwt, $key, array('HS256'));//json
        print_r($decoded);
       
       
       
       
       // echo $resultofvote['sum'];
        die;
        
   /*  $sql="select uuid_short() Length=15;";
    print_r($Model->query($sql)); */
    /*     $date=date("Ymd",strtotime('now'));
        echo $date;
        $datetime=date("Y-m-d H:i:s",strtotime($date));
        echo $datetime; */
   // print_r($res); 
   $sql="select uuid_short();";
   $uuid=$Model->query($sql);
//   print_r( $uuid);
        $id=$uuid[0]['uuid_short()'];$title='wwwww';$uid=201522040840;$datesql='';$tid=1;$body='dddddd.html';$grade=1;
        echo $id;
        $sql="insert into __PREFIX__article(id,title,uid,date,tid,body,grade)
        values ($id,'$title','$uid','$datesql','$tid','$body','$grade')";
       // $sql='insert into __PREFIX__authority (id,name) values (uuid_short(),\'测试\')';
        
       if($id=$Model->execute(($sql)))
           echo '111';
       else echo '33';
        
      /*   
        $sql="select * from __PREFIX__authority LIMIT 1,10";
        $res=$Model->query($sql);
        print_r($res);
        
        $datetime= date("YmdHis",strtotime('now'));
        $options=explode(";","我的家;在东北;松花江上");
        //$decoded->options);//此处为投票具体内容
        $count=count($options);//总共有多少个投票内容
        for($i=0;$i<$count;$i++){
            $optionids=$optionids.$datetime.$i.";";
        }
        echo $optionids;
         */
        
        
        
        
        
        /* $Model=new Model();
        
        $sql="select options from __PREFIX__vote where id=123";
        $res=$Model->query($sql);
        echo $sql;
        print_r($res);
        
        $optionid=explode(";", $res[0]['options']);
        
        print_r($optionid);
        $ph="phyman";
        $sql="select content from ".__PREFIX__."vote_options where id=$optionid[0]";
        $res2=$Model->query($sql);
        echo $sql;
        echo $res2;
        print_r($res2); */
        
        
    }
    public function testjwt(){
        $sss;
        $token = array(
            "iss" => "http://example.org",
            "aud" => "http://example.com",
            "iat" => "伪代码;玩儿;喜欢;",
            "nbf" => $sss,
            "username" => $id,
            "log"=>$log,
            "authority"=>$authority
        ); 
        
        /**
         * IMPORTANT:
        * You must specify supported algorithms for your application. See
        * https://tools.ietf.org/html/draft-ietf-jose-json-web-algorithms-40
        * for a list of spec-compliant algorithms.
        */
        $key="111";
        $jwt = JWT::encode($token, $key);
        
       // echo $jwt;
        
        $decoded = JWT::decode($jwt, $key, array('HS256'));//json
      //  echo $decoded->iat;
        print_r($start=explode(";",$decoded->iat));
        echo count($start);
       
 /*        print_r($decoded);
        $arr=json_decode($decoded);
        
        if($arr->nbf!=null)
            echo "not null";
        else */
        //    echo "null";
        //print_r($decoded);
    }
    public function testmultijson(){
        $Model =new Model();
        $tid="时间";
  //      $sqlofdate="select * from __PREFIX__article where date like \"%$date%\"";
        /* $sqloftid="select * from  __PREFIX__article where tid=(
          select id from __PREFIX__type where name=\"$tid\")";
          
      echo $sqloftid; */
          $sql="select id,title,date,grade from __PREFIX__article order by id desc";
        echo $sql;
        
        $res=$Model->query($sql);
        print_r($res);
        
    }
    public function test(){
       /*  $title='1';//$arr->title;//按照文章标题选取文章；
        $uid='';//$arr->username;//按照作者选取文章；
        $date='';//$arr->date;//按照文章的发表日期选取文章
        $tid='';//$arr->tid;//按照文章的类型选取文章；
        $sql="select * from __PREFIX__article where title=$title";
        $Model=new Model();
        $res=$Model->query($sql);
         
        echo $sql;
        print_r($res); */
        
        echo 'go';
        $file_path=__DIRART__.'testread.html';
        //  echo $file_path;
        //判断是否有这个文件
        if(file_exists($file_path)){
            if($fp=fopen($file_path,"a+")){
                //读取文件
                $conn=fread($fp,filesize($file_path));
                echo $conn;
                //   return $conn;
                //替换字符串
                $conn=str_replace("rn","<br/>",$conn);
                print($conn)."<br/>";
            }else{
                echo "文件打不开";
            }
        }else{
            echo "没有这个文件";
        }
        fclose($fp);
        
        
        
    }
    public function authority(){
        $Model =new Model();
        $sql="select * from __PREFIX__authority";
        $res=$Model->query($sql);
        print_r($res);
        
        $jsonofres=json_encode($res);
        print_r($jsonofres);
        
    }
    public function textread(){
        //参考http://www.5idev.com/p-php_fread_fgets_fgetc_file_get_contents.shtml
        //文件路径
        $file_path=__DIRART__.'testread.html';
        echo $file_path;
        //判断是否有这个文件
        if(file_exists($file_path)){
            if($fp=fopen($file_path,"a+")){
                //读取文件
                $conn=fread($fp,filesize($file_path));
             //   return $conn;
                //替换字符串
                $conn=str_replace("rn","<br/>",$conn);
                $this->display($conn);
            }else{
                echo "文件打不开";
            }
        }else{
            echo "没有这个文件";
        }
       /*  fclose($fp);
        $file_path=__DIRART__.'testwrite1.html';
        $myfile = fopen($file_path, "w") or die("Unable to open file!");
     //   $txt = "Bill Gates\n";
      //  fwrite($myfile, $txt);
        //$txt = "Steve Jobs\n";
        fwrite($myfile, $conn);
        fclose($myfile);
        echo 'success';
         */
       // $myfile = fopen("testfile.html", "w");
        
    }
    public function textwrite(){
        //http://www.w3school.com.cn/php/php_file_create.asp
        $html= textread();
        $myfile = fopen("testfile.html", "w");
        
        
    }
  
        public function testindex(){
            // $this->Getvotexls();
            $Articlelist=A('Articlelist');
            $Articlelist->index();
            
            die;
            $token = array(
                "username" => "1222",
                "log"=>"1",
                "authority"=>"3"
      
            );
            $token=json_encode($token);
            print_r($token);
            
            $arr=json_decode($token);
            
            echo $arr->username;
            
            
            $datetime=date("YmdHis",strtotime('now'));
            echo $datetime."<br>";
            echo date("YmdHis",strtotime("$datetime+1 hours"));
             
            die;
            
            $aa="123;222;333;444;";
            $a=explode(";", $aa);
            $count=count($a)-1;
            echo $count;
            for($i=0;$i<$count;$i++){
                echo $i."   ".$a[$i]."<br>";
            }
            
            die;
            $datetime= date("Y-m-d H:i:s",strtotime('now'));//
            
            echo $datetime;//20160130151019
            $datetime1= date("YmdHis",strtotime($datetime));//
            echo $datetime1;//2016-01-30 15:10:19
            /*  $username=201522040840;//$arr->username;//用户名为学号，也是数据库中的ID
             $psw=123;//$arr->password;
             $key="access_token";
            
             //从数据库中读取用户的password和权限
             $Model=new Model();
             $res=$Model->query("select psw,authority from __PREFIX__user where id=".$username);
             $authority=$res[0]['authority'];
            
              
             //返回数据：
             //1：登录是否成功（0=成功，1=密码错误；2=该账号未注册;3=已注册）
             //2：权限（0=游客；1=管理员；2=编辑；3=用户）
            
             $psw=md5(md5(md5($psw)));
            
             if($res==null)
                 $log=2;
                 if($psw==$res[0]['psw'])
                     $log=0;
                     else
                         $log=1;
                         $token = array(
                         "username" => $username,
                         "log"=>$log,
                         "authority"=>$authority
                         ); */
            
                     /**
                      * IMPORTANT:
                      * You must specify supported algorithms for your application. See
                      * https://tools.ietf.org/html/draft-ietf-jose-json-web-algorithms-40
                      * for a list of spec-compliant algorithms.
                      */
                     /*    $jwt = JWT::encode($token, $key);
            
                     echo $jwt;
                     */
                     /*
                      //注册测试
                      $key="register_key";
            
                      $id=201522040840;//$arr->username;//用户名为学号，也是数据库中的ID
                      $name="林小艺";$arr->name;
                      $psw=123;//$arr->password;
                      $sex="女";$arr->sex;
                      $authority="1";//$arr->authority;
                      $img="";//$arr->img;
                      $grade="5";//$arr->grade;
                      $mailbox="www.google.com";$arr->mailbox;
            
                      $psw=md5(md5(md5($psw)));
            
                      //从数据库中读取用户的password和权限
                      $Model=new Model();
                      $res=$Model->query("select * from __PREFIX__user where id=".username);
                      if($res==null){
                      // $Model->query("insert into __PREFIX__authority(id,name) set ");
                      $Model->query("insert into __PREFIX__user values ('$id','$name','$sex','$psw','$authority','$img','$grade','$mailbox')");
                      $log=0;
            
                      }
                      else{
                      $log=3;
                      $authority=0;
                      }
            
                      //返回数据：
                      //1：登录是否成功（0=成功，1=密码错误；2=该账号未注册;3=已注册）
                      //2：权限（0=未注册；1=管理员；2=编辑；3=用户）
            
                      $token = array(
                      "iss" => "http://example.org",
                      "aud" => "http://example.com",
                      "iat" => 1356999524,
                      "nbf" => 1357000000,
                      "username" => $id,
                      "log"=>$log,
                      "authority"=>$authority
                      ); */
            
                     /**
                      * IMPORTANT:
                      * You must specify supported algorithms for your application. See
                      * https://tools.ietf.org/html/draft-ietf-jose-json-web-algorithms-40
                      * for a list of spec-compliant algorithms.
                      */
                     /*    $jwt = JWT::encode($token, $key);
            
                     echo $jwt;
                     */
                     /*   $decoded = JWT::decode($jwt, $key, array('HS256'));//json
                      print_r($decoded);
                      */
            
            
            
                     //   $decoded = JWT::decode($jwt, $key, array('HS256'));
                     //    $arr=json_decode($decoded);
                     /*       $username=201522040840;//$arr->username;//用户名为学号，也是数据库中的ID
                      $password=123;//$arr->password;
            
                      //从数据库中读取用户的password和权限
                      $Model=new Model();
                      $res=$Model->query("select psw,authority from __PREFIX__user where id=".$username);
                      $authority=$res[0]['authority'];
                      //返回数据：
                      //1：登录是否成功（0=成功，1=密码错误；2=该账号未注册）
                      //2：权限（1=管理员；2=编辑；3=用户）
                      if($res==null)
                          $log=2;
                          if($password==$res[0]['psw'])
                              $log=0;
                              else
                                  $log=1;
            
                                  $token = array(
                                  "iss" => "http://example.org",
                                  "aud" => "http://example.com",
                                  "iat" => 1356999524,
                                  "nbf" => 1357000000,
                                  "username" => $username,
                                  "log"=>$log,
                                  "authority"=>$authority
                                  );
            
                                  $key = "login_key";
                                  $jwt = JWT::encode($token, $key);
            
                                  echo $jwt;
            
                                  $decoded = JWT::decode($jwt, $key, array('HS256'));//json
                                  echo $decoded->iss; */
                              // print_r($decoded);
            
            
            
            
                              /*
                               $decoded = JWT::decode($jwt, $key, array('HS256'));
                               $arr=json_decode($decoded);
                               $username=$arr->username;//用户名为学号，也是数据库中的ID
                               $password=$arr->password;
            
                               //从数据库中读取用户的password和权限
                               $Model=new Model();
                               $res=$Model->query("select psw,authority from __PREFIX__user where id=".$username);
                               $authority=$res[0]['authority'];
                               //返回数据：
                               //1：登录是否成功（0=成功，1=密码错误；2=该账号未注册）
                               //2：权限（1=管理员；2=编辑；3=用户）
                               if($res==null)
                                   $log=2;
                                   if($password==$res[0]['psw'])
                                       $log=0;
                                       else
                                           $log=1;
            
                                           $token = array(
                                           "iss" => "http://example.org",
                                           "aud" => "http://example.com",
                                           "iat" => 1356999524,
                                           "nbf" => 1357000000,
                                           "username" => $username,
                                           "log"=>$log,
                                           "authority"=>$authority
                                           ); */
            
            
            
                                       /**
                                        * IMPORTANT:
                                        * You must specify supported algorithms for your application. See
                                        * https://tools.ietf.org/html/draft-ietf-jose-json-web-algorithms-40
                                        * for a list of spec-compliant algorithms.
                                        */
            
              
            
            
                                       /*
            
            
            
            
                                       $username=201522040840;
                                       $password=123;
                                       //从数据库中读取用户的password和权限
                                       $Model=new Model();
                                       $res=$Model->query("select psw,authority from __PREFIX__user where id=".$username);
                                       //$authority=$Model->query("select id from __PREFIX__authority where id=".$username);//[0]['id'];
                                       echo $res[0]['authority'];
            
                                       if($res==null)
                                           $nreg=true;
                                           if($password==$res[0]['psw'])
                                               $log=true;
                                               else
                                                   $log=false;
            
                                                   //$user = M('user');
                                                   //$USER->where("id=%d",$username)->select();
                                                   echo $res[0]['psw'];
                                                   print_r($res);
                                                   */
        }
        public function show(){
           $Model=new Model();
            
            
            $authority = M('authority');
            //  $USER->where('ID=201522040840')->select();
            $list = $authority->select();
            // echo M("authority")->getLastSql();
            //   $this->assign('list',$list);
            // $list=array('total'=>100,'row'=>$list);
            $token=json_encode($list);//json
            print_r($token);
            // $arr=json_decode($jlist);
            // echo '使用输出'.$arr->row[0]->id;
            //    print_r($list[0]);
            //$arr[0]=$list[0];
            //  echo $list[0]['id'];
            
            
            
            
            
            
            
            /*  echo 'daole';
             $id=201522040840;
             $sql="select name from __PREFIX__user where id=$id";
             $res=mysql_query($sql);
             $res=$Model->query($sql);
             $Model = new Model()  */// 实例化一个model对象 没有对应任何数据表
            //$Model->query("select * from __PREFIX__user where status=1");
            // 3.2.2版本以上还可以直接使用
            // $Model->query("select * from __USER__ where status=1");
            
            
            
            
            
          
            //json数组
            /*  $token = array(
             "iss" => "http://example.org",
             "aud" => "http://example.com",
             "iat" => 1356999524,
             "nbf" => 1357000000
            ); */
            
            /**
             * IMPORTANT:
             * You must specify supported algorithms for your application. See
             * https://tools.ietf.org/html/draft-ietf-jose-json-web-algorithms-40
             * for a list of spec-compliant algorithms.
             */
            $key = "example_key";
            $jwt = JWT::encode($token, $key);
            print_r($jwt);
            echo '<br>';
            $decoded = JWT::decode($jwt, $key, array('HS256'));//json
            print_r($decoded);
            
            $arr=json_decode($decoded);//php数组
            
            
            print_r($decoded->iss);
            echo '<br>';
            echo($arr->iss);
            echo '<br>';
            /*
             NOTE: This will now be an object instead of an associative array. To get
             an associative array, you will need to cast it as such:
             */
            
            $decoded_array = (array) $decoded;
            
            /**
             * You can add a leeway to account for when there is a clock skew times between
             * the signing and verifying servers. It is recommended that this leeway should
             * not be bigger than a few minutes.
             *
             * Source: http://self-issued.info/docs/draft-ietf-oauth-json-web-token.html#nbfDef
             */
            JWT::$leeway = 60; // $leeway in seconds
            $decoded = JWT::decode($jwt, $key, array('HS256'));
            // $decoded[0]->id;
            
            
            
            /*   $Model=new Model();
             echo 'daole';
             $id=201522040840;
             $sql="select name from __PREFIX__user where id=$id";
             // $res=mysql_query($sql);
            $res=$Model->query($sql); */
            /*  $Model = new Model() // 实例化一个model对象 没有对应任何数据表
             //$Model->query("select * from __PREFIX__user where status=1");
             // 3.2.2版本以上还可以直接使用
             $Model->query("select * from __USER__ where status=1");
            */
            
            print_r($res);
            /*        $authority = M('authority');
             //  $USER->where('ID=201522040840')->select();
             $list = $authority->select();
             // echo M("authority")->getLastSql();
             //   $this->assign('list',$list);
             // $list=array('total'=>100,'row'=>$list);
             $jlist=json_encode($list);
             // $arr=json_decode($jlist);
             // echo '使用输出'.$arr->row[0]->id;
             //    print_r($list[0]);
             //$arr[0]=$list[0];
             //  echo $list[0]['id'];
             for($i=0;$i<=2;$i++){
             //  echo '='.$list[$i]['id'].';name='.$list[$i]['name'].'<br>';
             $arr[$i]=array(
             '学号'=>$list[$i]['id'],
             '姓名'=>$list[$i]['id']);
             }
            print_r( json_encode($arr)); */
            
            
            
            /* for ($i=1; $i<=10; $i++) {
             jlist[i].id;
            
            } */
            // dump ($list->row[1]);
            //  $this->display();
            
            
            
            
            //header("Content-Type:text/html; charset=utf-8");
            /*   $Dao = M("authority"); // 实例化模型类
             // 构建写入的数据数组
             $data["id"] = "4";
             $data["name"] = "测试";//md5("123456");
             // 写入数据
             if($lastInsId = $Dao->add($data)){
             echo "插入数据 id 为：$lastInsId";
             } else {
             $this->error('数据写入错误！');
             } */
        }
        
        
        
        //EXCEL导入
        
        function impUser(){
            echo "impuser";
            die;
            if (!empty($_FILES)) {
                import("@.ORG.UploadFile");
                $config=array(
                    'allowExts'=>array('xlsx','xls'),
                    'savePath'=>'./Public/upload/',
                    'saveRule'=>'time',
                );
                $upload = new \UploadFile($config);
                if (!$upload->upload()) {
                    $this->error($upload->getErrorMsg());
                } else {
                    $info = $upload->getUploadFileInfo();
        
                }
        
                vendor("PHPExcel.PHPExcel");
                $file_name=$info[0]['savepath'].$info[0]['savename'];
                $objReader = PHPExcel_IOFactory::createReader('Excel5');
                $objPHPExcel = $objReader->load($file_name,$encode='utf-8');
                $sheet = $objPHPExcel->getSheet(0);
                $highestRow = $sheet->getHighestRow(); // 取得总行数
                $highestColumn = $sheet->getHighestColumn(); // 取得总列数
                for($i=3;$i<=$highestRow;$i++)
                {
                $data['account']= $data['truename'] = $objPHPExcel->getActiveSheet()->getCell("B".$i)->getValue();
                $sex = $objPHPExcel->getActiveSheet()->getCell("C".$i)->getValue();
                // $data['res_id']    = $objPHPExcel->getActiveSheet()->getCell("D".$i)->getValue();
                $data['class'] = $objPHPExcel->getActiveSheet()->getCell("E".$i)->getValue();
                    $data['year'] = $objPHPExcel->getActiveSheet()->getCell("F".$i)->getValue();
                        $data['city']= $objPHPExcel->getActiveSheet()->getCell("G".$i)->getValue();
                            $data['company']= $objPHPExcel->getActiveSheet()->getCell("H".$i)->getValue();
                            $data['zhicheng']= $objPHPExcel->getActiveSheet()->getCell("I".$i)->getValue();
                            $data['zhiwu']= $objPHPExcel->getActiveSheet()->getCell("J".$i)->getValue();
                            $data['jibie']= $objPHPExcel->getActiveSheet()->getCell("K".$i)->getValue();
                            $data['honor']= $objPHPExcel->getActiveSheet()->getCell("L".$i)->getValue();
                                $data['tel']= $objPHPExcel->getActiveSheet()->getCell("M".$i)->getValue();
                                $data['qq']= $objPHPExcel->getActiveSheet()->getCell("N".$i)->getValue();
                                    $data['email']= $objPHPExcel->getActiveSheet()->getCell("O".$i)->getValue();
                                    $data['remark']= $objPHPExcel->getActiveSheet()->getCell("P".$i)->getValue();
                            $data['sex']=$sex=='男'?1:0;
                            $data['res_id'] =1;
        
                                $data['last_login_time']=0;
                                $data['create_time']=$data['last_login_ip']=$_SERVER['REMOTE_ADDR'];
                                $data['login_count']=0;
                                $data['join']=0;
                                $data['avatar']='';
                            $data['password']=md5('123456');
                            M('Member')->add($data);
                             
                }
                $this->success('导入成功！');
                }else
                {
                            $this->error("请选择上传的文件");
        }
         
        
        }
}
          
/*
 //测试用数据
 // $decoded = JWT::decode($postjwt, $key, array('HS256'));
 //$arr=json_decode($decoded);
 //$username=$arr->username;//用户名为学号，也是数据库中的ID
 //$psw=$arr->password;//密码
 $key="access_token";
 $id=date("YmdHis",strtotime('now'));//;$arr->id;//文章ID号（为14位年月日时分秒）
 $title='物电学院打造“三位一体”的精英Phyman培养体系';//$arr->title;//文章标题
 $uid=201522040840;//$arr->username;//创建该文章的用户ID
 $date=date("Y-m-d H:i:s",strtotime('now'));//$arr->date;//创建文章的年月日时分秒
 $tid=1;//$arr->tid;//

 $file_path=__DIRART__.'testread.html';
 //  echo $file_path;
 //判断是否有这个文件
 if(file_exists($file_path)){
 if($fp=fopen($file_path,"a+")){
 //读取文件
 $conn=fread($fp,filesize($file_path));
 //   return $conn;
 //替换字符串
 //$conn=str_replace("rn","<br/>",$conn);
 //  echo $conn."<br/>";
 }else{
 echo "文件打不开";
 }
 }else{
 echo "没有这个文件";
 }
 fclose($fp);

 $bodyofhtml=$conn;//$arr->body;//文章的内容（保存为html）
 $grade=1;//$arr->grade;//可查看该文章的年级


 */
          
          
          
          
          
      /*   $AUTHORITY = M('AUTHORITY');
      //  $USER->where('ID=201522040840')->select();
        $list = $AUTHORITY->limit(10)->select(); 
        $this->assign('list',$list);
        $this->display(); */
   /*  }
} */