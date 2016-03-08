angular.module('phyman.vote',['ngMaterial', 'ngMessages','ngMessages', 'angular-jwt', 'ui.router','ngGrid','phyman.user'])
.config(function($mdThemingProvider) {
	  $mdThemingProvider.theme('altTheme')
	    .primaryPalette('purple');
	})
	
	.controller('VoteCtrl',['$scope','$rootScope','$state','$mdDialog','VoteService',
        function($scope,$rootScope,$state,$mdDialog,VoteService) {
    		var promise =VoteService.getList();
   	 			promise.then(function(response) {
   	 				alert(response.data.list);
   	 				$scope.vote=JSON.parse(response.data.list);
   	 			},function(response){
   	 				alert("VoteList fail");
   	 				$state.transitionTo("VoteDetail",null,{
   	 					reload:true
   	 				});
   	 			});
        	$scope.newVote = function() {
        		$state.go('^.new');
        	};
        	$scope.editVote = function(id) {
        		$state.go('^.edit',
        		{
        			vote_id: id
        		},{
        			reload:true
        		});
        	};
        	$scope.markVote = function(id) {
            };
            $scope.deleteVote = function(id,ev) {
            $mdDialog.show($mdDialog.confirm()
            		.title('是否要删除该通知？')
            		.textContent('该通知删除后将不可恢复。')
            		.targetEvent(ev)
            		.ok('删除!')
            		.cancel('点错了')).then(function() {
            			VoteService.deleteVote(id)
            			.then(function(response) {
            				//do something when succeed.
            			},function(error) {
            				//do something when failed
            			});
            			},function() {});
            };
     }])
     .controller('VoteResultCtrl',['$scope','$state','VoteService','$stateParams','$interval',
          function($scope,$state,VoteService,$stateParams,$interval){
    	  	var promise = VoteService.getResult($stateParams.id);
    	  		promise.then(function(response){
    	  			$scope.detail=response.data;
    	  			$scope.result=JSON.parse($scope.detail.result);
    	  			alert($scope.detail.options);
    	  		},function(response){
    	  			alert("VoteResult fail");
     				$state.transitionTo(" vote.list",null,{
     					reload:true
     				});
    	  		});
     }])
     .controller('VoteViewCtrl',['$scope','$state','$stateParams','VoteService',
      function($scope,$state,$stateParams,VoteService) {
    	 var promise =VoteService.getDetail($stateParams.id);
 			promise.then(function(response) {
 				$scope.detail=response.data;
 				$scope.items=JSON.parse(response.data.options);
 				alert($scope.items);
 			},function(response){
 				alert("VoteList fail");
 				$state.transitionTo(" VoteDetail",null,{
 					reload:true
 				});
 			});
 			$scope.selected = [];
 			$scope.votenow = function(){
 				var promise =VoteService.setVote($scope.selected,$stateParams.id);
 				$id=$stateParams.id;
 				$state.go('^.result',
 		        		{
 		        			id: $id
 		        		},{
 		        			reload:true
 		        		});
 			};
 		    $scope.toggle = function (item, list) {
 		       var idx = list.indexOf(item);
 		       if (idx > -1) list.splice(idx, 1);
 		       else list.push(item);
 		     };
 		     $scope.exists = function (item, list) {
 		       return list.indexOf(item) > -1;
 		     };
    	 }])

	
	
.controller('votelistCtrl',['$scope', '$rootScope','$state','VoteService',
      function($scope,$rootScope,$state,VoteService){
	var promise =VoteService.getlist();
	 promise.then(function(response) {
		 $scope.vote=JSON.parse(response.data.list);
	 },function(response){
		 alert("VoteList fail");
		 $state.go("login");
	 });
	 $scope.voteDetail=function(id){
		 VoteService.setvoteid(id);
		 $state.go('VoteList',null,{
			 reload:true
		 });
	 };
  }])
.controller('VoteEditorCtrl',['$scope', '$rootScope','$state','VoteService',
      function($scope,$rootScope,$state,VoteService){
	
	 $scope.userState = '';
     $scope.states = ('单选 多选').split(' ').map(function (state) { return { abbrev: state }; });
     $scope.options=[{
    	optid:"1",
    	optcontent:""
     },{
    	optid:"2",
     	optcontent:""
     },{
    	optid:"3",
     	optcontent:""
     },{
    	optid:"4",
     	optcontent:""
     },{
    	optid:"5",
     	optcontent:""
     },{
    	optid:"6",
     	optcontent:"" 
     },{
    	optid:"7",
     	optcontent:""
     },{
    	optid:"8",
     	optcontent:""
     },{
    	optid:"9",
     	optcontent:""
     },{
    	optid:"10",
     	optcontent:""
     }];
     $scope.numbers = ('一 二 三 四 五 六 七 八 九 十').split(' ').map(function (number){return {abbrev:number};});
     $scope.isNewVote = false;
	 $scope.votenew = function(){
		 $scope.isNewVote = true;
		 $options="";
		 for(var i=0;i<$scope.options.length;i++){
			   	if(!$scope.options[i]['optcontent']==""){
			    	$options=$options+$scope.options[i]['optcontent']+";";	
		     } 
		 }
		 alert($options);
         var promise = VoteService.newVote($scope.vote,$options);
         promise.then(function(response) {
             $scope.isNewVote = false;
             if(response){
             	//alert("Login成功");
             	$state.go("vote.list",null,{
             		reload:true
             	});
             }
             else
             	$state.go("login",null,{
             		reload:true
             	});
         }, function(response) {
         	alert('shibainiao:'+response);
             $scope.isLoggingIn = false;
         });
	 };
	/*var promise =VoteService.getlist();
	 promise.then(function(response) {
		 $scope.vote=JSON.parse(response.data.list);
	 },function(response){
		 alert("VoteList fail");
		 $state.go("login");
	 });
	 $scope.voteDetail=function(id){
		 VoteService.setvoteid(id);
		 $state.go('VoteList',null,{
			 reload:true
		 });
	 };*/
  }])
/*.config(function($mdThemingProvider) {
  $mdThemingProvider.theme('altTheme')
    .primaryPalette('purple');
})*/;  

/**
Copyright 2016 Google Inc. All Rights Reserved. 
Use of this source code is governed by an MIT-style license that can be in foundin the LICENSE file at http://material.angularjs.org/license.
**/