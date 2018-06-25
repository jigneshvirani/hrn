// script.js

// create the module and name it scotchApp
// also include ngRoute for all our routing needs
var app = angular.module('EthiaApp', ['ngRoute', 'ui.bootstrap']);

app.config(['$interpolateProvider', function($interpolateProvider) {
  $interpolateProvider.startSymbol('[[');
  $interpolateProvider.endSymbol(']]');
}]);

app.config(function($logProvider) {
  $logProvider.debugEnabled(true);
});

// configure our routes
app.config(function($routeProvider, $locationProvider) {
  $routeProvider
    // route for the home page
    .when('/manage/dashboard', {
      controller: 'homeController',
      templateUrl: BASEURL + '/resources/views/angular/dashboard.html',
    }).
    
    otherwise({
        templateUrl: BASEURL + '/resources/views/front/404.html',
    });
 
  $locationProvider.html5Mode(true);
});

// Home controller
app.controller('homeController', function($scope, $http) {
  console.log('In');
});

// Main controller
app.controller('mainController', function($scope, $rootScope, $location, $http) {
  // create a message to display in our view
  //$('.selectpicker').selectpicker();

    $http.get('manage/getadmininfo', {
      cache: false
    }).
    success(function(response, status, headers, config) {
      $scope.adminInfo = response.data;
    }).
    error(function(data, status, headers, config) {});

    $scope.isActive = function (path) {
        return ($location.path().substr(1, $location.path().length) === path[0]) ? 'true' : '';
    }
});
