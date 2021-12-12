app.directive('leftMenu', function () {
    return {
        restrict: 'A',
        link: function (scope, element) {
            element.on('click', '.left-menu-link', function () {
                if (!$(this).closest('.left-menu-list-submenu').length) {
                    $('.left-menu-list-opened > a + ul').slideUp(200, function () {
                        $('.left-menu-list-opened').removeClass('left-menu-list-opened');
                    });
                }
            });
        }
    };
});

app.directive("validate", function () {
    return {
        restrict: "A",
        scope: {
            validate: '&'
        },
        link: function (scope, element) {
            $(element).validate({
                submit: {
                    settings: {
                        inputContainer: '.form-group',
                        errorListClass: 'form-control-error',
                        errorClass: 'has-danger'
                    },
                    callback: {
                        onSubmit: function (error) {
                            scope.validate();
                        }
                    }
                }
            });
        }
    }
});

app.directive('fileModel', ['$parse', function ($parse) {
    return {
        restrict: 'A',
        link: function (scope, element, attribute) {
            var model = $parse(attribute.fileModel);
            var modelSetter = model.assign;

            element.bind('change', function () {
                scope.$apply(function () {
                    modelSetter(scope, element[0].files[0]);
                });
            });
        }
    };
}]);

app.directive('loading', ['$http', '$rootScope', 'LOADING_EVENTS', function ($http, $rootScope, LOADING_EVENTS) {
    return {
        restrict: 'A',
        link: function (scope, element, attribute) {
            scope.isLoading = function () {
                return $http.pendingRequests.length > 0;
            };

            scope.$watch(scope.isLoading, function (x) {
                if (!x) {
                    $rootScope.$broadcast(LOADING_EVENTS.loadingFinish);
                } else {
                    $rootScope.$broadcast(LOADING_EVENTS.loadingStart);
                }
            });
        }
    };
}]);

app.directive('fileModel', ['$parse', function ($parse) {
    return {
        restrict: 'A',
        link: function(scope, element, attrs) {
            var model = $parse(attrs.fileModel);
            var modelSetter = model.assign;

            element.bind('change', function(){
                scope.$apply(function(){
                    modelSetter(scope, element[0].files[0]);
                });
            });
        }
    };
}]);