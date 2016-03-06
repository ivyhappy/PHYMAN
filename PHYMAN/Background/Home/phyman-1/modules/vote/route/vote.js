angular.module('phyman.vote')
.config(['$stateProvider', '$urlRouterProvider',function($stateProvider, $urlRouterProvider) {
    $stateProvider
    $stateProvider
    .state('vote',{
        url: '/vote',
        template: '<div ui-view></div>',
        abstract: true,
        resolve: {
            vote: ['VoteService',function(VoteService) {
               return VoteService.getList();
            }]
        },
        controller: 'VoteCtrl'
    })
    .state('vote.list',{
        url: '/list',
        templateUrl:'./Background/Home/phyman-1/modules/vote/views/list.html'
    })
    .state('vote.detail',{
        url: '/detail/{id}',
        templateUrl: './Background/Home/phyman-1/modules/vote/views/view.html',
        controller: 'VoteViewCtrl'
     })
    .state('vote.result',{
    	url:'/result/{id}',
    	templateUrl:'./Background/Home/phyman-1/modules/vote/views/result.html',
    	controller:'VoteResultCtrl'
    })
    .state('vote.edit',{
        url: '/edit',
        templateUrl: './Background/Home/phyman-1/modules/vote/views/edit.html',
        controller: 'VoteEditorCtrl'
    })
    .state('vote.new',{
        url: '/new',
        templateUrl: './Background/Home/phyman-1/modules/vote/views/edit.html',
        'controller': 'VoteEditorCtrl'
    })
 }]);
    /*.state('/PHYMAN/index.php',{
        	template:'<p>hello world</p>'
    })*/
/*    .state('VoteList', {
    	url: '/VoteList',
        templateUrl: '/PHYMAN/Background/Home/phyman-1/modules/vote/views/list.html',
     })*/
/* }]);*/
