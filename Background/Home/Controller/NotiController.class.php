<?php
namespace Home\Controller;
use Common\Controller\AjaxController;
use Think\Model;
use Firebase\JWT\JWT;
use Org\Net\Http;

require './ThinkPHP/Library/Vendor/autoload.php';
require './ThinkPHP/Library/Vendor/Classes/PHPExcel.php';


import(Vendor.Classes.Writer.Excel5.php);
import(Vendor.Classes.IOFactory.php);

class NotiController extends AjaxController {
    
    
    public function getList(){
        $json=json_decode($GLOBALS['HTTP_RAW_POST_DATA']);
        $id=$json->username;

        $Model=new Model();
        $sql="select grade,authority from ".__PREFIX__."user where id=".$id;
        $res= $Model->query($sql);
        $grade=$res[0]['grade'];  
        
        $sqlplus="order by date desc";
        if($res[0]['authority']=="admin"){
            $sql="select id,title,date from ".__PREFIX__."article ".$sqlplus;
        }else{
            $sql="select id,title,date from ".__PREFIX__."article   where grade like\"%$grade%\" ".$sqlplus;
        }
        
       $res= $Model->query($sql);
       $resjson=json_encode($res);
  
        $jsonsend=array(
            "username"=>"",
            "list"=>$resjson
        );
        
        
        $json=json_encode($jsonsend);
        //echo $json;
        echo $json;
    }
   
    public function deleteOne(){
        $dir=__DIRART__ ; //'C:/xampp/htdocs/PHYMAN/Background/Home/contents/';//;//'D:/Coding/xampp/htdocs/dashboard/PHYMAN/Background/Home/contents/';//'D:/Coding/xampp/htdocs/dashboard/PHYMAN/Background/Home/contents/';
        
        $json=json_decode($GLOBALS['HTTP_RAW_POST_DATA']);
        $id=$json->id;
        $Model= new Model();
        $sql="select filedir from ".__PREFIX__."article where id=".$id.";";
        $res=$Model->query($sql);
        $dir=$dir.$res[0]['filedir'];
        unlink($dir);
        $sql= "delete from ".__PREFIX__."article where id =".$id.";";
        $Model->query($sql);
        $sql= "drop table ".__PREFIX__."article_user".$id.";";
        $Model->query($sql);
        
        $jsonsend=array(
            "status"=>"ok"
        );
        $jsonsend=json_encode($jsonsend);
        echo $jsonsend;
    }
    
    //获取文章内容
    public function getNotiDetail(){
        //获取客户端发送的json
        $arr=json_decode($GLOBALS['HTTP_RAW_POST_DATA']);
        
        $art = $arr->id;//文章的id号
        $username=$arr->userid;
        
        
        $this::articlecheck($username,$art);
        if($art==null){
            $res=array(
                "id"=>"",
                "body"=>"",
                "date"=>""
            );
            $article=json_encode($res);
            $jsonsend=array(
                'log'=>"未读取到文章id",
                'detail'=>$article
            );
        }else{
            //对提取的jwt数据进行进一次选取；
            $sql="select id,title,body,date,filedir from ".__PREFIX__."article where id=".$art;
            
           /*  $sql="select id,title,body,date,grade from ".__PREFIX__."article where id=".$art;
         */
            //根据用户点击选取文章
            $Model=new Model();
            $res= $Model->query($sql);
            $article=json_encode($res);
           
        
            if($article!=null)
                $log=1;
            else $log=0;
        
            $jsonsend=array(
                'title'=>$res[0]['title'],
                'content'=>$res[0]['body'],
                'detail'=>$article,
                'filedir'=>$res[0]['filedir']
            );
        }
        $json=json_encode($jsonsend);
       // $this->assign($json);
      //  $this->display("./Background/Home/phyman-1/index.html");
        echo $json;
        
       
    
    }
    public function download(){
        $name=$_GET['id'];
        $filename=__DIRART__.$name;
        //$filename="D:/Coding/xampp/htdocs/dashboard/PHYMAN/Background/Home/contents/1462288527.doc";//$json->filedir;//设置文件上传路径
        $content='';
        $expire=180;
        
       
        if(is_file($filename)) {
            $length = filesize($filename);
            
            
        }else if(is_file(UPLOAD_PATH.$filename)) {
            $filename = UPLOAD_PATH.$filename;
            $length = filesize($filename);
        }else if($content != '') {
            $length = strlen($content);
        }else {
            
        }
		if(!empty($filename)) {
		    $type=substr($filename, strrpos($filename, '.')+1);
			if($type==".doc"||$type==".docx"){
			    $type="application/msword";
			}elseif($type==".xls"||$type==".xles"){
			    $type="application/x-xls";
			}
			elseif ($type==".ppt"||$type==".pptx"){
			    $type="application/x-ppt";
			    
			}elseif($type==".rar"||$type==".zip"){
			     $type="application/x-zip-compressed";
			    
			}
		}else{
			$type	=	"application/octet-stream";
		}
        //发送Http Header信息 开始下载
        header("Pragma: public");
        header("Cache-control: max-age=".$expire);
        //header('Cache-Control: no-store, no-cache, must-revalidate');
        header("Expires: " . gmdate("D, d M Y H:i:s",time()+$expire) . "GMT");
        header("Last-Modified: " . gmdate("D, d M Y H:i:s",time()) . "GMT");
        header("Content-Disposition: attachment; filename=".$name);
        header("Content-Length: ".$length);
        header("Content-type: ".$type);
        header('Content-Encoding: none');
        header("Content-Transfer-Encoding: binary" );
        if($content == '' ) {
            readfile($filename);
        }else {
        	echo($content);
        }
    }
    public function articlecheck($userid,$articleid){
        $Model=new Model();
        $check=1;
        $sql="update ".__PREFIX__."article_user".$articleid." set checken=".$check." where id=".$userid;
        $Model->query($sql);
    
    }
    
    
    public function stat(){
        $json=json_decode($GLOBALS['HTTP_RAW_POST_DATA']);
        $key="access_token";
        
        $articleid=$json->id;
        

        $Model=new Model();
        $sql="select id,name,checken from ".__PREFIX__."article_user".$articleid." where checken=1";
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
   /*  public function  getExcel(){
        $json=json_decode($_POST);
        $key="access_token";
    
        $arr=$json;
        $username=$arr->username;//用户名为学号，也是数据库中的ID
        $art=$arr->article;//文章id号
        $table=__PREFIX__."article_user".$art;
        $this::expUser($table);
    } */
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