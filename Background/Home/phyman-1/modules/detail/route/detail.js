angular.module('phyman.detail')
.config(['$stateProvider', '$urlRouterProvider',function($stateProvider, $urlRouterProvider) {
    $stateProvider
   /* .state('/PHYMAN/index.php',{
        	template:'<p>hello world</p>'
    })*/
     .state('NotiDetail',{
    	 url: '/NotiDetail/{notidetail}',//type:noti}{notidetail:{{list.
    	// template:'<p>hello world</p>'
    	 templateUrl:'./Background/Home/phyman-1/modules/detail/views/notidetail.html',
     })
      .state('VoteDetail',{
    	 url: '/VoteDetail',
    	// template:'<p>hello world</p>'
    	 templateUrl:'./Background/Home/phyman-1/modules/detail/views/votedetail.html',
     })
 }]);