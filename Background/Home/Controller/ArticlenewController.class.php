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
        $psw=$arr->password;//密码
        $id=$arr->id;//文章ID号（为14位年月日时分秒）
        $title=$arr->title;//文章标题
        $uid=$arr->username;//创建该文章的用户ID
        $date=$arr->date;//创建文章的年月日时分秒
        $tid=$arr->tid;//
        $bodyofhtml=$arr->body;//文章的内容（保存为html）
        $grade=$arr->grade;//可查看该文章的年级

        
        //对时间进行处理；
        $datetime= date("YmdHis",strtotime($date));//获取当前时间
       // echo $datetime;
        //echo $datetime;//20160130151019
        $datesql= date("Y-m-d H:i:s",strtotime($datetime));//
        //echo $datesql;
        //echo $datetime1;//2016-01-30 15:10:19
        
        //将读取到的html文件写入到硬盘文件
        $file_path=__DIRART__.$datetime.$uid.'article.html';
        $body=$datetime.$uid.'article.html';//html文件的名字
        $myfile = fopen($file_path, "w") or die("Unable to open file!");
        if(fwrite($myfile, $bodyofhtml)) 
            $suc=1;
        else
            $suc=0;
        fclose($myfile);
        //$suc=0保存成功；=1写入失败
        //从数据库中读取用户的password和权限
        $sql="insert into __PREFIX__article(id,title,uid,date,tid,body,grade) 
            values ('$id','$title','$uid','$datesql','$tid','$body','$grade')";
        $Model=new Model();
        if($Model->query($sql))
            $suc=1;
        else 
            $suc=0;
        
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
?>




