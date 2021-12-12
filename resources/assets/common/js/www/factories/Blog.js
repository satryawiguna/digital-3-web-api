app.factory('Blog', ['$http', '$filter', 'BASE_API_URL', 'BASE_URL', 'Session', 'Promise',
    function ($http, $filter, BASE_API_URL, BASE_URL, Session, Promise) {
        var promiseService = {};

        promiseService.getDetail = function (id) {
            var def = Promise.defer();
            var data = {};
            var config = {};

            $http.get(BASE_API_URL + 'blog/getDetail/' + id + '?token=' + Session.token, data, config)
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
                blog_category: data.blog_category,
                blog_tag: data.blog_tag,
                user_id: data.user_id,
                publish: $filter('date')(data.publish, 'yyyy-MM-dd HH:mm:ss'),
                title: data.title,
                slug: data.slug,
                contents: data.contents,
                featured_image_url: (!angular.isUndefined(data.featured_image_url) && data.featured_image_url) ? data.featured_image_url.replace(BASE_URL, '') : null,
                status: data.status
            };
            var config = {};

            $http.post(BASE_API_URL + 'blog/create?token=' + Session.token, data, config)
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
                blog_category: data.blog_category,
                blog_tag: data.blog_tag,
                user_id: data.user_id,
                title: data.title,
                slug: data.slug,
                contents: data.contents,
                featured_image_url: (!angular.isUndefined(data.featured_image_url) && data.featured_image_url) ? data.featured_image_url.replace(BASE_URL, '') : null,
                status: data.status
            };
            var config = {};

            $http.post(BASE_API_URL + 'blog/update?token=' + Session.token, data, config)
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

            $http.get(BASE_API_URL + 'blog/delete/' + id + '?token=' + Session.token, data, config)
                .success(function (response) {
                    def.resolve(response);
                }, function (error) {
                    def.reject(error);
                });

            return def.promise;
        }

        promiseService.getBlogSlugByTitle = function (title) {
            var def = Promise.defer();
            var data = {
                params: {
                    title: title
                }
            };
            var config = {};

            $http.get(BASE_API_URL + 'blog/getBlogSlugByTitle?token=' + Session.token, data, config)
                .success(function (response) {
                    def.resolve(response);
                }, function (error) {
                    def.reject(error);
                });

            return def.promise;
        }

        return promiseService;
    }]);