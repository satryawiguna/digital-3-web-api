app.factory('BlogCategory', ['$http', 'BASE_API_URL', 'Session', 'Promise',
    function ($http, BASE_API_URL, Session, Promise) {
        var promiseService = {};

        promiseService.getDetail = function (id) {
            var def = Promise.defer();
            var data = {};
            var config = {};

            $http.get(BASE_API_URL + 'blogCategory/getDetail/' + id + '?token=' + Session.token, data, config)
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
                parent_id: (!angular.isUndefined(data.parent_id)) ? data.parent_id : null,
                name: data.name,
                slug: data.slug,
                description: data.description
            };
            var config = {};

            $http.post(BASE_API_URL + 'blogCategory/create?token=' + Session.token, data, config)
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
                parent_id: (!angular.isUndefined(data.parent_id)) ? data.parent_id : null,
                name: data.name,
                slug: data.slug,
                description: data.description
            };
            var config = {};

            $http.post(BASE_API_URL + 'blogCategory/update?token=' + Session.token, data, config)
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

            $http.get(BASE_API_URL + 'blogCategory/delete/' + id + '?token=' + Session.token, data, config)
                .success(function (response) {
                    def.resolve(response);
                }, function (error) {
                    def.reject(error);
                });

            return def.promise;
        }

        promiseService.getBlogCategoryList = function () {
            var def = Promise.defer();
            var data = {};
            var config = {};

            $http.get(BASE_API_URL + 'blogCategory/getBlogCategoryList?token=' + Session.token, data, config)
                .then(function (response) {
                    def.resolve(response);
                }, function (error) {
                    def.reject(error);
                });

            return def.promise;
        }

        promiseService.getBlogCategoryHierarchy = function () {
            var def = Promise.defer();
            var data = {};
            var config = {};

            $http.get(BASE_API_URL + 'blogCategory/getBlogCategoryHierarchy?token=' + Session.token, data, config)
                .then(function (response) {
                    def.resolve(response);
                }, function (error) {
                    def.reject(error);
                });

            return def.promise;
        }

        promiseService.getBlogCategorySlugByName = function (name) {
            var def = Promise.defer();
            var data = {
                params: {
                    name: name
                }
            };
            var config = {};

            $http.get(BASE_API_URL + 'blogCategory/getBlogCategorySlugByName?token=' + Session.token, data, config)
                .success(function (response) {
                    def.resolve(response);
                }, function (error) {
                    def.reject(error);
                });

            return def.promise;
        }

        return promiseService;
    }]);