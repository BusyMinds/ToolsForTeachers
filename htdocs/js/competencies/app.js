'use strict';


// Declare app level module which depends on filters, and services
// angular.module('myApp', ['myApp.filters', 'myApp.services', 'myApp.directives', 'myApp.controllers']).
angular.module('myApp', ['myApp.controllers','ui.bootstrap']).
  config(['$routeProvider', function($routeProvider) {
    $routeProvider.when('/list', {templateUrl: 'partials/list.tpl.php', controller: 'ListController'});
    $routeProvider.when('/edit', {templateUrl: 'partials/edit.tpl.php', controller: 'EditController'});
    $routeProvider.otherwise({redirectTo: '/list'});
  }]);
