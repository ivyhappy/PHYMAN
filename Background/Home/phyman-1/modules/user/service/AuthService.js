angular.module('phyman.user')
.config(['$httpProvider', 'jwtInterceptorProvider', function($httpProvider, jwtInterceptorProvider) {
    jwtInterceptorProvider.urlParam = 'access_token';
    jwtInterceptorProvider.tokenGetter = function() {
        return localStorage.getItem('id_token');
    };
    $httpProvider.interceptors.push('jwtInterceptor');
}])
.factory('AuthService', ['$http', '$q', '$rootScope', 'jwtHelper', '$log',
    function($http, $q, $rootScope, jwtHelper, $log) {
    var user = {};
    var onIdentity = function(response) {
        //Do something at backend on identity secceed.
    	user=response;
    }
    var getjson= function(){
    	return user;
    }
     var onIdFail = function(error) {
        //Do something at backend on identity failed.
    };

    return {
        getUser: function() {
            return user;
        },
        register: function(params) {
            var deferred = $q.defer();
            $http.post('/register', {
                username: params.username,
                password: params.password
            })
            .then(function(response) {
                onIdentity(response);
                deferred.resolve(response);
            }, function(error) {
                onIdFail(error);
                deferred.reject(error);
            });
            return deferred.promise;
        },
        login: function(user) {
            var deferred = $q.defer();
            $http.post($rootScope.API_HOST+'?m=Home&c=Index&a=login', {//'/PHYMAN/index.php/Home/Index/login'
                username: user.username,
                password: user.password
            })
            .then(function(response) {
            	/*console.log("loginsuc");
            	console.log(response.data.username);*/
            	$rootScope.username=response.data.username;
                $rootScope.access_token=response.data.access_token;
                onIdentity(response);
                deferred.resolve(response);
            }, function(error) {
                onIdFail(error);
                deferred.reject(error);
            });
            return deferred.promise;
        },
        logout: function(user) {
            user = null;
            $http.get('/logout').success(function() {
                localStorage.removeItem('id_token');
            });
        },
        forgetPassword: function(user) {

        },
        resetPassword: function(user) {
            $http.post('/reset_password', {
                new_password: user.password
            })
            .then(function(response) {

            }, function(error) {

            });
        },
        checkLoggedIn: function() {
            var token = localStorage.getItem('id_token');
            if(angular.equals(token, null) || jwtHelper.isTokenExpired(token)) {
                return false;
            }
            return true;
        },
        checkLoggedOut: function() {
            var token = localStorage.getItem('id_token');
            if(angular.equals(token, null) || jwtHelper.isTokenExpired(token)) {
                return true;
            }
            return false;
        }
        
    };
}]);