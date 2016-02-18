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

class NotiController extends Controller {
    
    
    public function getList(){
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
  
        $jsonsend=array(
            "username" => $username,
            "list"=>$resjson,
            "jwt"=>$json->jwt
        );
         
        /**
         * IMPORTANT:
         * You must specify supported algorithms for your application. See
         * https://tools.ietf.org/html/draft-ietf-jose-json-web-algorithms-40
         * for a list of spec-compliant algorithms.
        */
        
        $json=json_encode($jsonsend);

        echo $json;
        
    }
   
    
    //获取文章内容
    public function getNotiDetail(){
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
        $art = $arr->article;//文章的id号
    
        //对提取的jwt数据进行进一次选取；
    
        $sql="select body from ".__PREFIX__."article where id=".$art;
    
        //根据用户点击选取文章
        $Model=new Model();
        $res= $Model->query($sql);
        $article=$res[0]['body'];
       
        /* 如果存储方式为html本地文件
         * $file_path=__DIRART__.$res[0]['body'];
         //  echo $file_path;
         //判断是否有这个文件
         if(file_exists($file_path)){
         if($fp=fopen($file_path,"a+")){
         //读取文件
         $article=fread($fp,filesize($file_path));
         }else{
         echo "文件打不开";
         }
         }else{
         echo "没有这个文件";
         }
        fclose($fp); */
    
        if($article!=null)
            $suc=1;
        else $suc=0;
    
        $jsonsend=array(
            'username'=>$username,
            'suc'=>$suc,
            'notiDetail'=>$article
        );
      
        $json=json_encode($jsonsend);
        echo $json;
        
        $this::articlecheck($username,$art);
    
    }
    public function articlecheck($userid,$articleid){
        $Model=new Model();
        $check=1;
        $sql="update ".__PREFIX__."article_user".$articleid." set checken=".$check." where id=".$userid;
        $Model->query($sql);
    
    }
    public function  getExcel(){
        $json=json_decode($_POST);
        $key="access_token";
    
        $arr=$json;
        $username=$arr->username;//用户名为学号，也是数据库中的ID
        $art=$arr->article;//文章id号
        $table=__PREFIX__."article_user".$art;
        $this::expUser($table);
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
    
    
        //array('A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z','AA','AB','AC','AD','AE','AF','AG','AH','AI','AJ','AK','AL','AM','AN','AO','AP','AQ','AR','AS','AT','AU','AV','AW','AX','AY','AZ');
    
    
        //  $objPHPExcel->getActiveSheet(0)->mergeCells('A1:'.$cellName[$cellNum-1].'1');//合并单元格
        // $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A1', $expTitle.'  Export time:'.date('Y-m-d H:i:s'));
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
    function expUser(){//导出Excel
        echo 'expUser';
        $art=1;
        $table=__PREFIX__."article_user".$art;
        $xlsName  = "User";
        $xlsCell  = array(
            array('id','学号'),
            array('name','姓名'),
            array('grade','年级'),
            array('checken','状态'),
        );
        
        $Model= new Model();
        $sql="select id,name,grade,checken from ".$table;
        $xlsData=$Model->query($sql);
        
        //$xlsData  = $xlsModel->Field('id,name,sex,grade')->select();
        /*  print_r($xlsData);
         echo "<br>"; */
        foreach ($xlsData as $k => $v)
        {
            $xlsData[$k]['checken']=$v['checken']==1?'已查看':'未查看';
        }
        $this->exportExcel($xlsName,$xlsCell,$xlsData);
         
    }
    
}
?>