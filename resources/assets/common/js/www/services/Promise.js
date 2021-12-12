'use strict';

app.factory('Promise', ['$q',
    function ($q) {
        var promiseService = {};

        promiseService.decorate = function (promise) {
            promise.success = function (callback) {
                promise.then(callback);

                return promise;
            };

            promise.error = function (callback) {
                promise.then(null, callback);

                return promise;
            };
        }

        promiseService.defer = function () {
            var deferred = $q.defer();

            this.decorate(deferred.promise);

            return deferred;
        }

        return promiseService;

    }]);