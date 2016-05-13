<?php if (!defined('THINK_PATH')) exit();?><div class="container">
	<div class="row">
	  <div class="col-md-10">
	        <div ui-view="type">
	        	<nav class="navbar navbar-default" role="navigation">
   <div class="navbar-header">
      <a class="navbar-brand">类型</a>
   </div>
   <div>
      <ul class="nav navbar-nav" id="navbar1"></ul>
      <script type="text/javascript">
     
    $(document).ready(function(){
       $.ajax({
           url:"/PHYMAN/index.php/Home/Testfunction/index",
           type: "GET",
           dataType: "text",
           success: function(data){
              // alert(data);
               data=JSON.parse(data);
              alert(data.jwt);
              alert(data.user[0].id); 
          }
       })
   }); 
         
      </script>
      
      <!-- <script type="text/javascript">
      $.getJSON("/PHYMAN/index.php/Home/Testfunction/index",function(jsonData){
            $.each(jsonData,function(i,item){
            	$("#navbar1").append("<li><a href='#list"+item.username+"'>"+item.password+"</a></li>");
            });
      });            
      </script> -->
   </div>
</nav>
	        </div>
	    </div>
	
	</div>    
</div>