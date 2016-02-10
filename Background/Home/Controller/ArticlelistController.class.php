

<?php
namespace Home\Controller;
use Think\Controller;
use Think\Model;
require './ThinkPHP/Library/Vendor/autoload.php';
use Firebase\JWT\JWT;
class ArticlelistController extends Controller {

    public function index(){//获取文章列表
        //获取来自客户端的jwt
        $postjwt=$_POST;
        $key="access_token";

        //提取jwt中的json数据
        $decoded = JWT::decode($postjwt, $key, array('HS256'));
        $arr=json_decode($decoded);
        $username=$arr->username;//用户名为学号，也是数据库中的ID
        $page=$arr->page;//显示列表的第几页（为14位年月日时分秒）
        $pagesize=$arr->pagesize;//显示列表时每一页显示几条
        $title=$arr->title;//按照文章标题选取文章；
        $uid=$arr->writer;//按照作者选取文章；
        $date=$arr->date;//按照文章的发表日期选取文章
        $tid=$arr->tid;//按照文章的类型选取文章；
        $grade=$arr->grade;//按照查看该文章的年级选取文章
        
        //对提取的jwt数据进行进一次选取；
        $start=($page-1)*$pagesize;
        $sqlplus="order by begdate desc LIMIT $start,$pagesize";

        $sqloftitle="select * from ".__PREFIX__."article where title like \"%$title%\" ".$sqlplus;
        $sqlofdate="select * from ".__PREFIX__."article where date like \"%$date%\" ".$sqlplus;//注意此处需要将时间设置Y-m-d        
        $sqlofuid="select * from  ".__PREFIX__."article where uid=(
                   select id from ".__PREFIX__."user where name= \"%$uid%\") ".$sqlplus;//此处的uid都是中文的utf-8(编辑和管理员的名字互相都不能一样)
        $sqloftid="select * from  ".__PREFIX__."article where tid=(
                   select id from ".__PREFIX__."type where name= \"%$tid%\") ".$sqlplus;//此处的tid都是中文的utf-8(种类的名字互相也都不能一样)
        $sqlofgrade="select * from ".__PREFIX__."article where grade=(
                   select id from ".__PREFIX__."grade where name= \"%$grade%\") ".$sqlplus;//此处的grade都是中文的utf-8(种类的名字互相也都不能一样)
        $sql="select * from ".__PREFIX__."article ".$sqlplus;
        
        //根据用户设置的条件筛选文章
        $Model=new Model();
        if($title!=null)
            $res= $Model->query($sqloftitle);
        else if($date!=null){
            $res=$Model->query($sqlofdate);
        }else if($uid!=null){
            $res= $Model->query($sqlofuid);
        }else if($tid!=null){
            $res= $Model->query($sqloftid);
        }else if($grade!=null){
            $res= $Model->query($sqlofgrade);
        }else{
            $res= $Model->query($sql);
        }
        
        $resjson=json_encode($res);
        $token=array(
            
            
            
            
            'time'=>144,
            'list'=>$resjson,
        );
       
        /**
         * IMPORTANT:
         * You must specify supported algorithms for your application. See
         * https://tools.ietf.org/html/draft-ietf-jose-json-web-algorithms-40
         * for a list of spec-compliant algorithms.
         */
        
        $token=json_encode($token);
        $jwt = JWT::encode($token, $key);
        echo $jwt;

     /*    $decoded = JWT::decode($jwt, $key, array('HS256'));//json
        print_r($decoded); */

    }
}

?>