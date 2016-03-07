angular.module('phyman.user', ['ngMessages', 'angular-jwt', 'ui.router','ngGrid'])

.controller('LoginCtrl', ['$scope', '$rootScope', 'AuthService', 'AuthDialog','$state',
    function($scope, $rootScope, AuthService, AuthDialog,$state){
  	$scope.isLoggingIn = false;
  	$scope.onLoginClick = function() {
          $scope.isLoggingIn = true;
          var promise = AuthService.login($scope.user);
          promise.then(function(response) {
              $scope.isLoggingIn = false;
             
              if(response.data.log==0){
              	//alert("Login成功");
              	$state.go("noti.list",null,{
              		reload:true
              	});
              	//alert("NotiList成功");
              	/* var promise1 =AuthService.getlist();
              	 promise.then(function(response) {
              		 alert("NotiList成功");
              		 alert($scope.user.list);
              		 $state.go("NotiList");
              	 },function(response){
              		 alert("NotiList fail");
              		 $state.go("login");
              	 });*/
              }
              else
              	$state.go("login",null,{
              		reload:true
              	});
              AuthDialog.hide();
          }, function(response) {
          	alert('shibainiao:'+response);
              $scope.isLoggingIn = false;
          });
      };
      $scope.cancel = function() {
          AuthDialog.cancel();
      };
  }])                        


    .controller('RegisterCtrl', ['$scope', '$rootScope', 'AuthService', 'AuthDialog',
        function($scope, $rootScope, AuthService, AuthDialog, $log){
            $scope.showPassword = false;
            $scope.isRegistering = false;
            $scope.toggleShowPassword = function() {	
            	$scope.showPassword = !$scope.showPassword;
            };
            $scope.cancel = function() {
                AuthDialog.cancel();
            };
            $scope.onRegisterClick = function() {
                $scope.isRegistering = true;
                var promise = AuthService.register($scope.user);
                promise.then(function(response) {
                	$scope.isRegistering = false;
                	AuthDialog.hide();
                }, function(error) {
                	$scope.isRegistering = false;
               	});
            };
    }])
    .controller('dataCtrl',['$scope', '$rootScope','AuthService',
        function($scope,$rootScope,AuthService){
			$scope.user=AuthService.getUser().data;
			
    }])    
   
    .controller('ResetPasswordCtrl', ['$scope', '$rootScope', 'AuthService',
        function($scope, $rootScope, AuthService){
        
    }])
    .controller('ForgetPasswordCtrl', ['$scope', '$rootScope', 'AuthService',
        function($scope, $rootScope, AuthService){
        
    }])
    .controller('getdataCtrl',['$scope', '$rootScope', 'AuthService',
        function($scope,$rootScope,AuthService){
    	$scope.jsonData=AuthService.getjson;
    	
    }]);




  /*  .controller('ListCtrl', function($scope, $http, $state, $stateParams) {
    $scope.filterOptions = {
        filterText: "",
        useExternalFilter: true
    };
    $scope.totalServerItems = 0;
    $scope.pagingOptions = {
        pageSizes: [5, 10, 20],
        pageSize: 5,
        currentPage: 1
    };
    $scope.setPagingData = function(data, page, pageSize) {
        var pagedData = data.slice((page - 1) * pageSize, page * pageSize);
        $scope.books = pagedData;
        $scope.totalServerItems = data.length;
        if (!$scope.$$phase) {
            $scope.$apply();
        }
    };
   //  console.log($stateParams);
    $scope.getPagedDataAsync = function(pageSize, page, searchText) {
        setTimeout(function() {
            var data;
            if (searchText) {
                var ft = searchText.toLowerCase();
                $http.get('./modules/user/data/books' + $stateParams.Type + '.json')
                    .success(function(largeLoad) {
                        data = largeLoad.filter(function(item) {
                            return JSON.stringify(item).toLowerCase().indexOf(ft) != -1;
                        });
                        $scope.setPagingData(data, page, pageSize);
                    });
            } else {
                $http.get('./modules/user/data/books' + $stateParams.Type + '.json')
                    .success(function(largeLoad) {
                        $scope.setPagingData(largeLoad, page, pageSize);
                    });
            }
        }, 100);
    };

    $scope.getPagedDataAsync($scope.pagingOptions.pageSize, $scope.pagingOptions.currentPage);

    $scope.$watch('pagingOptions', function(newVal, oldVal) {
        if (newVal !== oldVal && newVal.currentPage !== oldVal.currentPage) {
            $scope.getPagedDataAsync($scope.pagingOptions.pageSize, $scope.pagingOptions.currentPage, $scope.filterOptions.filterText);
        }
    }, true);
    $scope.$watch('filterOptions', function(newVal, oldVal) {
        if (newVal !== oldVal) {
            $scope.getPagedDataAsync($scope.pagingOptions.pageSize, $scope.pagingOptions.currentPage, $scope.filterOptions.filterText);
        }
    }, true);

    $scope.gridOptions = {
        data: 'books',
        rowTemplate: '<div style="height: 100%"><div ng-style="{ \'cursor\': row.cursor }" ng-repeat="col in renderedColumns" ng-class="col.colIndex()" class="ngCell ">' +
            '<div class="ngVerticalBar" ng-style="{height: rowHeight}" ng-class="{ ngVerticalBarVisible: !$last }"> </div>' +
            '<div ng-cell></div>' +
            '</div></div>',
        multiSelect: false,
        enableCellSelection:false,
        enableRowSelection: false,
        enableCellEdit: false,
        enablePinning: false,
        columnDefs: [{
            field: 'index',
            //displayName: '序号',
            width: 60,
            pinnable: false,
            sortable: false
        }, {
            field: 'name',
            //displayName: '书名',
            
            enableCellEdit: false

        }, {
            field: 'author',
            //displayName: '作者',
            enableCellEdit: true,
            width: 220
        }, {
            field: 'pubTime',
            //displayName: '出版日期',
            enableCellEdit: true,
            width: 120
        }, {
            field: 'price',
            //displayName: '定价',
            enableCellEdit: true,
            width: 120,
            cellFilter: 'currency:"￥"'
        }, {
            field: 'bookId',
            //displayName: '操作',
            
            enableCellEdit: false,
            sortable: false,
            pinnable: false
 ,           cellTemplate: '<div><a ui-sref="bookdetail({bookId:row.getProperty(col.field)})" id="{{row.getProperty(col.field)}}">详情</a></div>'
        }],
        enablePaging: true,
        showFooter: true,
        totalServerItems: 'totalServerItems',
        pagingOptions: $scope.pagingOptions,
        filterOptions: $scope.filterOptions
    };
});*/
