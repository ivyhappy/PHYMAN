angular.module('phyman.detail',['ngMaterial', 'ngMessages','ngMessages', 'angular-jwt', 'ui.router','ngGrid','phyman.user','phyman.noti','phyman.vote'])
.config(function($mdThemingProvider) {
	  $mdThemingProvider.theme('altTheme')
	    .primaryPalette('purple');
	})
.controller('notidetailCtrl',['$scope','$state','$rootScope','DetailService',
      function($scope,$state,$rootScope,DetailService){
			 //var des="/PHYMAN/index.php/Home/"+$rootScope.type+"/get"+$rootScope.type+"Detail";
			 var des="/PHYMAN/index.php/Home/Noti/getNotiDetail";
			 alert($state.params.notidetail);
			 alert(des);	
			 var promise=DetailService.getdetail(des);
				promise.then(function(response) {
					 $scope.detail=JSON.parse(response.data.detail);
					 alert($scope.detail);
				},function(response){
					alert("Detail fail");
					$state.go("login",null,{
						reload:true
					});
			});
				 
			/*switch($rootScope.type){
			case 1: "noti"
				var promise=DetailService.getnotidetail();
				promise.then(function(response) {
					alert("response");
					 $scope.detail=JSON.parse(response.data.detail);
					 alert(response);
					 alert(reponse);
					 alert($scope.detail);
				},function(response){
					alert("Detail fail");
					$state.go("login",null,{
						reload:true
					});
				});
				break;
			case 2: vote
				var promise=DetailService.getvotedetail();
				promise.then(function(response) {
					 $scope.detail=JSON.parse(response.data.detail);
				},function(response){
					alert("Detail fail");
					$state.go("login",null,{
						reload:true
					});
				});
				break;
			}*/
		
}]);
/**
Copyright 2016 Google Inc. All Rights Reserved. 
Use of this source code is governed by an MIT-style license that can be in foundin the LICENSE file at http://material.angularjs.org/license.
**/