app.factory('ProductTag', ['$http', 'BASE_API_URL', 'Session', 'Promise',
    function ($http, BASE_API_URL, Session, Promise) {
        var promiseService = {};

        promiseService.getDetail = function (id) {
            var def = Promise.defer();
            var data = {};
            var config = {};

            $http.get(BASE_API_URL + 'productTag/getDetail/' + id + '?token=' + Session.token, data, config)
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
                agent_id: data.agent_id,
                name: data.name,
                slug: data.slug
            };
            var config = {};

            $http.post(BASE_API_URL + 'productTag/create?token=' + Session.token, data, config)
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
                agent_id: data.agent_id,
                name: data.name,
                slug: data.slug
            };
            var config = {};

            $http.post(BASE_API_URL + 'productTag/update?token=' + Session.token, data, config)
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

            $http.get(BASE_API_URL + 'productTag/delete/' + id + '?token=' + Session.token, data, config)
                .success(function (response) {
                    def.resolve(response);
                }, function (error) {
                    def.reject(error);
                });

            return def.promise;
        }

        promiseService.getProductTagByName = function (agentId, name) {
            var def = Promise.defer();
            var data = {
                params: {
                    agent_id: agentId,
                    name: name
                }
            };
            var config = {};

            $http.get(BASE_API_URL + 'productTag/getProductTagByName?token=' + Session.token, data, config)
                .success(function (response) {
                    def.resolve(response);
                }, function (error) {
                    def.reject(error);
                });

            return def.promise;
        }

        promiseService.getProductTagSlugByName = function (name) {
            var def = Promise.defer();
            var data = {
                params: {
                    name: name
                }
            };
            var config = {};

            $http.get(BASE_API_URL + 'productTag/getProductTagSlugByName?token=' + Session.token, data, config)
                .success(function (response) {
                    def.resolve(response);
                }, function (error) {
                    def.reject(error);
                });

            return def.promise;
        }

        return promiseService;
    }]);