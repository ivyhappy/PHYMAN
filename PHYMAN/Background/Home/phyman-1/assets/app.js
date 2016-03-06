angular.module('phyman', ['ngGrid','phyman.user','phyman.noti','phyman.vote','phyman.detail','ui.router', 'ngAnimate', 'ngMaterial'])
	
    .run(['$rootScope', '$state', '$stateParams', function($rootScope, $state, $stateParams) {
    	$rootScope.API_HOST='http://localhost:8080/PHYMAN/index.php';
        $rootScope.$state = $state;
        $rootScope.$stateParams = $stateParams;
    }])
    /*.config(['$httpProvider', 'API_HOST', function($httpProvider, API_HOST) {
	   $httpProvider.interceptors.push(function() {
           return {
               'request': function(config) {
                   if(angular.equals(config.method, 'POST')) {
                       config.url = API_HOST + config.url;
                       config.timeout = 5000;
                   }
                   
                   return config;
               },
               'response': function(response) {
                   return response;
               }
           };
       });
   }])*/
    .config(['$stateProvider', '$urlRouterProvider','$locationProvider', function($stateProvider, $urlRouterProvider,$locationProvider) {
       $urlRouterProvider.otherwise('/');
       /*$locationProvider.html5Mode({
   		enabled:true,
   		requireBase:false
   	});*/
      // $urlRouterProvider.otherwise('/PHYMAN/index.php');
       $stateProvider.state('/index', {
           url: '/',
           template: '<p>Main content here.</p>'
       })

   }])
    .controller('navCtrl', ['$state', '$scope', '$mdSidenav',
        function($state, $scope, $mdSidenav ) {
        $scope.menuItems = [{
        	title: '通知',
            state: 'noti.list',
            img: './Background/Home/phyman-1/assets/images/ic_new_releases_48px.svg'
        },{
            title: '投票',
            state: 'vote.list',
            img: './Background/Home/phyman-1/assets/images/ic_check_48px.svg'
        },{
            title: '有问必答',
            state: 'comments',
            img: './Background/Home/phyman-1/assets/images/ic_chat_48px.svg'
        },{
            title: '标签',
            state: 'marked',
            img: './Background/Home/phyman-1/assets/images/ic_bookmark_48px.svg'
        },{
            title: 'Deleted',
            state: 'deleted',
            img: './Background/Home/phyman-1/assets/images/ic_close_48px.svg'
        },{
            title: '设置',
            state: 'settings',
            img: './Background/Home/phyman-1/assets/images/ic_settings_48px.svg'
        }];

        $scope.clickMenuItem = function(state) {
            $state.go(state,null,{
            	reload:true
            });
        };
        $scope.toggleList = function() {
            $mdSidenav('left').toggle();
        };
    }])
   .controller('toolbarCtrl', ['$state', '$scope', '$mdSidenav', 'AuthDialog',
        function($state, $scope, $mdSidenav, AuthDialog) {
        $scope.toggleList = function() {
            $mdSidenav('left').toggle();
        };
        $scope.showLoginDlg = function(ev) {
            AuthDialog.showLoginDialog(ev);
        };
        $scope.showRegisterDlg = function(ev) {
            AuthDialog.showRegisterDialog(ev);
        };
    }]);














