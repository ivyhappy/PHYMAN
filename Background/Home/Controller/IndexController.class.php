<?php
namespace Home\Controller;
use Think\Controller;
use Think\Model;
require './ThinkPHP/Library/Vendor/autoload.php';
use Firebase\JWT\JWT;

class IndexController extends Controller {
    public function testoprions(){
        
        
        $Model= new Model();
   /*  $sql="select uuid_short() Length=15;";
    print_r($Model->query($sql)); */
        $date=date("Ymd",strtotime('now'));
        echo $date;
        $datetime=date("Y-m-d H:i:s",strtotime($date));
        echo $datetime;
   // print_r($res); 
/*         $sql="insert into __PREFIX__authority (id,name) values (uuid_short(),\"测试\")";
        $Model->query($sql);
        
        
        $sql="select * from __PREFIX__authority LIMIT 1,10";
        $res=$Model->query($sql);
        print_r($res);
        
        $datetime= date("YmdHis",strtotime('now'));
        $options=explode(";","我的家;在东北;松花江上");//$decoded->options);//此处为投票具体内容
        $count=count($options);//总共有多少个投票内容
        for($i=0;$i<$count;$i++){
            $optionids=$optionids.$datetime.$i.";";
        }
        echo $optionids; */
        
        
        
        
        
        
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
                echo $conn."<br/>";
            }else{
                echo "文件打不开";
            }
        }else{
            echo "没有这个文件";
        }
        fclose($fp);
        $file_path=__DIRART__.'testwrite1.html';
        $myfile = fopen($file_path, "w") or die("Unable to open file!");
     //   $txt = "Bill Gates\n";
      //  fwrite($myfile, $txt);
        //$txt = "Steve Jobs\n";
        fwrite($myfile, $conn);
        fclose($myfile);
        echo 'success';
        
       // $myfile = fopen("testfile.html", "w");
        
    }
    public function textwrite(){
        //http://www.w3school.com.cn/php/php_file_create.asp
        $html= textread();
        $myfile = fopen("testfile.html", "w");
        
        
    }
    
    
    
    public function index(){
        
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
}
          
          
          
          
          
          
          
      /*   $AUTHORITY = M('AUTHORITY');
      //  $USER->where('ID=201522040840')->select();
        $list = $AUTHORITY->limit(10)->select(); 
        $this->assign('list',$list);
        $this->display(); */
   /*  }
} */