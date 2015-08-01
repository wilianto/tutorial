var gcmPhpApp = angular.module('gcmPhpApp', [
    'ngRoute',
    'gcmPhpControllers'
]);

gcmPhpApp.config(['$routeProvider', function($routeProvider){
    $routeProvider.
    when('/list', {
        'templateUrl': 'partials/list.html',
        'controller': 'ListController'
    }).
    when('/detail/:id', {
        'templateUrl': 'partials/detail.html',
        'controller': 'DetailController'
    }).
    otherwise({
        'redirectTo': '/list'
    });
}]);
