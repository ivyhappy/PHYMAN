<?php if (!defined('THINK_PATH')) exit();?><!doctype html>

<html lang="en">

   <head>
     <meta charset="utf-8">
     <meta name="description" content="">
     <meta name="viewport" content="width=device-width, initial-scale=1">
     <title>Phyman</title>

    <!-- <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Roboto:400,500,700,400italic"> -->
     <link rel="stylesheet" href="./Background/Home/phyman-1/bower_components/angular-material/angular-material.css">
     <link rel="stylesheet" href="./Background/Home/phyman-1/assets/main.css">
<link rel="stylesheet" href="./Background/Home/phyman-1/bower_components/ng-grid-2.0.12/ng-grid.css">
<link rel="stylesheet" href="./Background/Home/phyman-1/modules/user/css/app.css">
     
     <link rel="stylesheet" href="./Background/Home/phyman-1/modules/user/css/app.css">
     <link rel="stylesheet" href="./Background/Home/phyman-1/modules/user/css/bootstrap.min.css">
     
     <style>
       [ng\:cloak], [ng-cloak], [data-ng-cloak], [x-ng-cloak], .ng-cloak, x-ng-cloak {
         display: none !important;
       }
     </style>
   </head>

   <body ng-app="phyman" layout="column" ng-cloak>

    <md-toolbar class="md-theme-indigo" layout="row" layout-align="start center"
          ng-controller="toolbarCtrl">
      <md-button id="nav-button" class="md-icon-button" hide-gt-sm ng-click="toggleList()" aria-label="Menu">
         <md-icon md-svg-src="./Background/Home/phyman-1/assets/images/ic_menu_48px.svg"></md-icon>
      </md-button>
      <span id="app-name" class="md-headline">PhyMan</span>
      <span flex></span>
      <md-button id="search-button" class="md-icon-button" ng-click="toggleAccount()" aria-label="Search">
         <md-icon md-svg-src="./Background/Home/phyman-1/assets/images/ic_search_48px.svg"></md-icon>
      </md-button>
      <md-menu>
        <md-button id="account-menu-button" class="md-icon-button" ng-click="$mdOpenMenu($event)" aria-label="Account">
           <md-icon md-svg-src="./Background/Home/phyman-1/assets/images/ic_person_48px.svg"></md-icon>
        </md-button>
        <md-menu-content width="2">
          <md-menu-item>
            <md-button ng-click="showLoginDlg()"><span md-menu-align-target>Login</span></md-button>
          </md-menu-item>
          <md-menu-item>
            <md-button ng-click="showRegisterDlg()"><span md-menu-align-target>Register</span></md-button>
          </md-menu-item>
        </md-menu-content>
      </md-menu>
    </md-toolbar>
    <div id="main" layout="row">
      <nav id="sidenav" ng-controller = 'navCtrl'>
        <md-sidenav class="md-sidenav-left"
         md-component-id="left"
         md-is-locked-open="$mdMedia('gt-sm')">
          <md-list layout-padding>
            <md-list-item class="md-1-line" ng-repeat="item in menuItems" ng-click="clickMenuItem(item.state)">
              <div layout="row">
                <md-icon md-svg-src="{{item.img}}"></md-icon>
                <span class="nav-item-text">{{item.title}}</span>
              </div>
            </md-list-item>
          </md-list>
        </md-sidenav>
      </nav>
      <section id="content" ui-view></section>
    </div>

       <script src="./Background/Home/phyman-1/bower_components/jquery-1.9.1.js"></script>

      <script src="./Background/Home/phyman-1/bower_components/angular/angular.js"></script>
      <script src="./Background/Home/phyman-1/bower_components/angular-material/angular-material.js"></script>
      <script src="./Background/Home/phyman-1/bower_components/angular-aria/angular-aria.js"></script>
      <script src="./Background/Home/phyman-1/bower_components/angular-animate/angular-animate.js"></script>
      <script src="./Background/Home/phyman-1/bower_components/angular-ui-router/release/angular-ui-router.js"></script>
      <script src="./Background/Home/phyman-1/bower_components/angular-messages/angular-messages.js"></script>
      <script src="./Background/Home/phyman-1/bower_components/angular-jwt/dist/angular-jwt.js"></script>


        <script src="./Background/Home/phyman-1/bower_components/ng-grid-2.0.12/ng-grid.debug.js"></script>

      <script src="./Background/Home/phyman-1/modules/user/controller/user.js"></script>
      <script src="./Background/Home/phyman-1/modules/user/route/user.js"></script>
      <script src="./Background/Home/phyman-1/modules/user/service/AuthService.js"></script>
      <script src="./Background/Home/phyman-1/modules/user/service/AuthDialog.js"></script>
      <script src="./Background/Home/phyman-1/assets/app.js"></script>
   </body>

</html>