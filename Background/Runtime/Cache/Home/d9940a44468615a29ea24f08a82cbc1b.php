<?php if (!defined('THINK_PATH')) exit();?>  <html>
    <head>
        
    </head>
    <body>
    <P><a href="/PHYMAN/index.php?c=Testfunction&a=index" >导出数据并生成excel</a></P><br/>
        <form action="/PHYMAN/index.php?c=Testfunction&a=index" method="post" enctype="multipart/form-data">
        <input type= "json" name="username"> 333</input>
            <input type="file" name="import"/>
          
            <input type="submit" value="导入"/>
        </form>
    </body>
    
</html>