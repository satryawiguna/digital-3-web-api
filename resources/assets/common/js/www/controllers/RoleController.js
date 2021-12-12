app.controller('RoleController', ['$scope', '$rootScope', '$location', '$http', '$compile', '$routeParams', 'DTOptionsBuilder', 'DTColumnBuilder', 'Urls', 'Role', 'Session', 'Notification', 'BASE_API_URL', 'AUTH_EVENTS', 'LOADING_EVENTS', 'OTHER_EVENTS',
    function ($scope, $rootScope, $location, $http, $compile, $routeParams, DTOptionsBuilder, DTColumnBuilder, Urls, Role, Session, Notification, BASE_API_URL, AUTH_EVENTS, LOADING_EVENTS, OTHER_EVENTS) {
        $scope.dtInstance = {};

        $scope.edit = function (id) {
            $location.path('/role/edit/' + id);
        };

        $scope.delete = function (id) {
            swal({
                title: "Are you sure?",
                text: "This item will be remove",
                showCancelButton: true,
                confirmButtonColor: "#ff0000",
                confirmButtonText: "Yes, delete!",
                closeOnConfirm: true
            }, function () {
                Role.delete(id).success(function (response) {
                        console.log(response);

                        $rootScope.$broadcast(OTHER_EVENTS.messages, {
                            type: response._messages[0].type,
                            text: response._messages[0].text
                        });

                        $scope.reloadData();
                    })
                    .error(function (xhr, error, thrown) {
                        console.log(xhr);
                        console.log(error);
                        console.log(thrown);

                        if (xhr.status == 401) {
                            $rootScope.$broadcast(AUTH_EVENTS.tokenExpired);
                        }
                    });
            });
        };

        $scope.add = function () {
            $location.url('/role/add');
        };

        $scope.cancel = function () {
            $location.path('/role');
        };

        $scope.create = function () {
            $scope.loading = true;

            Role.create($scope.data)
                .success(function (response) {
                    console.log(response);

                    $scope.loading = false;

                    $rootScope.$broadcast(OTHER_EVENTS.messages, {
                        type: response._messages[0].type,
                        text: response._messages[0].text
                    });

                    $location.path('/role');
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

        $scope.update = function () {
            $scope.loading = true;

            Role.update($scope.data)
                .success(function (response) {
                    console.log(response);

                    $scope.loading = false;

                    $rootScope.$broadcast(OTHER_EVENTS.messages, {
                        type: response._messages[0].type,
                        text: response._messages[0].text
                    });

                    $location.path('/role');
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

        $scope.dtColumns = [
            DTColumnBuilder.newColumn('name').withTitle('Name').withOption('name', 'name'),
            DTColumnBuilder.newColumn('description').withTitle('Description').withOption('name', 'description'),
            DTColumnBuilder.newColumn(null).withTitle('Action').notSortable().renderWith(function (data) {
                return '<button class="btn btn-warning btn-sm" ng-click="edit(' + data.id + ')">' +
                    '<i class="fa fa-edit"></i>' +
                    '</button>' +
                    '&nbsp;' +
                    '<button class="btn btn-danger btn-sm" ng-click="delete(' + data.id + ')">' +
                    '<i class="fa fa-trash-o"></i>' +
                    '</button>';
            })
        ];

        $scope.dtOptions = DTOptionsBuilder.newOptions()
            .withOption('ajax', {
                method: 'POST',
                url: BASE_API_URL + 'role/getAll?token=' + Session.token,
                error: function (xhr, error, thrown) {
                    console.log(xhr);
                    console.log(error);
                    console.log(thrown);

                    if (xhr.status == 401) {
                        $rootScope.$broadcast(AUTH_EVENTS.tokenExpired);
                    }
                }
            })
            .withOption('processing', true)
            .withOption('serverSide', true)
            .withOption('initComplete', function (settings) {
                $compile(angular.element('#' + settings.sTableId).contents())($scope);
            })
            .withOption('createdRow', function (row, data, dataIndex) {
                console.log(row);
                console.log(data);
                console.log(dataIndex);

                $compile(angular.element(row).contents())($scope);
            })
            .withOption('aaSorting', [0, 'desc'])
            .withDataProp('dto')
            .withPaginationType('full_numbers');

        $scope.reloadData = function () {
            console.log($scope.dtInstance);
            $scope.dtInstance._renderer.rerender();
        };

        if (Urls.getActionUrl($location.absUrl(), 'add')) {
            // Nothing todo here
        };

        if (Urls.getActionUrl($location.absUrl(), 'edit')) {
            Role.getDetail($routeParams.id)
                .success(function (response) {
                    $scope.data = response.dto;
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

        if ($rootScope.messages) {
            Notification.getMessage($rootScope.messages);

            delete $rootScope.messages;
        };
    }
]);
