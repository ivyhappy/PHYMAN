angular.module('phyman.noti',['ngMaterial', 'ngMessages','ngMessages', 'angular-jwt', 'ui.router','ngGrid','phyman.user'])
	.controller('NotiEditorCtrl',['$scope','$state','NotiService',
	    function($scope,$state,NotiService) {
			$scope.tinymceOptions = {
				language: 'zh_CN',
				plugins: 'fullscreen,preview,table',
				toolbar: 'undo,redo,bold,italic,styleselect,fontsizeselect,removeformat,'+
						 'bullist,numlist,outdent,indent,table,preview,fullscreen',
				menubar: false,
				statusbar: false,
				min_height:400,
				max_width:900
		};
			$scope.submit = function() {
				var notiNewer = {};
				notiNewer.title = $scope.noti.title;
				notiNewer.content = $scope.noti.content;
				NotiService.updateNoti(notiNewer)
					.then(function(response) {
						$state.go('noti.list');
						},function(error) {
							});
						};
                    }])
    .controller('NotiCtrl',['$scope','$rootScope','$state','$mdDialog','NotiService','noti',
        function($scope,$rootScope,$state,$mdDialog,NotiService,noti) {
    		var promise =NotiService.getList();
   	 			promise.then(function(response) {
   	 				alert(response.data);
   	 				$scope.noti=JSON.parse(response.data.list);
   	 			},function(response){
   	 				alert("NotiList fail");
   	 				$state.transitionTo("NotiDetail",null,{
   	 					reload:true
   	 				});
   	 			});
        	/*$scope.viewNoti = function(id) {
        		NotiService.setNotiid(id);
        		$state.go('^.detail',{
        			noti_id: id
        			},{
        				reload:true
        				});
        	};*/
        	$scope.newNoti = function() {
        		$state.go('^.new');
        	};
        	$scope.editNoti = function(id) {
        		$state.go('^.edit',
        		{
        			noti_id: id
        		},{
        			reload:true
        		});
        	};
        	$scope.markNoti = function(id) {
            };
            $scope.deleteNoti = function(id,ev) {
            $mdDialog.show($mdDialog.confirm()
            		.title('是否要删除该通知？')
            		.textContent('该通知删除后将不可恢复。')
            		.targetEvent(ev)
            		.ok('删除!')
            		.cancel('点错了')).then(function() {
            			NotiService.deleteNoti(id)
            			.then(function(response) {
            				//do something when succeed.
            			},function(error) {
            				//do something when failed
            			});
            			},function() {});
            };
     }])
     .controller('NotiViewCtrl',['$scope','$state','$stateParams','NotiService',
         function($scope,$state,$stateParams,NotiService) {
    	 var promise =NotiService.getDetail($stateParams.id);
 			promise.then(function(response) {
 				$scope.content=response.data.detail.body;
 			},function(response){
 				alert("NotiList fail");
 				$state.transitionTo("NotiDetail",null,{
 					reload:true
 				});
 			});
    	 }]);






/*.config(function($mdThemingProvider) {
	  $mdThemingProvider.theme('altTheme')
	    .primaryPalette('purple');
	})
.controller('notidetailCtrl',['$scope','$state','$rootScope','NotiServie',
      function($scope,$state,$rootScope,NotiServie){
	alert("notidetailCtrl");
	
}])
.controller('notilistCtrl',['$scope','$state', 'NotiService',
      function($scope,$state,NotiService){
	var promise =NotiService.getlist();
	 promise.then(function(response) {
		 alert(response.data);
		 $scope.noti=JSON.parse(response.data.list);
	 },function(response){
		 alert("NotiList fail");
		 $state.transitionTo("NotiDetail",null,{
			 reload:true
		 });
	 });
	 $scope.notiDetail= function(id){
		 NotiService.setnotiid(id);
		 $state.go('NotiDetail',null,{
			 reload:true
		 });
		 $state.go('NotiDetail',null,{
			 reload:true
		 });
		 var promise =NotiService.getdetail(id);
		 promise.then(function(response) {
			 $scope.noti.detail=JSON.parse(response.data.notification);
			 $scope.detail=JSON.parse(response.data.notification);
		 },function(response){
			 alert("NotiDetail fail");
			 $state.go("login",null,{
				 reload:true
			 });
		 });
		 $state.go("/",null,{
			 reload:true
		 });
		 $state.go("NotiDetail",null,{
			 reload:true
		 });
		
		 
		 $state.go("NotiDetail",null,{
			 reload:true
		 });
	 }
  }])
.controller('SubheaderAppCtrl',['$scope', '$rootScope', 'AuthService', 'AuthDialog','$state','NotiService',
      function($scope,$rootScope,NotiService,AuthService) {
      $list=NotiService.getjson();
      console.log($list);
      $scope.listnew=$list;//.listnew;
       $scope.listlast=$list;//.listlast;
      $scope.listearly=$list;//d.listearly;
                            }]);*/
/*.config(function($mdThemingProvider) {
  $mdThemingProvider.theme('altTheme')
    .primaryPalette('purple');
})*/  

/**
Copyright 2016 Google Inc. All Rights Reserved. 
Use of this source code is governed by an MIT-style license that can be in foundin the LICENSE file at http://material.angularjs.org/license.
**/