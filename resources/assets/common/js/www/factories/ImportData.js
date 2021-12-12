app.factory('ImportData', ['$http', '$timeout', 'BASE_API_URL', 'Session', 'Promise',
    function ($http, $timeout, BASE_API_URL, Session, Promise) {
        var promiseService = {};

        promiseService.importData = function (data) {
            var def = Promise.defer();
            var config = {
                timeout: def.promise,
                transformRequest: angular.identity,
                headers: {
                    'Content-Type': undefined,
                    'Process-Data': false
                }
            };

            $http.post(BASE_API_URL + 'importData/product?token=' + Session.token, data, config)
                .success(function (response) {
                    def.resolve(response);
                }, function (error) {
                    if(error.status === 0) {
                        console.log('request timeout');
                    } else {
                        def.reject(error);
                    }
                });

            $timeout(function() {
                def.resolve();
            }, 60000);

            return def.promise;
        }

        return promiseService;
    }]);