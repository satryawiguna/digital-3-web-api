app.controller('UserController', ['$scope', '$rootScope', '$location', '$http', '$routeParams', 'User', 'HandphoneCode', 'Role', 'Session', 'Urls', 'BASE_API_URL', 'AUTH_EVENTS', 'LOADING_EVENTS',
    function ($scope, $rootScope, $location, $http, $routeParams, User, HandphoneCode, Role, Session, Urls, BASE_API_URL, AUTH_EVENTS, LOADING_EVENTS) {
        HandphoneCode.getHandphoneCodeList()
            .success(function (response) {
                $scope.handphone_codes = response.data.dto;
            })
            .error(function (xhr, error, thrown) {
                console.log(xhr);
                console.log(error);
                console.log(thrown);

                if (xhr.status == 401) {
                    $rootScope.$broadcast(AUTH_EVENTS.tokenExpired);
                }
            });

        Role.getRoleList()
            .success(function (response) {
                $scope.roles = response.data.dto;
            })
            .error(function (xhr, error, thrown) {
                console.log(xhr);
                console.log(error);
                console.log(thrown);

                if (xhr.status == 401) {
                    $rootScope.$broadcast(AUTH_EVENTS.tokenExpired);
                }
            });

        $scope.update = function () {
            $scope.loading = true;

            User.update($scope.data)
                .success(function (response) {
                    console.log(response);

                    $scope.loading = false;

                    $location.path(Urls.previous.url);
                })
                .error(function (xhr, error, thrown) {
                    console.log(xhr);
                    console.log(error);
                    console.log(thrown);

                    if (xhr.status == 401) {
                        $rootScope.$broadcast(AUTH_EVENTS.tokenExpired);
                    }
                });
        };

        $scope.cancel = function () {
            $location.path(Urls.previous.url);
        };

        $scope.initializeRole = function () {
            $('#validation-role').select2({
                placeholder: "- Please Search -",
                minimumResultsForSearch: -1
            });
        };

        $scope.initializeHandphoneCode = function () {
            $('#validation-handphone_code').select2({
                placeholder: "- Code -",
                minimumResultsForSearch: -1
            });
        };

        if (Urls.getActionUrl($location.absUrl(), 'edit')) {
            User.getDetail($routeParams.id)
                .success(function (response) {
                    $scope.data = response.dto;
                    $scope.data.role = {
                        id: $scope.data.role[0].id
                    };

                    console.log($scope.data);

                })
                .error(function (xhr, error, thrown) {
                    console.log(xhr);
                    console.log(error);
                    console.log(thrown);

                    if (xhr.status == 401) {
                        $rootScope.$broadcast(AUTH_EVENTS.tokenExpired);
                    }
                });
        };

        if (Urls.getActionUrl($location.absUrl(), 'add')) {
            // Nothing todo here
        };
    }
]);
