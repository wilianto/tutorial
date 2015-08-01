var gcmPhpControllers = angular.module('gcmPhpControllers', []);

gcmPhpControllers.controller('ListController', ['$scope', '$http', function($scope, $http){
    $http.get('http://wilianto.com/tutorial/gcm_php/server/api/news_list.php').success(function(success){
        $scope.news_list = success;
    });
}]);

gcmPhpControllers.controller('DetailController', ['$scope', '$http', '$routeParams', function($scope, $http, $routeParams){
    $http.get('http://wilianto.com/tutorial/gcm_php/server/api/news_detail.php?id='+$routeParams.id).success(function(success){
        $scope.news = success;
    });
}]);
