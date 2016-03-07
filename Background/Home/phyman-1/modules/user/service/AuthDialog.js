angular.module('phyman.user')
    .factory('AuthDialog', ['$mdDialog', '$state',function($mdDialog,$state){
        return {
            cancel: function() {
                $mdDialog.hide();
            },
            hide: function() {
                $mdDialog.hide();
            },
            showLoginDialog: function(ev) {
              /*  $mdDialog.hide();
                $state.go("lg",null,{
                	reload:true
                });*/
                $mdDialog.show({
                    controller: 'LoginCtrl',
                    templateUrl: './Background/Home/phyman-1/modules/user/views/login.html',
                    parent: angular.element(document.body),
                    targetEvent: ev,
                    clickOutsideToClose: false
                });
            },
            showRegisterDialog: function(ev) {
                $mdDialog.hide();
                $state.go("login",null,{
                	reload:true
                });
                $mdDialog.show({
                    controller: 'RegisterCtrl',
                    templateUrl: './Background/Home/phyman-1/modules/user/views/register.html',
                    reload:true,
                    parent: angular.element(document.body),
                    clickOutsideToClose: false
                });
            }
        };
    }])