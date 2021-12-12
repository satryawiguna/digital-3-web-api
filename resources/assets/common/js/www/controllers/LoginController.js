app.controller('LoginController', ['$scope', '$rootScope', '$window', '$location', 'Authentication',
    function ($scope, $rootScope, $window, $location, Authentication) {
        $rootScope.hideLeftMenu = true;
        $rootScope.hideTopMenu = true;

        $scope.signIn = function () {
            $scope.error = false;
            $scope.loading = true;

            Authentication.signIn($scope.login)
                .success(function () {
                    $scope.loading = false;
                })
                .error(function (error) {
                    console.log(error);

                    $scope.loading = false;
                });
        }
    }
]);