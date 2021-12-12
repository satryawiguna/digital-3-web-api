app.factory('Role', ['$http', 'BASE_API_URL', 'Session', 'Promise',
    function ($http, BASE_API_URL, Session, Promise) {
        var promiseService = {};

        promiseService.getDetail = function (id) {
            var def = Promise.defer();
            var data = {};
            var config = {};

            $http.get(BASE_API_URL + 'role/getDetail/' + id + '?token=' + Session.token, data, config)
                .success(function (response) {
                    def.resolve(response);
                }, function (error) {
                    def.reject(error);
                });

            return def.promise;
        }

        promiseService.create = function (data) {
            var def = Promise.defer();
            var data = {
                role: data.role,
                description: data.description
            };
            var config = {};

            $http.post(BASE_API_URL + 'role/create?token=' + Session.token, data, config)
                .success(function (response) {
                    def.resolve(response);
                }, function (error) {
                    def.reject(error);
                });

            return def.promise;
        }

        promiseService.update = function (data) {
            var def = Promise.defer();
            var data = {
                id: data.id,
                role: data.role,
                description: data.description
            };
            var config = {};

            $http.post(BASE_API_URL + 'role/update?token=' + Session.token, data, config)
                .success(function (response) {
                    def.resolve(response);
                }, function (error) {
                    def.reject(error);
                });

            return def.promise;
        }

        promiseService.delete = function (id) {
            var def = Promise.defer();
            var data = {};
            var config = {};

            $http.get(BASE_API_URL + 'role/delete/' + id + '?token=' + Session.token, data, config)
                .success(function (response) {
                    def.resolve(response);
                }, function (error) {
                    def.reject(error);
                });

            return def.promise;
        }

        promiseService.getRoleList = function () {
            var def = Promise.defer();
            var data = {};
            var config = {};

            $http.get(BASE_API_URL + 'role/getRoleList?token=' + Session.token, data, config)
                .then(function (response) {
                    def.resolve(response);
                }, function (error) {
                    def.reject(error);
                });

            return def.promise;
        }

        return promiseService;
    }]);