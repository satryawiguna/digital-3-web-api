'use strict';

app.factory('Authentication', ['$rootScope', '$http', '$location', '$window', 'Session', 'Promise', 'AUTH_EVENTS', 'BASE_API_URL',
    function ($rootScope, $http, $location, $window, Session, Promise, AUTH_EVENTS, BASE_API_URL) {
        var authenticationService = {};

        authenticationService.signIn = function (login) {
            var def = Promise.defer();
            var data = {
                email: login.email,
                password: login.password
            };
            var config = {};

            $http.post(BASE_API_URL + 'auth/login', data, config)
                .then(function (response) {
                    $window.sessionStorage["userInfo"] = JSON.stringify(response.data);

                    Session.create(response.data);

                    $rootScope.currentUser = response.data;
                    $rootScope.$broadcast(AUTH_EVENTS.loginSuccess);

                    def.resolve(response);
                }, function (error) {
                    $rootScope.$broadcast(AUTH_EVENTS.loginFailed);

                    def.reject(error);
                });

            return def.promise;
        }

        //check if the user is authenticated
        authenticationService.isAuthenticated = function () {
            return !!Session.token;
        }

        //check if the user is authorized to access the next route
        //this function can be also used on element level
        //e.g. <p ng-if="isAuthorized(authorizedRoles)">show this only to admins</p>
        authenticationService.isAuthorized = function (authorizedRoles) {
            if (!angular.isArray(authorizedRoles)) {
                authorizedRoles = [authorizedRoles];
            }

            //console.log(authorizedRoles.indexOf(Session.role) != -1 || authorizedRoles.indexOf('*') != -1);

            return (authenticationService.isAuthenticated() &&
            (authorizedRoles.indexOf(Session.role) != -1 || authorizedRoles.indexOf('*') != -1));
        }

        //log out the user and broadcast the logoutSuccess event
        authenticationService.logout = function () {
            Session.destroy();
            $window.sessionStorage.removeItem("userInfo");
        }

        return authenticationService;
    }]);