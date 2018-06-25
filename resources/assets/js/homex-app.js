// homex-app.js
// @Author  Jigs Virani
// create the module and name it scotchApp
// also include ngRoute for all our routing needs
var app = angular.module('HomeXApp', ['ngRoute', 'ui.bootstrap', 'ng-sweet-alert', 'mm.acl','ngSanitize']);
app.config(['$interpolateProvider', function($interpolateProvider) {
    $interpolateProvider.startSymbol('[[');
    $interpolateProvider.endSymbol(']]');
}]);

app.config(function($logProvider){
    $logProvider.debugEnabled(true);
});
// configure our routes
app.config(['$routeProvider', '$locationProvider',
    function($routeProvider, $locationProvider) {
        $routeProvider.
        when('/manage/dashboard', {
            templateUrl: 'resources/views/manage/dashboard/dashboard.html',
            controller: 'dashboardController',
            title: 'London Hot Right Now | Dashboard'
        }).
        otherwise({
            redirectTo: '/manage/dashboard'
        });
        $locationProvider.html5Mode(true);
    }
]);

// Dashboard controller.
app.controller('dashboardController', ['$scope', function($scope) {
    // Create the chart
    // Highcharts.setOptions({
    //     colors: ['red', 'blue', '#ED561B', '#DDDF00']
    // });
    // Highcharts.chart('container', {
    //     chart: {
    //         type: 'pie',
    //         width: '300'
    //     },
    //     title: 'null',
    //     plotOptions: {
    //         series: {
    //             dataLabels: {
    //                 enabled: false,
    //                 format: '{point.name}: {point.y:.1f}%'
    //             }
    //         }
    //     },
    //     tooltip: {
    //         headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
    //         pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:.2f}%</b> of total<br/>'
    //     },
    //     series: [{
    //         name: 'Brands',
    //         colorByPoint: true,
    //         data: [
    //             ['Microsoft Internet Explorer', 77],
    //             ['vaidehee', 3],
    //             ['hello', 8.5],
    //             ['by', 11],
    //         ]
    //     }],
    //     plotOptions: {
    //         pie: {
    //             allowPointSelect: true,
    //             cursor: 'pointer',
    //             dataLabels: {
    //                 enabled: false
    //             }
    //         }
    //     },
    //     drilldown: {
    //         series: [{
    //             name: 'Microsoft Internet Explorer',
    //             id: 'Microsoft Internet Explorer',
    //             data: [
    //                 ['v11.0', 24.13],
    //                 ['v8.0', 17.2],
    //                 ['v9.0', 8.11],
    //                 ['v10.0', 5.33],
    //                 ['v6.0', 1.06],
    //                 ['v7.0', 0.5]
    //             ]
    //         }, {
    //             name: 'Chrome',
    //             id: 'Chrome',
    //             data: [
    //                 ['v40.0', 5],
    //                 ['v41.0', 4.32],
    //                 ['v42.0', 3.68],
    //                 ['v39.0', 2.96],
    //                 ['v36.0', 2.53],
    //                 ['v43.0', 1.45],
    //                 ['v31.0', 1.24],
    //                 ['v35.0', 0.85],
    //                 ['v38.0', 0.6],
    //                 ['v32.0', 0.55],
    //                 ['v37.0', 0.38],
    //                 ['v33.0', 0.19],
    //                 ['v34.0', 0.14],
    //                 ['v30.0', 0.14]
    //             ]
    //         }, {
    //             name: 'Firefox',
    //             id: 'Firefox',
    //             data: [
    //                 ['v35', 2.76],
    //                 ['v36', 2.32],
    //                 ['v37', 2.31],
    //                 ['v34', 1.27],
    //                 ['v38', 1.02],
    //                 ['v31', 0.33],
    //                 ['v33', 0.22],
    //                 ['v32', 0.15]
    //             ]
    //         }, {
    //             name: 'Safari',
    //             id: 'Safari',
    //             data: [
    //                 ['v8.0', 2.56],
    //                 ['v7.1', 0.77],
    //                 ['v5.1', 0.42],
    //                 ['v5.0', 0.3],
    //                 ['v6.1', 0.29],
    //                 ['v7.0', 0.26],
    //                 ['v6.2', 0.17]
    //             ]
    //         }, {
    //             name: 'Opera',
    //             id: 'Opera',
    //             data: [
    //                 ['v12.x', 0.34],
    //                 ['v28', 0.24],
    //                 ['v27', 0.17],
    //                 ['v29', 0.16]
    //             ]
    //         }]
    //     }
    // });
    // Highcharts.chart('container1', {
    //     chart: {
    //         type: 'pie',
    //         width: '300'
    //     },
    //     title: 'null',
    //     plotOptions: {
    //         series: {
    //             dataLabels: {
    //                 enabled: false,
    //                 format: '{point.name}: {point.y:.1f}%'
    //             }
    //         }
    //     },
    //     exporting: {
    //         buttons: {
    //             contextButton: {
    //                 symbolStroke: 'red'
    //             }
    //         }
    //     },
    //     tooltip: {
    //         headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
    //         pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:.2f}%</b> of total<br/>'
    //     },
    //     series: [{
    //         name: 'Brands',
    //         colorByPoint: true,
    //         data: [
    //             ['Microsoft Internet Explorer', 25],
    //             ['vaidehee', 15],
    //             ['hello', 5],
    //             ['by', 11],
    //             ['by', 20],
    //         ]
    //     }],
    //     plotOptions: {
    //         pie: {
    //             allowPointSelect: true,
    //             cursor: 'pointer',
    //             dataLabels: {
    //                 enabled: false
    //             }
    //         }
    //     },
    //     drilldown: {
    //         series: [{
    //             name: 'Microsoft Internet Explorer',
    //             id: 'Microsoft Internet Explorer',
    //             data: [
    //                 ['v11.0', 24.13],
    //                 ['v8.0', 17.2],
    //                 ['v9.0', 8.11],
    //                 ['v10.0', 5.33],
    //                 ['v6.0', 1.06],
    //                 ['v7.0', 0.5]
    //             ]
    //         }, {
    //             name: 'Chrome',
    //             id: 'Chrome',
    //             data: [
    //                 ['v40.0', 5],
    //                 ['v41.0', 4.32],
    //                 ['v42.0', 3.68],
    //                 ['v39.0', 2.96],
    //                 ['v36.0', 2.53],
    //                 ['v43.0', 1.45],
    //                 ['v31.0', 1.24],
    //                 ['v35.0', 0.85],
    //                 ['v38.0', 0.6],
    //                 ['v32.0', 0.55],
    //                 ['v37.0', 0.38],
    //                 ['v33.0', 0.19],
    //                 ['v34.0', 0.14],
    //                 ['v30.0', 0.14]
    //             ]
    //         }, {
    //             name: 'Firefox',
    //             id: 'Firefox',
    //             data: [
    //                 ['v35', 2.76],
    //                 ['v36', 2.32],
    //                 ['v37', 2.31],
    //                 ['v34', 1.27],
    //                 ['v38', 1.02],
    //                 ['v31', 0.33],
    //                 ['v33', 0.22],
    //                 ['v32', 0.15]
    //             ]
    //         }, {
    //             name: 'Safari',
    //             id: 'Safari',
    //             data: [
    //                 ['v8.0', 2.56],
    //                 ['v7.1', 0.77],
    //                 ['v5.1', 0.42],
    //                 ['v5.0', 0.3],
    //                 ['v6.1', 0.29],
    //                 ['v7.0', 0.26],
    //                 ['v6.2', 0.17]
    //             ]
    //         }, {
    //             name: 'Opera',
    //             id: 'Opera',
    //             data: [
    //                 ['v12.x', 0.34],
    //                 ['v28', 0.24],
    //                 ['v27', 0.17],
    //                 ['v29', 0.16]
    //             ]
    //         }]
    //     }
    // });
    // var chart = Highcharts.chart('container2', {
    //     title: {
    //         text: null
    //     },
    //     subtitle: {
    //         text: null
    //     },
    //     xAxis: {
    //         categories: ['Aug', 'Jul', 'May', 'Apr', 'Mar', 'Feb', 'Jan', 'Dec']
    //     },
    //     series: [{
    //         type: 'column',
    //         colorByPoint: false,
    //         data: [29.9, 71.5, 106.4, 129.2, 144.0, 176.0, 135.6, 148.5],
    //         showInLegend: false
    //     }]
    // });
}]);

app.config(function($httpProvider) {
    $httpProvider.responseInterceptors.push('myHttpInterceptor');
    var spinnerFunction = function spinnerFunction(data, headersGetter) {
        $(".page-spinner-bar").show();
        return data;
    };
    $httpProvider.defaults.transformRequest.push(spinnerFunction);
});
app.factory('myHttpInterceptor', function($q, $window) {
    return function(promise) {
        return promise.then(function(response) {
            $(".page-spinner-bar").hide();
            // checklogin(response.data);
            return response;
        }, function(response) {
            $(".page-spinner-bar").hide();
            return $q.reject(response);
        });
    };
});
