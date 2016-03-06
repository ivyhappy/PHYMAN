angular.module('phyman.user')
    .config(['$stateProvider', '$urlRouterProvider',function($stateProvider, $urlRouterProvider) {
        $stateProvider
  /*      .state('/PHYMAN/index.php',{
        	template:'<p>hello world</p>'
        })
        .state('lg',{
        	url:'/PHYMAN/index.php',
        	template:"",
        })
        .state('/',{
        	//url:'/PHYMAN/index.php',
        	template:'<p>hello world</p>',
        		
        })*/
        .state('login',{
        	 url: '/login',
        	 templateUrl:'./Background/Home/phyman-1/modules/user/views/test.html'
        })
        .state('forget_password', {
             url: '/forget_password',
             templateUrl: 'modules/user/views/forget_password.html',
             controller: 'ForgetPasswordCtrl'
        })
        .state('reset_password', {
             url: '/PHYMAN/reset_password',
             templateUrl: './Background/Home/phyman-1/modules/user/views/reset_password.html',
             controller: 'ResetPasswordCtrl'
        })
       
      /*  .state('voteList', {
        	url: '/PHYMAN/index.php/Home/Vote/getList',
            templateUrl: './Background/Home/phyman-1/modules/vote/views/list.html',
        }) 
       * .state('NotiList', {
             url: '/PHYMAN/index.php/Home/Noti/getList',
             views: {
             '': {
                 templateUrl: './Background/Home/phyman-1/modules/user/views/home.html'
             },
             'main@notifications/list': {
                 templateUrl: './Background/Home/phyman-1/modules/ /views/list.html'
             //}
         }
                templateUrl: 'modules/user/views/home.html'
                
            })*/
        /*     .state('/index', {
            url: '/index',
             templateUrl: 'modules/user/views/loginForm.html'
            
        })*/
            .state('list', {
            	url:'PHYMAN/index.php/list',
            	  templateUrl: './Background/Home/phyman-1/modules/user/views/List.html'
            	/*views: { //注意这里的写法，当一个页面上带有多个ui-view的时候如何进行命名和视图模板的加载动作
                    '': {
                        templateUrl: './Background/Home/phyman-1/modules/user/views/List.html'
                    },
                    'type@list': {
                        templateUrl: './Background/Home/phyman-1/modules/user/views/type.html'
                    }
                }*/
           /* url: '/list'+'{Type:[0-9]{1,4}}',
            views: { //注意这里的写法，当一个页面上带有多个ui-view的时候如何进行命名和视图模板的加载动作
                '': {
                    templateUrl: './Background/Home/phyman-1/modules/user/views/List.html'
                },
                'type@list': {
                    templateUrl: './Background/Home/phyman-1/modules/user/views/type.html'
                },
                'bookgrid@list': {
                    templateUrl: './Background/Home/phyman-1/modules/user/views/listGrid.html'
                }
            }*/
        })
        .state('addnoti', {
            url: '/addbook',
            templateUrl: './Background/Home/phyman-1/modules/user/views/addNotiForm.html'
        })
        .state('bookdetail', {
            url: '/bookdetail/:bookId', //注意这里在路由中传参数的方式
            templateUrl: './Background/Home/phyman-1/modules/user/views/bookDetail.html'
        });



            
            
    }]);