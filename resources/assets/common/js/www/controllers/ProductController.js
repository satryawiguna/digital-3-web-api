app.controller('ProductController', ['$scope', '$rootScope', '$location', '$http', '$compile', '$routeParams', '$filter', '$sce', '$uibModal', 'DTOptionsBuilder', 'DTColumnBuilder', 'Urls', 'Product', 'ProductType', 'ProductGenre', 'ProductTag', 'FileManager', 'Session', 'Notification', 'BASE_API_URL', 'BASE_URL', 'AUTH_EVENTS', 'LOADING_EVENTS', 'OTHER_EVENTS',
    function ($scope, $rootScope, $location, $http, $compile, $routeParams, $filter, $sce, $uibModal, DTOptionsBuilder, DTColumnBuilder, Urls, Product, ProductType, ProductGenre, ProductTag, FileManager, Session, Notification, BASE_API_URL, BASE_URL, AUTH_EVENTS, LOADING_EVENTS, OTHER_EVENTS) {
        $scope.dtInstance = {};
        $scope.data = {
            product_type_id: 1,
            product_genre: [],
            tag: [],
            user_id: Session.userId,
            publish: new Date(),
            status: 0
        };
        $scope.tinymceOptions = {
            height: 400,
            plugins: 'advlist autolink link image lists charmap preview table textcolor code responsivefilemanager pagebreak',
            toolbar: 'insertfile undo redo | styleselect table code | sizeselect | bold italic |  fontsizeselect | forecolor backcolor | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image responsivefilemanager',
            skin: 'lightgray',
            theme: 'modern',
            pagebreak_separator: "<!--more-->",
            fontsize_formats: "8pt 10pt 12pt 14pt 18pt 24pt 36pt",
            image_advtab: true,
            relative_urls: false,
            external_filemanager_path: BASE_URL + '/filemanager/',
            filemanager_title: "File Manager",
            external_plugins: {
                "filemanager": BASE_URL + '/filemanager/plugin.min.js'
            }
        };

        $scope.session = Session;

        $scope.productGenreId = 0;
        $scope.productTagId = 0;

        $scope.folderPath = 'product';

        FileManager.getAccessKey($scope.session.email)
            .success(function (response) {
                $scope.fileManager = response.dto;
                $scope.tinymceOptions.filemanager_access_key = $scope.fileManager.akey;
                $scope.tinyMceFull = true;
            })
            .error(function (xhr, error, thrown) {
                console.log(xhr);
                console.log(error);
                console.log(thrown);

                if (xhr.status == 401) {
                    $rootScope.$broadcast(AUTH_EVENTS.tokenExpired);
                }
            });

        FileManager.setFolder($scope.folderPath)
            .success(function (response) {
                console.log(response);
            })
            .error(function (xhr, error, thrown) {
                console.log(xhr);
                console.log(error);
                console.log(thrown);

                if (xhr.status == 401) {
                    $rootScope.$broadcast(AUTH_EVENTS.tokenExpired);
                }
            });

        ProductGenre.getProductGenreHierarchy()
            .success(function (response) {
                $scope.productGenres = response.data.dto;

            })
            .error(function (xhr, error, thrown) {
                console.log(xhr);
                console.log(error);
                console.log(thrown);

                if (xhr.status == 401) {
                    $rootScope.$broadcast(AUTH_EVENTS.tokenExpired);
                }
            });

        ProductType.getProductTypeList()
            .success(function (response) {
                $scope.productTypes = response.data.dto;

            })
            .error(function (xhr, error, thrown) {
                console.log(xhr);
                console.log(error);
                console.log(thrown);

                if (xhr.status == 401) {
                    $rootScope.$broadcast(AUTH_EVENTS.tokenExpired);
                }
            });

        $scope.edit = function (id) {
            $location.path('/product/edit/' + id);
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
                Product.delete(id).success(function (response) {
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
            $location.url('/product/add');
        };

        $scope.cancel = function () {
            $location.path('/product');
        };

        $scope.create = function () {
            $scope.loading = true;

            Product.create($scope.data)
                .success(function (response) {
                    console.log(response);

                    $scope.loading = false;

                    $rootScope.$broadcast(OTHER_EVENTS.messages, {
                        type: response._messages[0].type,
                        text: response._messages[0].text
                    });

                    $location.path('/product');
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
            $rootScope.$broadcast(LOADING_EVENTS.loadingStart);
            $scope.loading = true;

            var productTag = [];

            angular.forEach($scope.data.product_tag, function (value) {
                if (value.id) {
                    productTag.push(value.id);
                } else {
                    productTag.push(value);
                }
            });

            $scope.data.product_tag = productTag;

            Product.update($scope.data)
                .success(function (response) {
                    console.log(response);

                    $scope.loading = false;

                    $rootScope.$broadcast(OTHER_EVENTS.messages, {
                        type: response._messages[0].type,
                        text: response._messages[0].text
                    });

                    $location.path('/product');
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

        $scope.openProductTag = function () {
            var productTagInstance = $uibModal.open({
                templateUrl: 'productTag.html',
                controller: 'ModalProductTagController',
                size: 'lg',
                backdrop: 'static',
                keyboard: false
            });

            productTagInstance.result.then(function (selectedItem) {
            }, function () {
                console.log('Modal dismissed at: ' + new Date());
            });
        };

        $scope.setFeaturedImage = function () {
            $('#set-featured_image').fancyboxPlus({
                'width': 1024,
                'height': 768,
                'type': 'iframe',
                'autoScale': false
            });

            $('#image-featured_image').hide();
            $('#remove-featured_image').hide();
            $('#set-featured_image').show();

        };

        $scope.removeFeaturedImage = function () {
            $('#image-featured_image').removeAttr('src');
            $('#validation-featured_image').val('');

            $('#image-featured_image').hide();
            $('#remove-featured_image').hide();
            $('#set-featured_image').show();

            delete $scope.data.featured_image;
        };

        $scope.dtColumns = [
            DTColumnBuilder.newColumn('id').withTitle('ID').withOption('name', 'id'),
            DTColumnBuilder.newColumn('title').withTitle('Title').withOption('name', 'title'),
            DTColumnBuilder.newColumn(null).withTitle('Product Genre').notSortable().renderWith(function (data) {
                var product_genres = '';

                angular.forEach(data.product_genre, function (value, key) {
                    product_genres += '<span class="label label-default">' + value.name + '</span>&nbsp;';
                });

                return product_genres;
            }),
            DTColumnBuilder.newColumn(null).withTitle('Product Tag').notSortable().renderWith(function (data) {
                var product_tags = '';

                angular.forEach(data.product_tag, function (value, key) {
                    product_tags += '<span class="label label-default">' + value.name + '</span>&nbsp;';
                });

                return product_tags;
            }),
            DTColumnBuilder.newColumn('publish').withTitle('Publish').withOption('name', 'publish'),
            DTColumnBuilder.newColumn(null).withTitle('Status').notSortable().renderWith(function (data) {
                var status = '';

                switch (data.status) {
                    case 0:
                        status = '<strong>Draft</strong>';
                        break;

                    case 1:
                        status = '<strong>Published</strong>';
                        break;

                    case 2:
                        status = '<strong>Pending</strong>';
                        break;
                }

                return status;

            }),
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

        $scope.dtColumns[0].visible = false;

        $scope.dtOptions = DTOptionsBuilder.newOptions()
            .withOption('ajax', {
                method: 'POST',
                url: BASE_API_URL + 'product/getAll?token=' + Session.token,
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
                aoData.product_genre_id = ($scope.productGenreId != 0) ? $scope.productGenreId : null;
                aoData.product_tag_id = ($scope.productTagId != 0) ? $scope.productTagId : null;
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
            .withOption('aaSorting', [1, 'desc'])
            .withDataProp('dto')
            .withPaginationType('full_numbers');

        $scope.reloadData = function () {
            $scope.dtInstance._renderer.rerender();
        };

        $scope.refreshProductTag = function (name) {
            ProductTag.getProductTagByName(name)
                .success(function (response) {
                    $scope.productTags = response.dto;

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
            $scope.getSlug = function (title) {
                $scope.loadingSlug = true;

                Product.getProductSlugByTitle(title)
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
            Product.getDetail($routeParams.id)
                .success(function (response) {
                    $scope.data = response.dto;

                    $scope.data.status = parseInt(response.dto.status);
                    $scope.data.publish = moment(response.dto.publish).format('YYYY-MM-DD HH:mm A');

                    var productGenre = [];
                    var productTag = [];

                    angular.forEach($scope.data.product_genre, function (value) {
                        productGenre.push(value.id);
                    });

                    angular.forEach($scope.data.product_tag, function (value) {
                        productTag.push({
                            id: value.id,
                            name: value.name
                        });
                    });

                    $scope.data.product_genre = productGenre;
                    $scope.data.product_tag = productTag;

                    $scope.title = response.dto.title;
                    $scope.slug = response.dto.slug;

                })
                .error(function (xhr, error, thrown) {
                    console.log(xhr);
                    console.log(error);
                    console.log(thrown);

                    if (xhr.status == 401) {
                        $rootScope.$broadcast(AUTH_EVENTS.tokenExpired);
                    }
                });

            $scope.getSlug = function (title) {
                $scope.loadingSlug = true;

                if ($filter('spaceLess')($scope.data.title) != $filter('spaceLess')($scope.title)) {
                    Product.getProductSlugByTitle(title)
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

app.controller('ModalProductTagController', ['$scope', '$uibModalInstance', '$filter', '$timeout', 'ProductTag', 'AUTH_EVENTS',
    function ($scope, $uibModalInstance, $filter, $timeout, ProductTag, AUTH_EVENTS) {
        $scope.data = {};

        $scope.create = function () {
            $scope.loading = true;

            ProductTag.create($scope.data)
                .success(function (response) {
                    console.log(response);

                    $scope.loading = false;

                    if (response._messages) {
                        if (response._messages[0].type == 'error') {
                            swal("Error", response._messages[0].text, "error");
                        }

                        if (response._messages[0].type == 'success') {
                            swal({
                                title: 'Success',
                                text: response._messages[0].text,
                                type: 'success',
                                showCancelButton: true,
                                confirmButtonText: 'Add again',
                                cancelButtonText: 'No, cancel'
                            }, function (isConfirm) {
                                if (isConfirm) {
                                    $('#validation-tag-agent_id').val(null).trigger("change");
                                    $('#validation-tag-name').val('');
                                    $('#label-slug').text('');

                                    $scope.data.agent_id = null;
                                    $scope.data.name = null;
                                    $scope.data.slug = null;
                                } else {
                                    $scope.closeProductTag();
                                }
                            });
                        }
                    }
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

        $scope.getSlug = function (name) {
            $scope.loadingSlug = true;

            ProductTag.getProductTagSlugByName(name)
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

        $scope.closeProductTag = function () {
            $uibModalInstance.close();
        };
    }
]);
