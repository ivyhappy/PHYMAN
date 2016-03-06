angular.module('phyman.vote')
.config(['$httpProvider', 'jwtInterceptorProvider', function($httpProvider, jwtInterceptorProvider) {
    jwtInterceptorProvider.urlParam = 'access_token';
    jwtInterceptorProvider.tokenGetter = function() {
        return localStorage.getItem('id_token');
    };
    $httpProvider.interceptors.push('jwtInterceptor');
}])
.factory('VoteService', ['$http', '$q', '$rootScope', 'jwtHelper', '$log',
    function($http, $q, $rootScope, jwtHelper, $log) {
    var vote={};
    //var notidetail={};
    var onIdentity  = function(response) {
        //Do something at backend on identity secceed.
    	 noti=response.data.list;
     }
	var onIdFail = function(error) {
        //Do something at backend on identity failed.
    };

    return {
        getlistdetail: function() {
            return this.list;
        },
        setVote:function(item,id){
        	console.log(item);
        	 var deferred = $q.defer();
             $http.post('/PHYMAN/index.php/Home/Vote/userVote', {
                 username: $rootScope.username,
                 choose:item,
                 id:id,
                 access_token: $rootScope.access_token
             })
             .then(function(response) {
             	//$rootScope.list=response.data.list;
             	onIdentity(response);
                 deferred.resolve(response);
             }, function(error) {
             	console.log(erro);
                 onIdFail(error);
                 deferred.reject(error);
             });
             return deferred.promise;
        },
        getList:function() {
            var deferred = $q.defer();
            $http.post('/PHYMAN/index.php/Home/Vote/getList', {
                username: $rootScope.username,
                access_token: $rootScope.access_token
            })
            .then(function(response) {
            	//$rootScope.list=response.data.list;
            	onIdentity(response);
                deferred.resolve(response);
            }, function(error) {
            	console.log(erro);
                onIdFail(error);
                deferred.reject(error);
            });
            return deferred.promise;
        },
        getResult: function(id){
        	var deferred = $q.defer();
            $http.post('/PHYMAN/index.php/Home/Vote/getVoteResult', {
                username: $rootScope.username,
                id:id,
                access_token: $rootScope.access_token
            })
            .then(function(response) {
            	//$rootScope.list=response.data.list;
            	onIdentity(response);
                deferred.resolve(response);
            }, function(error) {
            	console.log(erro);
                onIdFail(error);
                deferred.reject(error);
            });
            return deferred.promise;
        },
        getDetail: function(vote) {
        	 var deferred = $q.defer();
             $http.post('/PHYMAN/index.php/Home/Vote/getVoteDetail', {
            	 username: $rootScope.username,
            	 access_token: $rootScope.access_token,
            	 id:vote
             })
             .then(function(response) {
             	console.log("response");
             	console.log(response.data);
                // onVotedetail(response);
                 deferred.resolve(response);
             }, function(error) {
                 onIdFail(error);
                 deferred.reject(error);
             });
             return deferred.promise;

        }       
    };
}])
.filter('votedetailFilter',function() {
	return function(input,num){
		var out=input*100/num;
		console.log(out);
	return out;
	}
	
})
.filter('perFilter',function() {
	return function(input,num){
		var out=input*100/num;
		console.log(out);
	return out.toFixed(2)+"%";
	}
	
})



.filter('voteFilter',function() {
    return function(items,createdTime) {
        var now = new Date();
        var month = now.getMonth() + 1;
        var thisMonth = now.getFullYear() + '-' + (month > 10 ? month : '0' + month) + '-01';
        var filterItems = new Array();
        if(angular.equals(createdTime,'new')) {
            angular.forEach(items,function(item) {
                if(item.begtime.slice(0,10) >= thisMonth) {
                    filterItems.push(item);
                }
            });
            return filterItems;
        } 
        if(angular.equals(createdTime,'old')) {
            angular.forEach(items,function(item) {
                if(item.begtime.slice(0,10) < thisMonth) {
                    filterItems.push(item);
                }
            });
            return filterItems;
        }
        return items;
    }
});