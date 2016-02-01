<?php if (!defined('THINK_PATH')) exit();?> <html>
 <head>
   <title>Select Data</title>
 </head>
 <body>
 <output>12345</output>
    <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i; echo ($vo["id"]); ?>:<?php echo ($vo["name"]); ?><br/><?php endforeach; endif; else: echo "" ;endif; ?>
 </body>
</html>