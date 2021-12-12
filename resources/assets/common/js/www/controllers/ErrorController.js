app.controller('ErrorController', ['$scope', '$rootScope', '$location',
    function($scope, $rootScope, $location) {
        $rootScope.hideLeftMenu = true;
        $rootScope.hideTopMenu = true;

        $scope.backToHome = function () {
            $location.path('/dashboard');
        }
    }
]);