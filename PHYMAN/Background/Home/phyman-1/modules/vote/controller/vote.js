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

/*.config(function($mdThemingProvider) {
  $mdThemingProvider.theme('altTheme')
    .primaryPalette('purple');
})*/;  

/**
Copyright 2016 Google Inc. All Rights Reserved. 
Use of this source code is governed by an MIT-style license that can be in foundin the LICENSE file at http://material.angularjs.org/license.
**/