<?php
namespace Common\Controller;
use Think\Controller;
class AjaxController extends Controller {

    public function __construct(){
        parent::__construct();//调用父类的方法，因为这里重写了父类的方法
        //用于解决前台ajax跨域请求
        header("Access-Control-Allow-Origin:*");
        //header("Access-Control-Allow-Origin:http://111.com");
        header('Access-Control-Allow-Headers:x-requested-with,content-type');
        header('Access-Control-Allow-Methods:POST');
    }
}
?>
