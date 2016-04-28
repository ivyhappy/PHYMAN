<?php if (!defined('THINK_PATH')) exit();?><html>
    <head>

<script>
// 初始化io对象
var socket = io('http://119.29.6.121:2120');
// uid 可以为网站用户的uid，作为例子这里用session_id代替
var uid = '<?php echo session_id();?>';
// 当socket连接后发送登录请求
socket.on('connect', function(){socket.emit('login', uid);});
// 当服务端推送来消息时触发，这里简单的aler出来，用户可做成自己的展示效果
socket.on('new_msg', function(msg){alert(msg);});
</script> 
    </head>
    <body>
    <P><a href="<?php echo U('Index/index');?>" >this is Index</a></P><br/>
        <form action="<?php echo U('Getvotexls/impUser');?>" method="post" enctype="multipart/form-data">
            <input type="file" name="import"/>
            <input type="hidden" name="table" value="tablename"/>
            <input type="submit" value="导入"/>
        </form>
    </body>
    
</html>