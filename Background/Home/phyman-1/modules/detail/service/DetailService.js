angular.module('phyman.detail')
.config(['$httpProvider', 'jwtInterceptorProvider', function($httpProvider, jwtInterceptorProvider) {
    jwtInterceptorProvider.urlParam = 'access_token';
    jwtInterceptorProvider.tokenGetter = function() {
        return localStorage.getItem('id_token');
    };
    $httpProvider.interceptors.push('jwtInterceptor');
}])
.factory('DetailService', ['$http', '$q', '$rootScope', 'jwtHelper', '$log',
    function($http, $q, $rootScope, jwtHelper, $log) {
    var detail={};
    //var notidetail={};
    var onIdentity  = function(response) {
        //Do something at backend on identity secceed.
    	 detail=response.data.detail;
     }
    var onNotiDetail= function(response){
    	detail=response.data.detail;
    }
	var onIdFail = function(error) {
        //Do something at backend on identity failed.
    };

    return {
       getdetail: function(des) {
        	 var deferred = $q.defer();
             $http.post(des, {
            	 username: $rootScope.username,
            	 access_token: $rootScope.access_token,
            	 id:$rootScope.detailid,
             })
             .then(function(response) {
             	console.log("response");
             	console.log(response.data);
                 onIdentity(response);
                 deferred.resolve(response);
             }, function(error) {
                 onIdFail(error);
                 deferred.reject(error);
             });
             return deferred.promise;

        },
    getvotedetail: function() {
   	 var deferred = $q.defer();
        $http.post('/PHYMAN/index.php/Home/Vote/getVoteDetail', {
       	 username: $rootScope.username,
       	 access_token: $rootScope.access_token,
       	 id:$rootScope.voteid,//$rootScope.notiid,
        })
        .then(function(response) {
        	console.log("response");
        	console.log(response.data);
            //onNotidetail(response);
            deferred.resolve(response);
        }, function(error) {
            onIdFail(error);
            deferred.reject(error);
        });
        return deferred.promise;

   }
    
    
    
    };
}]);