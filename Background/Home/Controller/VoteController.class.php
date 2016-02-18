<?php
namespace Home\Controller;
use Think\Controller;
use Think\Model;
require './ThinkPHP/Library/Vendor/autoload.php';
use Firebase\JWT\JWT;
class VotController extends Controller {
    public function newVote(){
        //获取客户端发送的json
        $json=json_decode($_POST);
        $key="access_token";
        $jwt=JWT::decode($json->jwt, $key, array('HS256'));
        
        $timenow=date("YmdHis",strtotime('now'));
        if(!($jwt->aud==$json->username&&$timenow<$jwt->exp&&$timenow>$jwt->iat)){
            return  "";
        }
        
        $arr=$json;
        $username=$arr->username;//用户名为学号，也是数据库中的ID
        $title=$arr->title;//文章标题
        $uid=$arr->username;//创建该文章的用户ID
        $date=$arr->date;//创建投票的年月日时分秒
        $enddate=$arr->enddate;//投票截止年月日时分秒
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
        //从数据库中获取一个整数型的uuid，并设置为文章的ID号
        $Model=new Model();
        $sql="select uuid_short();";
        $res=$Model->query($sql);
        $id=$res[0]['uuid_short()'];
        
        /* $sql="insert into __PREFIX__vote(id,title,body,begtime,endtime,uid,tid,options,grade) values (
           uuid_short(),'$title',$body,'$datesql','$enddatesql',$uid','$tid','$body','$grade')";
         *///
        $sql="insert into". __PREFIX__."vote(id,title,body,begtime,endtime,uid,tid,options,grade) values (
        $id,'$title','$body','$datesql','$enddatesql',$uid,$tid,'$bodyofhtml','$grade')";
        
        if($Model->execute($sql))
            $suc=1;
        else 
            $suc=0;
        
        //投票选项里加入字段
        if($suc){
            for($i=0;$i<$count;$i++){
                $sql="insert into ".__PREFIX__."vote_options(id,tid,content) values ($i,$id,$contents[$i])";
                $Model->query($sql);
            }
        }
              
        $jsonsend = array(
            "username" => $username,
            "suc"=>$suc,
            "body"=>$body,
            "jwt"=>$arr->jwt          
        );
      
        $jsonsend=json_encode($jsonsend);
        echo $jsonsend;
        
        $this::insertuser($id);
   
    }
    
    public function insertuser($voteid){
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
    public function getList(){//获取文章列表
          //获取客户端发送的json
        $json=json_decode($_POST);
        $key="access_token";
        $jwt=JWT::decode($json->jwt, $key, array('HS256'));
        $timenow=date("YmdHis",strtotime('now'));
        if(!($jwt->aud==$json->username&&$timenow<$jwt->exp&&$timenow>$jwt->iat)){
            return  "";
        }
        $arr=$json;
        $username=$arr->username;//用户名为学号，也是数据库中的ID
        $page=$arr->page;//显示列表的第几页（为14位年月日时分秒）
        $pagesize=$arr->pagesize;//显示列表时每一页显示几条
        $title=$arr->title;//按照文章标题选取文章；
        $uid=$arr->writer;//按照作者选取文章；
        $time=date("Y-m-d H:i:s",strtotime($arr->time));
        
        $tid=$arr->tid;//按照文章的类型选取文章；
        $grade=$arr->grade;//按照查看该文章的年级选取文章
        
        
        $start=($page-1)*$pagesize;
        $sqlplus="order by begdate desc LIMIT $start,$pagesize";
        //对提取的jwt数据进行进一次选取；
        $sqloftitle="select * from ".__PREFIX__."view_vote where title like \"%$title%\" ".$sqlplus;
        $sqlofdate="select * from ".__PREFIX__."view_vote where endtime > $time and begtime <$time".$sqlplus;//注意此处需要将时间设置Y-m-d        
        $sqlofuid="select * from  ".__PREFIX__."view_vote where name=\"$uid\"".$sqlplus;//此处的uid都是中文的utf-8(编辑和管理员的名字互相都不能一样)
        $sqloftid="select * from  ".__PREFIX__."view_vote where type=\"$tid\"".$sqlplus;//此处的tid都是中文的utf-8(种类的名字互相也都不能一样)
        $sqlofgrade="select * from ".__PREFIX__."view_vote where grade like \"$grade\"".$sqlplus;//此处的grade都是中文的utf-8(种类的名字互相也都不能一样)
        $sql="select * from ".__PREFIX__."view_vote".$sqlplus;
        //phyman_view_vote 是vote的视图，包含voteid，标题title，begtime,endtime,创建者名字，属于哪个种类（中文）信息
        
        //根据用户设置的条件筛选文章
        $Model=new Model();
        if($title!=null)
            $res= $Model->query($sqloftitle);
        else if($time!=null){
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
        
        $jsonsend=array(
            'username'=>$username,
            'list'=>$resjson,
            'jwt'=>$arr->jwt
        );
        $jsonsend=json_encode($jsonsend);
        echo $jsonsend;

    }
    public function getVoteDetail(){
       //获取客户端发送的json
        $json=json_decode($_POST);
        $key="access_token";
        $jwt=JWT::decode($json->jwt, $key, array('HS256'));
        
        $timenow=date("YmdHis",strtotime('now'));
        if(!($jwt->aud==$json->username&&$timenow<$jwt->exp&&$timenow>$jwt->iat)){
            return  "";
        }
        
        $arr=$json;
        $username = $arr->username;//用户名为学号，也是数据库中的ID
        $vote = $arr->vote;//文章的id号
        
        $Model=new Model();
        //判断用户是否已进行过投票
        $sql="select choose from ".__PREFIX__."vote_user".$vote." where uid=".$username;
        $res=$Model->query($sql);
        if($res[0]['choose']){
            $optofhtml=$this::getvoteres($vote);//返回投票结果
        }else{
            $optofhtml=$this::getvotebody($vote);//返回投票页面
        }
        
        if($optofhtml!=null){
            $suc=1;
        }
        else{
            $suc=0;
        }
        $jsonsend=array(
            'username'=>$username,
            'suc'=>$suc,
            'choose'=>$res[0]['choose'],
            'options'=>$optofhtml,
            'jwt'=>$arr->jwt
        );
        $jsonsend=json_encode($jsonsend);
        echo $jsonsend;
        
    }
    public function userVote(){
        //获取客户端发送的json
        $json=json_decode($_POST);
        $key="access_token";
        $jwt=JWT::decode($json->jwt, $key, array('HS256'));
        
        $timenow=date("YmdHis",strtotime('now'));
        if(!($jwt->aud==$json->username&&$timenow<$jwt->exp&&$timenow>$jwt->iat)){
            return  "";
        }
        
        $arr=$json;
        $username=$arr->username;//用户名为学号，也是数据库中的ID
        $voteid=$arr->id;//投票ID号（为14位年月日时分秒）
        $option=$arr->option;//那几个选项按照;划分
    
        $Model=new Model();
        $sql="update ".__PREFIX__."vote_user".$voteid."set option=".$option."where id=".$username;
        $Model->query($sql);
    
        $sql="update  ".__PREFIX__."vote_user".$voteid."set choose=1 where id=".$username;;
        $Model->query($sql);
         
        //投票结果
        $result=$this::getvoteres($voteid);
        if($result!=null){
            $suc=1;
        }else{
            $suc=0;
        }
        $jsonsend=array(
            'username'=>$username,
            'suc'=>$suc,
            'result'=>$result,
            'jwt'=>$arr->jwt
        );
        $jsonsend=json_encode($jsonsend);
        echo $jsonsend;
    }
    
    //获取投票具体页面
    public function getvotebody($vote){
        $Model=new Model();
        //  $sql="select options from __PREFIX__view where id=".$vote;
        $sql="select options from __PREFIX__vote where id=".$vote;
    
        //根据用户点击选取投票
        $res=$Model->query($sql);
        $optofhtml=$res[0]['options'];
        
        return $optofhtml;
         
    
        /*       $file_path=__DIRART__.$res[0]['body'];
         //  echo $file_path;
         //判断是否有这个文件
         if(file_exists($file_path)){
         if($fp=fopen($file_path,"a+")){
         //读取文件
         $opt=fread($fp,filesize($file_path));
         }else{
         echo "文件打不开";
         }
         }else{
         echo "没有这个文件";
         }
         fclose($fp); 
         echo $opt;*/
    }
    
    //获取投票结果
    public function getvoteres($voteid){
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
        
            $sql="select count(*) from __PREFIX__vote_user".$voteid." where options like \"%$id%\"";
            $temp=$Model->query($sql);
            $num=$temp[0]['count(*)'];
            $s=array(
                'opt'=>$id,
                'conten'=>$content,
                'num'=>$num
            );
            array_push($resultofvote['options'],$s);
        
        }
        $result=json_encode($resultofvote);
        return $result;
    }
    public function getExcel(){
        $json=json_decode($_POST);
        $key="access_token";
        
        $arr=$json;
        $username=$arr->username;//用户名为学号，也是数据库中的ID
        $vote=$arr->vote;
        $table=__PREFIX__."vote_user".$vote;
        $this::expUser($table,$vote); 
    }
    public function exportExcel($expTitle,$expCellName,$expTableData){
        echo 'exportExcel';
        //  $xlsTitle = iconv('utf-8', 'utf-8', $expTitle);//文件名称
        $fileName = date('YmdHis');//or $xlsTitle 文件名称可根据自己情况设定
        $cellNum = count($expCellName);
    
        $dataNum = count($expTableData);
        vendor("PHPExcel.PHPExcel");
        $objPHPExcel = new \PHPExcel();
        $cellName = array('A','B','C','D','E');
        for($i=0;$i<$cellNum;$i++){
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue($cellName[$i].'1', $expCellName[$i][1]);
        }
        // Miscellaneous glyphs, UTF-8
        for($i=0;$i<$dataNum;$i++){
            for($j=0;$j<$cellNum;$j++){
                $objPHPExcel->getActiveSheet(0)->setCellValue($cellName[$j].($i+2), $expTableData[$i][$expCellName[$j][0]]);
            }
        }
        //die;
        ob_end_clean();
        header('pragma:public');
        header('Content-type:application/vnd.ms-excel;charset=utf-8;name=1234565.xls"');
        header("Content-Disposition:attachment;filename=$fileName.xls");//attachment新窗口打印inline本窗口打印
        $objWriter = \PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
        $objWriter->save('php://output');
        exit;
    }
    /**
     *
     * 导出Excel
     */
    function expUser($table,$voteid){//导出Excel
    
         $xlsName  = "vote";
        $Model= new Model();
        $sql="select id,content from ".__PREFIX__."vote_options where vid=".$voteid;
        
        $xlsCell  = array(
            array('id','学号'),
            array('name','姓名'),
            array('grade','年级'),
            array('choose','状态'),
            array('option','选项'),
        );
      
        $Model= new Model();
        $sql="select id,name,grade,choose,option from ".$table;
        $xlsData=$Model->query($sql);
        foreach ($xlsData as $k => $v)
        {
            $xlsData[$k]['choose']=$v['choose']==1?'已投票':'未投票';
            $op="";
            $options=explode(";",$v['option']);
            $count=count($options)-1;
            for($i=0;$i<$count;$i++){
                $sql="select content from ".__PREFIX__."vote_options where vid=".$voteid." and id=".$options[$i];
                $res=$Model->query($sql);
                $op=$op.$options[$i].":".$res[0]['content'].";";
                
            }
            $xlsData[$k]['option']=$op;
        }
       $this->exportExcel($xlsName,$xlsCell,$xlsData);
         
    }    
}
?>