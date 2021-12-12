app.factory('Product', ['$http', '$filter', 'BASE_API_URL', 'BASE_URL', 'Session', 'Promise',
    function ($http, $filter, BASE_API_URL, BASE_URL, Session, Promise) {
        var promiseService = {};

        promiseService.getDetail = function (id) {
            var def = Promise.defer();
            var data = {};
            var config = {};

            $http.get(BASE_API_URL + 'product/getDetail/' + id + '?token=' + Session.token, data, config)
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
                user_id: data.user_id,
                product_type_id: data.product_type_id,
                publish: $filter('date')(data.publish, 'yyyy-MM-dd HH:mm:ss'),
                title: data.title,
                slug: data.slug,
                description: data.description,
                featured_image_url: (!angular.isUndefined(data.featured_image_url) && data.featured_image_url) ? data.featured_image_url.replace(BASE_URL, '') : null,
                year: data.year,
                rating: data.rating,
                director: data.director,
                duration: data.duration,
                media_type: data.media_type,
                actors: data.actors,
                status: data.status,
                product_genre: data.product_genre,
                product_tag: data.product_tag
            };
            var config = {};

            $http.post(BASE_API_URL + 'product/create?token=' + Session.token, data, config)
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
                user_id: data.user_id,
                product_type_id: data.product_type_id,
                title: data.title,
                slug: data.slug,
                description: data.description,
                featured_image_url: (!angular.isUndefined(data.featured_image_url) && data.featured_image_url) ? data.featured_image_url.replace(BASE_URL, '') : null,
                year: data.year,
                rating: data.rating,
                director: data.director,
                duration: data.duration,
                media_type: data.media_type,
                actors: data.actors,
                status: data.status,
                product_genre: data.product_genre,
                product_tag: data.product_tag
            };
            var config = {};

            $http.post(BASE_API_URL + 'product/update?token=' + Session.token, data, config)
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

            $http.get(BASE_API_URL + 'product/delete/' + id + '?token=' + Session.token, data, config)
                .success(function (response) {
                    def.resolve(response);
                }, function (error) {
                    def.reject(error);
                });

            return def.promise;
        }

        promiseService.getProductSlugByTitle = function (title) {
            var def = Promise.defer();
            var data = {
                params: {
                    title: title
                }
            };
            var config = {};

            $http.get(BASE_API_URL + 'product/getProductSlugByTitle?token=' + Session.token, data, config)
                .success(function (response) {
                    def.resolve(response);
                }, function (error) {
                    def.reject(error);
                });

            return def.promise;
        }

        return promiseService;
    }]);