app.controller('ProductGenreController', ['$scope', '$rootScope', '$location', '$http', '$compile', '$routeParams', 'DTOptionsBuilder', 'DTColumnBuilder', 'Urls', 'ProductGenre', 'Session', 'Notification', 'BASE_API_URL', 'AUTH_EVENTS', 'LOADING_EVENTS', 'OTHER_EVENTS',
    function ($scope, $rootScope, $location, $http, $compile, $routeParams, DTOptionsBuilder, DTColumnBuilder, Urls, ProductGenre, Session, Notification, BASE_API_URL, AUTH_EVENTS, LOADING_EVENTS, OTHER_EVENTS) {
        var parentOption = {
            placeholder: "- Choose Parent -",
            minimumInputLength: 2,
            minimumResultsForSearch: -1,
            cache: true,
            ajax: {
                url: BASE_API_URL + 'productGenre/getProductGenreByName?token=' + Session.token,
                dataType: 'json',
                delay: 250,
                data: function (params) {
                    return {
                        id: ($scope.data.id) ? $scope.data.id : null,
                        name: params.term
                    };
                },
                processResults: function (data) {
                    return {
                        results: $.map(data.dto, function (item) {
                            return {
                                id: item.id,
                                text: item.name
                            }
                        })
                    }
                }
            }
        }

        $scope.dtInstance = {};
        $scope.data = {}

        $scope._parentId = [];
        $scope.parentId = 0;

        $scope.$watch("data.parent_id", function (newValue) {
            if (!angular.isUndefined(newValue) && newValue) {
                ProductGenre.getDetail(newValue)
                    .success(function (response) {
                        parentOption.allowClear = true;
                        parentOption.initSelection = function (element, callback) {
                            var data = {
                                id: response.dto.id,
                                text: response.dto.name
                            };

                            callback(data);
                        };

                        $('#validation-parent').select2(parentOption);
                    })
                    .error(function (xhr, error, thrown) {
                        console.log(xhr);
                        console.log(error);
                        console.log(thrown);

                        if (xhr.status == 401) {
                            $rootScope.$broadcast(AUTH_EVENTS.tokenExpired);
                        }
                    });
            }
        });

        $scope.edit = function (id) {
            $location.path('/productGenre/edit/' + id);
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
                ProductGenre.delete(id).success(function (response) {
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
            $location.url('/productGenre/add');
        };

        $scope.cancel = function () {
            $location.path('/productGenre');
        };

        $scope.up = function () {
            $scope.parentId = $scope._parentId[$scope._parentId.length - 2];
            $scope._parentId.splice(-1, 1);

            $scope.dtInstance._renderer.rerender();
        };

        $scope.create = function () {
            $scope.loading = true;

            ProductGenre.create($scope.data)
                .success(function (response) {
                    console.log(response);

                    $scope.loading = false;

                    $rootScope.$broadcast(OTHER_EVENTS.messages, {
                        type: response._messages[0].type,
                        text: response._messages[0].text
                    });

                    $location.path('/productGenre');
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

            ProductGenre.update($scope.data)
                .success(function (response) {
                    console.log(response);

                    $scope.loading = false;

                    $rootScope.$broadcast(OTHER_EVENTS.messages, {
                        type: response._messages[0].type,
                        text: response._messages[0].text
                    });

                    $location.path('/productGenre');
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

        $scope.productGenre = function (id) {
            if ($scope._parentId.indexOf($scope.parentId) == -1) {
                $scope._parentId.push($scope.parentId);
            }

            $scope.parentId = id;
            $scope.dtInstance._renderer.rerender();
        };

        $scope.dtColumns = [
            DTColumnBuilder.newColumn('name').withTitle('Name').withOption('name', 'name'),
            DTColumnBuilder.newColumn('description').withTitle('Description').withOption('name', 'description'),
            DTColumnBuilder.newColumn(null).withTitle('Action').notSortable().renderWith(function (data) {
                var action;

                if (data.child > 0) {
                    action = '<button id="edit_' + data.id + '" class="btn btn-warning btn-sm" ng-click="edit(' + data.id + ')">' +
                        '<i class="fa fa-edit"></i>' +
                        '</button>' +
                        '&nbsp;' +
                        '<button id="delete_' + data.id + '" class="btn btn-danger btn-sm" ng-click="delete(' + data.id + ')">' +
                        '<i class="fa fa-trash-o"></i>' +
                        '</button>' +
                        '&nbsp;' +
                        '<button id="blogCategory_' + data.id + '" class="btn btn-primary btn-sm" ng-click="productGenre(' + data.id + ')">' +
                        '<i class="fa fa-external-link"></i>' +
                        '</button>';
                } else {
                    action = '<button id="edit_' + data.id + '" class="btn btn-warning btn-sm" ng-click="edit(' + data.id + ')">' +
                        '<i class="fa fa-edit"></i>' +
                        '</button>' +
                        '&nbsp;' +
                        '<button id="delete_' + data.id + '" class="btn btn-danger btn-sm" ng-click="delete(' + data.id + ')">' +
                        '<i class="fa fa-trash-o"></i>' +
                        '</button>';
                }

                return action;
            })
        ];

        $scope.dtOptions = DTOptionsBuilder.newOptions()
            .withOption('ajax', {
                method: 'POST',
                url: BASE_API_URL + 'productGenre/getAll?token=' + Session.token,
                error: function (xhr, error, thrown) {
                    console.log(xhr);
                    console.log(error);
                    console.log(thrown);

                    if (xhr.status == 401) {
                        $rootScope.$broadcast(AUTH_EVENTS.tokenExpired);
                    }
                }
            })
            .withOption('fnServerParams', function (aoData) {
                aoData.parent_id = ($scope.parentId != 0) ? $scope.parentId : null;
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
            $scope.dtInstance._renderer.rerender();
        };

        $scope.initializeProductGenre = function () {
            $('#validation-parent').select2(parentOption);
        };

        if (Urls.getActionUrl($location.absUrl(), 'add')) {
            $scope.getSlug = function (name) {
                $scope.loadingSlug = true;

                ProductGenre.getProductGenreSlugByName(name)
                    .success(function (response) {
                        console.log(response);

                        $scope.loadingSlug = false;

                        $scope.data.slug = response.dto.slug;
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
        }

        if (Urls.getActionUrl($location.absUrl(), 'edit')) {
            ProductGenre.getDetail($routeParams.id)
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

            $scope.getSlug = function (name) {
                $scope.loadingSlug = true;

                if ($filter('spaceLess')($scope.data.name) != $filter('spaceLess')($scope.name)) {
                    ProductGenre.getProductGenreSlugByName(name)
                        .success(function (response) {
                            console.log(response);

                            $scope.loadingSlug = false;

                            $scope.data.slug = response.dto.slug;
                        })
                        .error(function (xhr, error, thrown) {
                            console.log(xhr);
                            console.log(error);
                            console.log(thrown);

                            if (xhr.status == 401) {
                                $rootScope.$broadcast(AUTH_EVENTS.tokenExpired);
                            }
                        });

                } else {
                    $scope.data.slug = $scope.slug;

                    $scope.loadingSlug = false;
                }
            };
        }

        if ($rootScope.messages) {
            Notification.getMessage($rootScope.messages);

            delete $rootScope.messages;
        }
    }
]);
