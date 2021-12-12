'use strict';

angular.module('app', [
    'Digital3'
]);

var app = angular.module('Digital3', ['ngRoute', 'ngProgress', 'ngSanitize', 'ngMap', 'ngNumberPicker', 'angular-ladda', 'datatables', 'datatables.fixedcolumns', 'slim', 'ui.bootstrap', 'ui.tinymce', 'ui.select', 'angular-thumbnails', 'checklist-model', 'daterangepicker', 'angular-input-stars']);

app.controller('MainController', ['$rootScope', '$scope', '$location', '$timeout', '$window', 'AUTH_EVENTS', 'LOADING_EVENTS', 'OTHER_EVENTS', 'Authentication', 'ngProgressFactory',
    function ($rootScope, $scope, $location, $timeout, $window, AUTH_EVENTS, LOADING_EVENTS, OTHER_EVENTS, Authentication, ngProgressFactory) {
        $scope.progressbar = ngProgressFactory.createInstance();
        $scope.isAuthorized = Authentication.isAuthorized();

        var notAuthenticated = function () {
            $location.path('/login');
        };

        var tokenExpired = function () {
            if (!$rootScope.isLogOff) {
                swal({
                    title: "Token expired",
                    text: "You will be direct to logoff system",
                    type: "warning",
                    closeOnConfirm: true
                }, function () {
                    $timeout(function () {
                        $location.path('/logoff');
                    }, 1000);
                });
            }
        };

        var notAuthorized = function () {
            $location.path('/403');
        };

        var notFound = function () {
            $location.path('/404');
        };

        var sessionExpired = function () {
            swal({
                title: "Session expired",
                text: "You will be direct to out the system",
                type: "warning",
                closeOnConfirm: true
            }, function () {
                $timeout(function () {
                    $location.path('/login');
                }, 1000);
            });
        };

        var internalServerError = function () {
            $location.path('/500');
        };

        var serviceNotAvailable = function () {
            $location.path('/503');
        };

        var logoutSuccess = function () {
            $rootScope.logoutSuccessMessage = "Logout success";
            $rootScope.loginSuccessMessage = false;
            $rootScope.loginFailedMessage = false;
            $rootScope.isLogOff = true;

            $location.path('/login');
        };

        var loginSuccess = function () {
            $scope.currentUser = $rootScope.currentUser;

            $rootScope.loginSuccessMessage = "Login success";
            $rootScope.loginFailedMessage = false;
            $rootScope.logoutSuccessMessage = false;
            $rootScope.isLogOff = false;

            $location.path('/dashboard');
        };

        var loginFailed = function () {
            $rootScope.loginFailedMessage = "Login invalid. Please check your username & password";
            $rootScope.loginSuccessMessage = false;
            $rootScope.logoutSuccessMessage = false;
        };

        var messages = function (event, opt) {
            $rootScope.messages = {
                type: opt.type,
                text: opt.text
            };
        };

        var userInfo = function (event, opt) {
            var userInfo = JSON.parse($window.sessionStorage['userInfo']);

            userInfo.dto.name = 'Who am i?';
            userInfo.dto.avatar = './assets/common/images/admin/avatar.jpg';

            if (opt.agent) {
                userInfo.dto.name = opt.agent.contact;
                userInfo.dto.avatar = (opt.agent.image_url) ? opt.agent.image_url : './assets/common/images/admin/avatar.jpg';
            }

            if (opt.member) {
                userInfo.dto.name = opt.member.name;
                userInfo.dto.avatar = (opt.member.image_url) ? opt.member.image_url : './assets/common/images/admin/avatar.jpg';
            }

            if (opt.staff) {
                userInfo.dto.name = opt.staff.name;
                userInfo.dto.avatar = (opt.staff.image_url) ? opt.staff.image_url : './assets/common/images/admin/avatar.jpg';
            }

            $rootScope.userInfo = userInfo.dto;

            $window.sessionStorage["userInfo"] = JSON.stringify(userInfo);
        };

        var loadingStart = function () {
            $scope.progressbar.set(100);
            $scope.progressbar.setHeight('3px');
            $scope.progressbar.setColor('#F5A751');
            $scope.progressbar.start();
        };

        var loadingFinish = function () {
            $scope.progressbar.complete();
        };

        $rootScope.$on(AUTH_EVENTS.notAuthenticated, notAuthenticated);
        $rootScope.$on(AUTH_EVENTS.tokenExpired, tokenExpired);
        $rootScope.$on(AUTH_EVENTS.notAuthorized, notAuthorized);
        $rootScope.$on(AUTH_EVENTS.notFound, notFound);
        $rootScope.$on(AUTH_EVENTS.sessionExpired, sessionExpired);
        $rootScope.$on(AUTH_EVENTS.internalServerError, internalServerError);
        $rootScope.$on(AUTH_EVENTS.serviceNotAvailable, serviceNotAvailable);

        $rootScope.$on(AUTH_EVENTS.logoutSuccess, logoutSuccess);
        $rootScope.$on(AUTH_EVENTS.loginSuccess, loginSuccess);
        $rootScope.$on(AUTH_EVENTS.loginFailed, loginFailed);

        $rootScope.$on(OTHER_EVENTS.messages, messages);
        $rootScope.$on(OTHER_EVENTS.userInfo, userInfo);

        $rootScope.$on(LOADING_EVENTS.loadingStart, loadingStart);
        $rootScope.$on(LOADING_EVENTS.loadingFinish, loadingFinish);

        $scope.$on('$routeChangeSuccess', function () {
            $('body').removeClass('single-page single-page-inverse');

            $rootScope.hideLeftMenu = false;
            $rootScope.hideTopMenu = false;

            $('html, body').scrollTop(0);
            $('.left-menu-list-active').removeClass('left-menu-list-active');
            $('nav.left-menu .left-menu-list-root .left-menu-link').each(function () {
                if ($(this).attr('href') == '#' + $location.path()) {
                    $(this).closest('.left-menu-list-root > li').addClass('left-menu-list-active');
                }
            });
        })
    }
]);