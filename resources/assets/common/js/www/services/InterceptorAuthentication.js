'use strict';

/**
 * This interceptor will make sure that, after each $http request
 * if the user doesn't have access to something runs the according
 * event, given the response status codes from the server.
 */
app.factory('InterceptorAuthentication', ['$rootScope', '$q', 'AUTH_EVENTS',
    function ($rootScope, $q, AUTH_EVENTS) {
        return {
            'responseError': function(response) {
                $rootScope.$broadcast({
                    401: AUTH_EVENTS.tokenExpired,
                    403: AUTH_EVENTS.notAuthorized,
                    404: AUTH_EVENTS.notFound,
                    440: AUTH_EVENTS.sessionExpired,
                    500: AUTH_EVENTS.internalServerError,
                    503: AUTH_EVENTS.serviceNotAvailable
                }[response.status], response);

                return $q.reject(response);
            }
        };
    }]);