angular.module('phyman.noti')
.config(['$httpProvider', 'jwtInterceptorProvider', function($httpProvider, jwtInterceptorProvider) {
    jwtInterceptorProvider.urlParam = 'access_token';
    jwtInterceptorProvider.tokenGetter = function() {
        return localStorage.getItem('id_token');
    };
    $httpProvider.interceptors.push('jwtInterceptor');
}])
.factory('NotiService', ['$http', '$q', '$rootScope', 'jwtHelper', '$log',
    function($http, $q, $rootScope, jwtHelper, $log) {
    var noti={};
    var notiId;
    //var notidetail={};
   /* var onIdentity  = function(response) {
        //Do something at backend on identity secceed.
    	 noti=response.data.list;
     }
    var onNotidetail= function(response){
    	noti.detail=response.data.notification;
    }*/
	var onIdFail = function(error) {
        //Do something at backend on identity failed.
    };

    return {
        /*getlistdetail: function() {
            return this.list;
        },*/
        getList:function(id) {
            var deferred = $q.defer();
            $http.post('/PHYMAN/index.php/Home/Noti/getList', {
                username: $rootScope.username,
                access_token: $rootScope.access_token
            })
            .then(function(response) {
            	console.log("getlist");
            	console.log(response.data.list);
                deferred.resolve(response);
            }, function(error) {
            	console.log(erro);
                onIdFail(error);
                deferred.reject(error);
            });
            return deferred.promise;
        },
        setNotiid:function(id){
        	notiId=id;
        /*	$rootScope.detailid=id;
        	$rootScope.type="Noti";
        	console.log($rootScope.notiid);
        	console.log($rootScope.type);*/
        },
        
        getDetail: function(id) {
        	 var deferred = $q.defer();
             $http.post('/PHYMAN/index.php/Home/Noti/getNotiDetail', {
            	 username: $rootScope.username,
            	 access_token: $rootScope.access_token,
            	 id:id,//$rootScope.notiid,
             })
             .then(function(response) {
             	console.log("response");
             	console.log(response.data);
             	//noti.detail=response.data.notification;
                 //onNotidetail(response);
                 deferred.resolve(response);
             }, function(error) {
                 onIdFail(error);
                 deferred.reject(error);
             });
             return deferred.promise;

        },
        updateNoti: function(noti) {
            var deferred = $q.defer();
            $http.post('/PHYMAN/index.php/Home/Admin/newNoti',{
            	username: $rootScope.username,
                title: noti.title,
                body:noti.content
                
            })
            .then(function(response) {
                deferred.resolve(response);
            }),function(error) {
                onFail(error);
                deferred.reject(error);
            };
            return deferred.promise;
        },
        deleteNoti: function(id) {
            var deferred = $q.defer();
            $http.post('/PHYMAN/index.php/Home/Noti/deleteNoti',{
                id:id
            })
            .then(function(response) {

            },function(error) {
                onFail(error);
                deferred.reject(error);
            });
            return deferred.promise;
        }
    };
}])
.filter('notiFilter',function() {
    return function(items,createdTime) {
        var now = new Date();
        var month = now.getMonth() + 1;
        var thisMonth = now.getFullYear() + '-' + (month > 10 ? month : '0' + month) + '-01';
        var filterItems = new Array();
        if(angular.equals(createdTime,'new')) {
            angular.forEach(items,function(item) {
                if(item.date.slice(0,10) >= thisMonth) {
                    filterItems.push(item);
                }
            });
            return filterItems;
        } 
        if(angular.equals(createdTime,'old')) {
            angular.forEach(items,function(item) {
                if(item.date.slice(0,10) < thisMonth) {
                    filterItems.push(item);
                }
            });
            return filterItems;
        }
        return items;
    }
});
  
