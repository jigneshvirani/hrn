// script.js

// create the module and name it scotchApp
// also include ngRoute for all our routing needs
var app = angular.module('HomeXApp', ['ngRoute','ui.bootstrap']);

// configure our routes
app.config(['$routeProvider', '$locationProvider',
    function ($routeProvider, $locationProvider) {
        $routeProvider.
        when('/manage/dashboard', {
            templateUrl: 'resources/views/manage/dashboard/dashboard.html',
            controller: 'dashboardController'
        }).
        otherwise({
                    redirectTo: '/manage/dashboard'
                });
        $locationProvider.html5Mode(true);
}]);


app.controller('mainController', function($scope) {
    // creat e a message to display in our view
    $('.selectpicker').selectpicker();
});