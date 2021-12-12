app.factory('User', ['$http', 'BASE_API_URL', 'Session', 'Promise',
    function ($http, BASE_API_URL, Session, Promise) {
        var promiseService = {};

        promiseService.getDetail = function (id) {
            var def = Promise.defer();
            var data = {};
            var config = {};

            $http.get(BASE_API_URL + 'user/getDetail/' + id + '?token=' + Session.token, data, config)
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
                email: data.email,
                password: data.password,
                password_confirmation: data.password_confirmation,
                handphone_code_id: data.handphone_code_id,
                handphone: data.handphone,
                status: data.status,
                role: {
                    id: data.role.id
                }
            };
            var config = {};

            $http.post(BASE_API_URL + 'user/update?token=' + Session.token, data, config)
                .success(function (response) {
                    def.resolve(response);
                }, function (error) {
                    def.reject(error);
                });

            return def.promise;
        }

        promiseService.getUserInfo = function (id) {
            var def = Promise.defer();
            var data = {
                params: {
                    id: id
                }
            };
            var config = {};

            $http.get(BASE_API_URL + 'user/getUserInfo/?token=' + Session.token, data, config)
                .success(function (response) {
                    def.resolve(response);
                }, function (error) {
                    def.reject(error);
                });

            return def.promise;
        }

        return promiseService;
    }]);