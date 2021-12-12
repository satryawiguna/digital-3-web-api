app.run(function ($rootScope, $location, $window, $timeout, Authentication, AUTH_EVENTS, Session, Urls) {
    $rootScope.authentication = Authentication;
    $rootScope.userInfo = Session;
    $rootScope.isLogOff = true;

    $rootScope.$on('$routeChangeStart', function (event, next, previous) {
        var authorizedRoles = (!angular.isUndefined(next.data)) ? next.data.authorizedRoles : null;

        if (!Authentication.isAuthorized(authorizedRoles)) {
            if (Authentication.isAuthenticated()) {
                $rootScope.$broadcast(AUTH_EVENTS.notAuthorized);
            } else {
                $rootScope.$broadcast(AUTH_EVENTS.notAuthenticated);
            }
        }

        Urls.getAllUrl(next, previous);
    });

    $rootScope.logout = function () {
        swal({
            title: "Are you sure?",
            text: "You will not be able to access the system",
            type: "info",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Yes, logout!",
            closeOnConfirm: true
        }, function () {
            $timeout(function () {
                Authentication.logout();
                $rootScope.$broadcast(AUTH_EVENTS.logoutSuccess);
            }, 1000);
        });
    };

    if ($window.sessionStorage['userInfo']) {
        Session.create(JSON.parse($window.sessionStorage['userInfo']));
        $location.path('/dashboard');
    }

});